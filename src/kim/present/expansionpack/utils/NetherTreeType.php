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
 * @noinspection PhpDeprecationInspection
 */

declare(strict_types=1);

namespace kim\present\expansionpack\utils;

use kim\present\expansionpack\BlockIds as Ids;
use kim\present\expansionpack\ItemIds as ItemIds;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockIdentifierFlattened;
use pocketmine\block\tile\Sign as TileSign;
use pocketmine\utils\AssumptionFailedError;
use pocketmine\utils\EnumTrait;

/**
 * @method static self CRIMSON()
 * @method static self WARPED()
 */
final class NetherTreeType{
    use EnumTrait {
        register as Enum_register;
        __construct as Enum___construct;
    }

    protected static function setup() : void{
        self::registerAll(
            new self("crimson", "Crimson"),
            new self("warped", "Warped")
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

    public function getStemIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_STEM, 0, ItemIds::CRIMSON_STEM),
            self::WARPED()->id() => new BID(Ids::WARPED_STEM, 0, ItemIds::WARPED_STEM),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getStripepedStemIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::STRIPPED_CRIMSON_STEM, 0, ItemIds::STRIPPED_CRIMSON_STEM),
            self::WARPED()->id() => new BID(Ids::STRIPPED_WARPED_STEM, 0, ItemIds::STRIPPED_WARPED_STEM),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getHyphaeIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_HYPHAE, 0, ItemIds::CRIMSON_HYPHAE),
            self::WARPED()->id() => new BID(Ids::WARPED_HYPHAE, 0, ItemIds::WARPED_HYPHAE),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getStripepedHyphaeIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::STRIPPED_CRIMSON_HYPHAE, 0, ItemIds::STRIPPED_CRIMSON_HYPHAE),
            self::WARPED()->id() => new BID(Ids::STRIPPED_WARPED_HYPHAE, 0, ItemIds::STRIPPED_WARPED_HYPHAE),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getPlanksIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_PLANKS, 0, ItemIds::CRIMSON_PLANKS),
            self::WARPED()->id() => new BID(Ids::WARPED_PLANKS, 0, ItemIds::WARPED_PLANKS),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getStairsIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_STAIRS, 0, ItemIds::CRIMSON_STAIRS),
            self::WARPED()->id() => new BID(Ids::WARPED_STAIRS, 0, ItemIds::WARPED_STAIRS),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getSlabIdentifier() : BlockIdentifierFlattened{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BlockIdentifierFlattened(Ids::CRIMSON_SLAB, [Ids::CRIMSON_DOUBLE_SLAB], 0, ItemIds::CRIMSON_SLAB),
            self::WARPED()->id() => new BlockIdentifierFlattened(Ids::WARPED_SLAB, [Ids::WARPED_DOUBLE_SLAB], 0, ItemIds::WARPED_SLAB),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getButtonIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_BUTTON, 0, ItemIds::CRIMSON_BUTTON),
            self::WARPED()->id() => new BID(Ids::WARPED_BUTTON, 0, ItemIds::WARPED_BUTTON),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getDoorIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_DOOR, 0, ItemIds::CRIMSON_DOOR),
            self::WARPED()->id() => new BID(Ids::WARPED_DOOR, 0, ItemIds::WARPED_DOOR),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getTrapdoorIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_TRAPDOOR, 0, ItemIds::CRIMSON_TRAPDOOR),
            self::WARPED()->id() => new BID(Ids::WARPED_TRAPDOOR, 0, ItemIds::WARPED_TRAPDOOR),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getPressurePlateIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_PRESSURE_PLATE, 0, ItemIds::CRIMSON_PRESSURE_PLATE),
            self::WARPED()->id() => new BID(Ids::WARPED_PRESSURE_PLATE, 0, ItemIds::WARPED_PRESSURE_PLATE),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getFenceIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_FENCE, 0, ItemIds::CRIMSON_FENCE),
            self::WARPED()->id() => new BID(Ids::WARPED_FENCE, 0, ItemIds::WARPED_FENCE),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getFenceGateIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_FENCE_GATE, 0, ItemIds::CRIMSON_FENCE_GATE),
            self::WARPED()->id() => new BID(Ids::WARPED_FENCE_GATE, 0, ItemIds::WARPED_FENCE_GATE),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getFloorSignIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_STANDING_SIGN, 0, ItemIds::CRIMSON_SIGN, TileSign::class),
            self::WARPED()->id() => new BID(Ids::WARPED_STANDING_SIGN, 0, ItemIds::WARPED_SIGN, TileSign::class),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getWallSignIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_WALL_SIGN, 0, ItemIds::CRIMSON_SIGN, TileSign::class),
            self::WARPED()->id() => new BID(Ids::WARPED_WALL_SIGN, 0, ItemIds::WARPED_SIGN, TileSign::class),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getRootsIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_ROOTS, 0, ItemIds::CRIMSON_ROOTS),
            self::WARPED()->id() => new BID(Ids::WARPED_ROOTS, 0, ItemIds::WARPED_ROOTS),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getFungusIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_FUNGUS, 0, ItemIds::CRIMSON_FUNGUS),
            self::WARPED()->id() => new BID(Ids::WARPED_FUNGUS, 0, ItemIds::WARPED_FUNGUS),
            default => throw new AssumptionFailedError("Should cover all wood types"),
        };
    }

    public function getNyliumIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::CRIMSON_NYLIUM, 0, ItemIds::CRIMSON_NYLIUM),
            self::WARPED()->id() => new BID(Ids::WARPED_NYLIUM, 0, ItemIds::WARPED_NYLIUM),
            default => throw new AssumptionFailedError("Should cover all wood types")
        };
    }

    public function getWartBlockIdentifier() : ?BID{
        return match ($this->id()) {
            self::WARPED()->id() => new BID(Ids::WARPED_WART, 0, ItemIds::WARPED_WART_BLOCK),
            default => null
        };
    }

    public function getVinesIdentifier() : BID{
        return match ($this->id()) {
            self::CRIMSON()->id() => new BID(Ids::WEEPING_VINES, 0, ItemIds::WEEPING_VINES),
            self::WARPED()->id() => new BID(Ids::TWISTING_VINES, 0, ItemIds::TWISTING_VINES),
            default => throw new AssumptionFailedError("Should cover all wood types")
        };
    }
}