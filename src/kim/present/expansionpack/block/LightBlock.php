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

use InvalidArgumentException;
use pocketmine\block\Transparent;
use pocketmine\block\utils\BlockDataSerializer;

class LightBlock extends Transparent{
    protected int $lightLevel = 0;

    protected function writeStateToMeta() : int{
        return $this->lightLevel;
    }

    public function readStateFromData(int $id, int $stateMeta) : void{
        $this->lightLevel = BlockDataSerializer::readBoundedInt("lightLevel", $stateMeta, 0, 15);
    }

    public function getStateBitmask() : int{
        return 0b1111;
    }

    public function canBeReplaced() : bool{
        return true;
    }

    public function canBeFlowedInto() : bool{
        return true;
    }

    public function getLightLevel() : int{
        return $this->lightLevel;
    }

    /** @return $this */
    public function setLightLevel(int $lightLevel) : self{
        if($lightLevel < 0 || $lightLevel > 15){
            throw new InvalidArgumentException("LightLevel must be in range 0-15");
        }
        $this->lightLevel = $lightLevel;

        return $this;
    }
}