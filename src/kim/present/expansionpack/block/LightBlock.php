<?php

declare(strict_types=1);

namespace kim\present\expansionpack\block;

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
            throw new \InvalidArgumentException("LightLevel must be in range 0-15");
        }
        $this->lightLevel = $lightLevel;

        return $this;
    }
}