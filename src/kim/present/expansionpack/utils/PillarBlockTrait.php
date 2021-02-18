<?php

declare(strict_types=1);

namespace kim\present\expansionpack\utils;

use pocketmine\block\utils\PillarRotationInMetadataTrait;

trait PillarBlockTrait{
    use PillarRotationInMetadataTrait;

    protected function getAxisMetaShift() : int{
        return 0; //default
    }
}