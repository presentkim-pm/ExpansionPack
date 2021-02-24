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
 */

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