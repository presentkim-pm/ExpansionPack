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
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_STEM, 0, ItemIds::CRIMSON_STEM);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_STEM, 0, ItemIds::WARPED_STEM);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getStripepedStemIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::STRIPPED_CRIMSON_STEM, 0, ItemIds::STRIPPED_CRIMSON_STEM);
            case self::WARPED()->id():
                return new BID(Ids::STRIPPED_WARPED_STEM, 0, ItemIds::STRIPPED_WARPED_STEM);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getHyphaeIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_HYPHAE, 0, ItemIds::CRIMSON_HYPHAE);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_HYPHAE, 0, ItemIds::WARPED_HYPHAE);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getStripepedHyphaeIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::STRIPPED_CRIMSON_HYPHAE, 0, ItemIds::STRIPPED_CRIMSON_HYPHAE);
            case self::WARPED()->id():
                return new BID(Ids::STRIPPED_WARPED_HYPHAE, 0, ItemIds::STRIPPED_WARPED_HYPHAE);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getPlanksIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_PLANKS, 0, ItemIds::CRIMSON_PLANKS);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_PLANKS, 0, ItemIds::WARPED_PLANKS);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getStairsIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_STAIRS, 0, ItemIds::CRIMSON_STAIRS);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_STAIRS, 0, ItemIds::WARPED_STAIRS);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getSlabIdentifier() : BlockIdentifierFlattened{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BlockIdentifierFlattened(Ids::CRIMSON_SLAB, [Ids::CRIMSON_DOUBLE_SLAB], 0, ItemIds::CRIMSON_SLAB);
            case self::WARPED()->id():
                return new BlockIdentifierFlattened(Ids::WARPED_SLAB, [Ids::WARPED_DOUBLE_SLAB], 0, ItemIds::WARPED_SLAB);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getButtonIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_BUTTON, 0, ItemIds::CRIMSON_BUTTON);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_BUTTON, 0, ItemIds::WARPED_BUTTON);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getDoorIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_DOOR, 0, ItemIds::CRIMSON_DOOR);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_DOOR, 0, ItemIds::WARPED_DOOR);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getTrapdoorIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_TRAPDOOR, 0, ItemIds::CRIMSON_TRAPDOOR);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_TRAPDOOR, 0, ItemIds::WARPED_TRAPDOOR);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getPressurePlateIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_PRESSURE_PLATE, 0, ItemIds::CRIMSON_PRESSURE_PLATE);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_PRESSURE_PLATE, 0, ItemIds::WARPED_PRESSURE_PLATE);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getFenceIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_FENCE, 0, ItemIds::CRIMSON_FENCE);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_FENCE, 0, ItemIds::WARPED_FENCE);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getFenceGateIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_FENCE_GATE, 0, ItemIds::CRIMSON_FENCE_GATE);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_FENCE_GATE, 0, ItemIds::WARPED_FENCE_GATE);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getFloorSignIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_STANDING_SIGN, 0, ItemIds::CRIMSON_SIGN, TileSign::class);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_STANDING_SIGN, 0, ItemIds::WARPED_SIGN, TileSign::class);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getWallSignIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_WALL_SIGN, 0, ItemIds::CRIMSON_SIGN, TileSign::class);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_WALL_SIGN, 0, ItemIds::WARPED_SIGN, TileSign::class);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getRootsIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_ROOTS, 0, ItemIds::CRIMSON_ROOTS);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_ROOTS, 0, ItemIds::WARPED_ROOTS);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getFungusIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_FUNGUS, 0, ItemIds::CRIMSON_FUNGUS);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_FUNGUS, 0, ItemIds::WARPED_FUNGUS);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getNyliumIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::CRIMSON_NYLIUM, 0, ItemIds::CRIMSON_NYLIUM);
            case self::WARPED()->id():
                return new BID(Ids::WARPED_NYLIUM, 0, ItemIds::WARPED_NYLIUM);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getWartBlockIdentifier() : ?BID{
        switch($this->id()){
            case self::WARPED()->id():
                return new BID(Ids::WARPED_WART, 0, ItemIds::WARPED_WART_BLOCK);
        }
        return null;
    }

    public function getVinesIdentifier() : BID{
        switch($this->id()){
            case self::CRIMSON()->id():
                return new BID(Ids::WEEPING_VINES, 0, ItemIds::WEEPING_VINES);
            case self::WARPED()->id():
                return new BID(Ids::TWISTING_VINES, 0, ItemIds::TWISTING_VINES);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }
}