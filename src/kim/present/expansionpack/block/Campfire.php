<?php

declare(strict_types=1);

namespace kim\present\expansionpack\block;

use pocketmine\block\Transparent;
use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use kim\present\expansionpack\utils\HorizontalBlockTrait;

class Campfire extends Transparent{
    use HorizontalBlockTrait {
        writeStateToMeta as writeFacingToMeta;
        readStateFromData as readFacingFromData;
    }

    protected bool $extinguish = false;

    protected function getExtinguishMetaShift() : int{
        return 2; //default
    }

    protected function readExtinguishFromMeta(int $meta) : void{
        $this->setExtinguish((bool) ($meta >> $this->getExtinguishMetaShift()));
    }

    protected function writeExtinguishToMeta() : int{
        return $this->getExtinguish() << $this->getExtinguishMetaShift();
    }

    protected function writeStateToMeta() : int{
        return $this->writeExtinguishToMeta() | $this->writeFacingToMeta();
    }

    public function readStateFromData(int $id, int $stateMeta) : void{
        $this->readExtinguishFromMeta($stateMeta);
        $this->readFacingFromData($id, $stateMeta);
    }

    public function getStateBitmask() : int{
        return 0b111;
    }

    /** @return AxisAlignedBB[] */
    protected function recalculateCollisionBoxes() : array{
        return [AxisAlignedBB::one()->trim(Facing::UP, 0.5)];
    }

    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
        if($face === Facing::UP){
            $block = clone $this;
            $block->setExtinguish(!$block->getExtinguish());
            $this->pos->getWorld()->setBlock($this->pos, $block);

            return true;
        }
        return false;
    }

    public function getExtinguish() : bool{
        return $this->extinguish;
    }

    /** @return $this */
    public function setExtinguish(bool $extinguish) : self{
        $this->extinguish = $extinguish;

        return $this;
    }
}