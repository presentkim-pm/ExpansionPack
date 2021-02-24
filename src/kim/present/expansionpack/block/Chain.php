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

use pocketmine\block\Block;
use pocketmine\block\utils\PillarRotationTrait;
use pocketmine\math\Axis;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;

class Chain extends Block{
    use PillarRotationTrait;

    protected function writeStateToMeta() : int{
        return [Axis::Y => 0, Axis::X => 1, Axis::Z => 2][$this->axis] ?? 0;
    }

    public function readStateFromData(int $id, int $stateMeta) : void{
        $this->axis = [0 => Axis::Y, 1 => Axis::X, 2 => Axis::Z][$stateMeta] ?? Axis::Y;
    }

    public function getStateBitmask() : int{
        return 0b10;
    }

    protected function recalculateCollisionBoxes() : array{
        return [AxisAlignedBB::one()->trim($this->axis << 1, 0.3)->trim(Facing::opposite($this->axis << 1), 0.3)];
    }
}