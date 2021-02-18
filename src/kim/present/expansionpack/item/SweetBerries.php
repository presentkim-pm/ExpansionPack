<?php

declare(strict_types=1);

namespace kim\present\expansionpack\item;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\item\Food;
use kim\present\expansionpack\BlockIds;

class SweetBerries extends Food{
    public function getBlock(?int $clickedFace = null) : Block{
        return BlockFactory::getInstance()->get(BlockIds::SWEET_BERRY_BUSH, 0);
    }

    public function getFoodRestore() : int{
        return 4;
    }

    public function getSaturationRestore() : float{
        return 1.2;
    }
}