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

namespace kim\present\expansionpack\utils;

use kim\present\expansionpack\BlockIds as Ids;
use kim\present\expansionpack\ItemIds as ItemIds;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockIdentifierFlattened;
use pocketmine\utils\AssumptionFailedError;
use pocketmine\utils\EnumTrait;

/**
 * @method static self BLACKSTONE()
 * @method static self POLISHED_BLACKSTONE()
 * @method static self POLISHED_BLACKSTONE_BRICKS()
 * @method static self CHISELED_POLISHED_BLACKSTONE()
 * @method static self CRACKED_POLISHED_BLACKSTONE_BRICKS()
 * @method static self GILDED_BLACKSTONE()
 */
final class BlackStoneType{
    use EnumTrait {
        register as Enum_register;
        __construct as Enum___construct;
    }

    protected static function setup() : void{
        self::registerAll(
            new self("blackstone", "Black Stone"),
            new self("polished_blackstone", "Polished Black Stone"),
            new self("polished_blackstone_bricks", "Polished Black Stone Bricks"),
            new self("chiseled_polished_blackstone", "Chiseled Polished Black Stone"),
            new self("cracked_polished_blackstone_bricks", "Cracked Polished Black Stone Bricks"),
            new self("gilded_blackstone", "Gilded Polished Black Stone")
        );
    }

    private string $displayName;

    private function __construct(string $enumName, string $displayName){
        $this->Enum___construct($enumName);
        $this->displayName = $displayName;
    }

    public function getDisplayName() : string{
        return $this->displayName;
    }

    public function getOpaqueIdentifier() : BID{
        return match ($this->id()) {
            self::BLACKSTONE()->id() => new BID(Ids::BLACKSTONE, 0, ItemIds::BLACKSTONE),
            self::POLISHED_BLACKSTONE()->id() => new BID(Ids::POLISHED_BLACKSTONE, 0, ItemIds::POLISHED_BLACKSTONE),
            self::POLISHED_BLACKSTONE_BRICKS()->id() => new BID(Ids::POLISHED_BLACKSTONE_BRICKS, 0, ItemIds::POLISHED_BLACKSTONE_BRICKS),
            self::CHISELED_POLISHED_BLACKSTONE()->id() => new BID(Ids::CHISELED_POLISHED_BLACKSTONE, 0, ItemIds::CHISELED_POLISHED_BLACKSTONE),
            self::CRACKED_POLISHED_BLACKSTONE_BRICKS()->id() => new BID(Ids::CRACKED_POLISHED_BLACKSTONE_BRICKS, 0, ItemIds::CRACKED_POLISHED_BLACKSTONE_BRICKS),
            self::GILDED_BLACKSTONE()->id() => new BID(Ids::GILDED_BLACKSTONE, 0, ItemIds::GILDED_BLACKSTONE),
            default => throw new AssumptionFailedError("Should cover all stone types")
        };
    }

    public function getStairsIdentifier() : ?BID{
        return match ($this->id()) {
            self::BLACKSTONE()->id() => new BID(Ids::BLACKSTONE_STAIRS, 0, ItemIds::BLACKSTONE_STAIRS),
            self::POLISHED_BLACKSTONE()->id() => new BID(Ids::POLISHED_BLACKSTONE_STAIRS, 0, ItemIds::POLISHED_BLACKSTONE_STAIRS),
            self::POLISHED_BLACKSTONE_BRICKS()->id() => new BID(Ids::POLISHED_BLACKSTONE_BRICK_STAIRS, 0, ItemIds::POLISHED_BLACKSTONE_BRICK_STAIRS),
            default => null
        };
    }

    public function getSlabIdentifier() : ?BlockIdentifierFlattened{
        return match ($this->id()) {
            self::BLACKSTONE()->id() => new BlockIdentifierFlattened(Ids::BLACKSTONE_SLAB, [Ids::BLACKSTONE_DOUBLE_SLAB], 0, ItemIds::BLACKSTONE_SLAB),
            self::POLISHED_BLACKSTONE()->id() => new BlockIdentifierFlattened(Ids::POLISHED_BLACKSTONE_SLAB, [Ids::POLISHED_BLACKSTONE_DOUBLE_SLAB], 0, ItemIds::POLISHED_BLACKSTONE_SLAB),
            self::POLISHED_BLACKSTONE_BRICKS()->id() => new BlockIdentifierFlattened(Ids::POLISHED_BLACKSTONE_BRICK_SLAB, [Ids::POLISHED_BLACKSTONE_BRICK_DOUBLE_SLAB], 0, ItemIds::POLISHED_BLACKSTONE_BRICK_SLAB),
            default => null
        };
    }

    public function getButtonIdentifier() : ?BID{
        return match ($this->id()) {
            self::POLISHED_BLACKSTONE()->id() => new BID(Ids::POLISHED_BLACKSTONE_BUTTON, 0, ItemIds::POLISHED_BLACKSTONE_BUTTON),
            default => null
        };
    }

    public function getPressurePlateIdentifier() : ?BID{
        return match ($this->id()) {
            self::POLISHED_BLACKSTONE()->id() => new BID(Ids::POLISHED_BLACKSTONE_PRESSURE_PLATE, 0, ItemIds::POLISHED_BLACKSTONE_PRESSURE_PLATE),
            default => null
        };
    }

    public function getWallIdentifier() : ?BID{
        return match ($this->id()) {
            self::BLACKSTONE()->id() => new BID(Ids::BLACKSTONE_WALL, 0, ItemIds::BLACKSTONE_WALL),
            self::POLISHED_BLACKSTONE()->id() => new BID(Ids::POLISHED_BLACKSTONE_WALL, 0, ItemIds::POLISHED_BLACKSTONE_WALL),
            self::POLISHED_BLACKSTONE_BRICKS()->id() => new BID(Ids::POLISHED_BLACKSTONE_BRICK_WALL, 0, ItemIds::POLISHED_BLACKSTONE_BRICK_WALL),
            default => null
        };
    }
}