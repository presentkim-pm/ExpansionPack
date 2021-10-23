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

namespace kim\present\expansionpack;

use kim\present\expansionpack\BlockIds as Ids;
use kim\present\expansionpack\ItemIds as ItemIds;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockLegacyIdHelper;
use pocketmine\block\utils\TreeType;
use pocketmine\utils\AssumptionFailedError;

/** @see BlockLegacyIdHelper */
final class ExpansionPackLegacyIdHelper{
    public static function getStripedLogIdentifier(TreeType $treeType) : BID{
        switch($treeType->id()){
            case TreeType::OAK()->id():
                return new BID(Ids::STRIPPED_OAK_LOG, 0, ItemIds::STRIPPED_OAK_LOG);
            case TreeType::SPRUCE()->id():
                return new BID(Ids::STRIPPED_SPRUCE_LOG, 0, ItemIds::STRIPPED_SPRUCE_LOG);
            case TreeType::BIRCH()->id():
                return new BID(Ids::STRIPPED_BIRCH_LOG, 0, ItemIds::STRIPPED_BIRCH_LOG);
            case TreeType::JUNGLE()->id():
                return new BID(Ids::STRIPPED_JUNGLE_LOG, 0, ItemIds::STRIPPED_JUNGLE_LOG);
            case TreeType::ACACIA()->id():
                return new BID(Ids::STRIPPED_ACACIA_LOG, 0, ItemIds::STRIPPED_ACACIA_LOG);
            case TreeType::DARK_OAK()->id():
                return new BID(Ids::STRIPPED_DARK_OAK_LOG, 0, ItemIds::STRIPPED_DARK_OAK_LOG);
        }
        throw new AssumptionFailedError("Should cover all wood types");
    }
}