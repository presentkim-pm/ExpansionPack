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
        switch($this->id()){
            case self::BLACKSTONE()->id():
                return new BID(Ids::BLACKSTONE, 0, ItemIds::BLACKSTONE);
            case self::POLISHED_BLACKSTONE()->id():
                return new BID(Ids::POLISHED_BLACKSTONE, 0, ItemIds::POLISHED_BLACKSTONE);
            case self::POLISHED_BLACKSTONE_BRICKS()->id():
                return new BID(Ids::POLISHED_BLACKSTONE_BRICKS, 0, ItemIds::POLISHED_BLACKSTONE_BRICKS);
            case self::CHISELED_POLISHED_BLACKSTONE()->id():
                return new BID(Ids::CHISELED_POLISHED_BLACKSTONE, 0, ItemIds::CHISELED_POLISHED_BLACKSTONE);
            case self::CRACKED_POLISHED_BLACKSTONE_BRICKS()->id():
                return new BID(Ids::CRACKED_POLISHED_BLACKSTONE_BRICKS, 0, ItemIds::CRACKED_POLISHED_BLACKSTONE_BRICKS);
            case self::GILDED_BLACKSTONE()->id():
                return new BID(Ids::GILDED_BLACKSTONE, 0, ItemIds::GILDED_BLACKSTONE);
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }

    public function getStairsIdentifier() : ?BID{
        switch($this->id()){
            case self::BLACKSTONE()->id():
                return new BID(Ids::BLACKSTONE_STAIRS, 0, ItemIds::BLACKSTONE_STAIRS);
            case self::POLISHED_BLACKSTONE()->id():
                return new BID(Ids::POLISHED_BLACKSTONE_STAIRS, 0, ItemIds::POLISHED_BLACKSTONE_STAIRS);
            case self::POLISHED_BLACKSTONE_BRICKS()->id():
                return new BID(Ids::POLISHED_BLACKSTONE_BRICK_STAIRS, 0, ItemIds::POLISHED_BLACKSTONE_BRICK_STAIRS);
        }
        return null;
    }

    public function getSlabIdentifier() : ?BlockIdentifierFlattened{
        switch($this->id()){
            case self::BLACKSTONE()->id():
                return new BlockIdentifierFlattened(Ids::BLACKSTONE_SLAB, [Ids::BLACKSTONE_DOUBLE_SLAB], 0, ItemIds::BLACKSTONE_SLAB);
            case self::POLISHED_BLACKSTONE()->id():
                return new BlockIdentifierFlattened(Ids::POLISHED_BLACKSTONE_SLAB, [Ids::POLISHED_BLACKSTONE_DOUBLE_SLAB], 0, ItemIds::POLISHED_BLACKSTONE_SLAB);
            case self::POLISHED_BLACKSTONE_BRICKS()->id():
                return new BlockIdentifierFlattened(Ids::POLISHED_BLACKSTONE_BRICK_SLAB, [Ids::POLISHED_BLACKSTONE_BRICK_DOUBLE_SLAB], 0, ItemIds::POLISHED_BLACKSTONE_BRICK_SLAB);
        }
        return null;
    }

    public function getButtonIdentifier() : ?BID{
        switch($this->id()){
            case self::POLISHED_BLACKSTONE()->id():
                return new BID(Ids::POLISHED_BLACKSTONE_BUTTON, 0, ItemIds::POLISHED_BLACKSTONE_BUTTON);
        }
        return null;
    }

    public function getPressurePlateIdentifier() : ?BID{
        switch($this->id()){
            case self::POLISHED_BLACKSTONE()->id():
                return new BID(Ids::POLISHED_BLACKSTONE_PRESSURE_PLATE, 0, ItemIds::POLISHED_BLACKSTONE_PRESSURE_PLATE);
        }
        return null;
    }

    public function getWallIdentifier() : ?BID{
        switch($this->id()){
            case self::BLACKSTONE()->id():
                return new BID(Ids::BLACKSTONE_WALL, 0, ItemIds::BLACKSTONE_WALL);
            case self::POLISHED_BLACKSTONE()->id():
                return new BID(Ids::POLISHED_BLACKSTONE_WALL, 0, ItemIds::POLISHED_BLACKSTONE_WALL);
            case self::POLISHED_BLACKSTONE_BRICKS()->id():
                return new BID(Ids::POLISHED_BLACKSTONE_BRICK_WALL, 0, ItemIds::POLISHED_BLACKSTONE_BRICK_WALL);
        }
        return null;
    }
}