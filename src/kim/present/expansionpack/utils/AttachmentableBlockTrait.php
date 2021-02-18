<?php

declare(strict_types=1);

namespace kim\present\expansionpack\utils;

use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

trait AttachmentableBlockTrait{
    use HorizontalBlockTrait {
        writeStateToMeta as writeFacingToMeta;
        readStateFromData as readFacingFromData;
    }

    protected int $attachment = 0;

    protected function getAttachmentMetaShift() : int{
        return 2; //default
    }

    protected function readAttachmentFromMeta(int $meta) : void{
        $this->setAttachment($meta >> $this->getAttachmentMetaShift());
    }

    protected function writeAttachmentToMeta() : int{
        return $this->getAttachment() << $this->getAttachmentMetaShift();
    }

    protected function writeStateToMeta() : int{
        return $this->writeAttachmentToMeta() | $this->writeFacingToMeta();
    }

    public function readStateFromData(int $id, int $stateMeta) : void{
        $this->readAttachmentFromMeta($stateMeta);
        $this->readFacingFromData($id, $stateMeta);
    }

    public function getStateBitmask() : int{
        return 0b1111;
    }

    public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
        if($face === Facing::DOWN){
            $this->attachment = Attachment::CEILING;
        }elseif($face === Facing::UP){
            if($player !== null){
                $this->facing = Facing::opposite($player->getHorizontalFacing());
            }
            $this->attachment = Attachment::FLOOR;
        }else{
            $this->facing = $face;
            if($blockReplace->getSide($face)->isSolid()){
                $this->attachment = Attachment::DOUBLE_WALL;
            }else{
                $this->attachment = Attachment::SINGLE_WALL;
            }
        }

        return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
    }

    public function onNearbyBlockChange() : void{
        //TODO: 지지중인 블럭이 부셔지면 파괴
    }

    public function getAttachment() : int{
        return $this->attachment;
    }

    /** @return $this */
    public function setAttachment(int $attachment) : self{
        if($attachment < 0 || $attachment > 3){
            throw new \InvalidArgumentException("Attachment must be in range 0-3");
        }
        $this->attachment = $attachment;

        return $this;
    }
}