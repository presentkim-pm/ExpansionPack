<?php

declare(strict_types=1);

namespace kim\present\expansionpack;

use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockLegacyIdHelper;
use pocketmine\block\utils\TreeType;
use pocketmine\utils\AssumptionFailedError;
use kim\present\expansionpack\BlockIds as Ids;
use kim\present\expansionpack\ItemIds as ItemIds;

/** @see BlockLegacyIdHelper */
final class MoreBlockLegacyIdHelper{
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
        throw new AssumptionFailedError("Switch should cover all wood types");
    }
}