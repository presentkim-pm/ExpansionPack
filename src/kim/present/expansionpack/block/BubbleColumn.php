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
use pocketmine\block\utils\BlockDataSerializer;

class BubbleColumn extends Transparent{
    public const DRAG_UPWARD = 0;
    public const DRAG_DOWNWARD = 1;

    protected bool $dragMode = false;

    protected function writeStateToMeta() : int{
        return $this->getDragMode();
    }

    public function readStateFromData(int $id, int $stateMeta) : void{
        $this->setDragMode((bool) BlockDataSerializer::readBoundedInt("dragMode", $stateMeta, 0, 1));
    }

    public function getStateBitmask() : int{
        return 0b1;
    }

    public function canBeReplaced() : bool{
        return true;
    }

    public function canBeFlowedInto() : bool{
        return true;
    }

    public function getDragMode() : int{
        return (int) $this->dragMode;
    }

    /** @return $this */
    public function setDragMode(bool $dragMode) : self{
        $this->dragMode = $dragMode;

        return $this;
    }
}