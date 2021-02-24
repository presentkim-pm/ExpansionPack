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

use pocketmine\block\Block;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\block\utils\HorizontalFacingTrait;
use pocketmine\item\Item;
use pocketmine\math\Axis;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

trait HorizontalBlockTrait{
    use HorizontalFacingTrait;

    protected function writeStateToMeta() : int{
        return BlockDataSerializer::writeLegacyHorizontalFacing($this->facing);
    }

    public function readStateFromData(int $id, int $stateMeta) : void{
        $this->facing = BlockDataSerializer::readLegacyHorizontalFacing($stateMeta & 0x03);
    }

    public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
        if($player !== null){
            $this->facing = Facing::opposite($player->getHorizontalFacing());
        }elseif(($axis = Facing::axis($face)) !== Axis::X && $axis !== Axis::Z){
            $this->facing = $face;
        }

        return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
    }
}