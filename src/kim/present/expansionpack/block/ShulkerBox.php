<?php

declare(strict_types=1);

namespace kim\present\expansionpack\block;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType as ToolType;
use pocketmine\block\Opaque;
use pocketmine\block\utils\ColorInMetadataTrait;
use pocketmine\block\utils\DyeColor;

class ShulkerBox extends Opaque{
    use ColorInMetadataTrait;

    public function __construct(BlockIdentifier $idInfo, string $name, ?BlockBreakInfo $breakInfo = null){
        $this->color = DyeColor::WHITE();
        parent::__construct($idInfo, $name, $breakInfo ?? new BlockBreakInfo(2, ToolType::PICKAXE));
    }
}