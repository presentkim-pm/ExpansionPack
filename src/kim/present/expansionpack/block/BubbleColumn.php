<?php

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