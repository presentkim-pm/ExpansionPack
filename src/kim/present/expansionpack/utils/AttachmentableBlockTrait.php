<?php

/**
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://www.gnu.org/licenses/lgpl-3.0 LGPL-3.0 License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 *
 * @noinspection PhpIllegalPsrClassPathInspection
 * @noinspection PhpDocSignatureInspection
 * @noinspection SpellCheckingInspection
 * @noinspection PhpUnusedParameterInspection
 * @noinspection PhpUndefinedClassInspection
 */

declare(strict_types=1);

namespace kim\present\expansionpack\utils;

use InvalidArgumentException;
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
        //TODO: Destroyed when the supporting block is broken
    }

    public function getAttachment() : int{
        return $this->attachment;
    }

    /** @return $this */
    public function setAttachment(int $attachment) : self{
        if($attachment < 0 || $attachment > 3){
            throw new InvalidArgumentException("Attachment must be in range 0-3");
        }
        $this->attachment = $attachment;

        return $this;
    }
}