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

use kim\present\expansionpack\block\Bell;
use kim\present\expansionpack\block\BubbleColumn;
use kim\present\expansionpack\block\Campfire;
use kim\present\expansionpack\block\Chain;
use kim\present\expansionpack\block\Grindstone;
use kim\present\expansionpack\block\HorizontalOpaque;
use kim\present\expansionpack\block\HorizontalTransparent;
use kim\present\expansionpack\block\LightBlock;
use kim\present\expansionpack\block\NetherVines;
use kim\present\expansionpack\block\Pillar;
use kim\present\expansionpack\block\PillarWood;
use kim\present\expansionpack\block\ShulkerBox;
use kim\present\expansionpack\block\SweetBerryBush;
use kim\present\expansionpack\item\SweetBerries;
use kim\present\expansionpack\task\RuntimeIdsRegister;
use kim\present\expansionpack\utils\BlackStoneType;
use kim\present\expansionpack\utils\NetherTreeType;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo as BreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockToolType as ToolType;
use pocketmine\block\FenceGate;
use pocketmine\block\Fire;
use pocketmine\block\FloorSign;
use pocketmine\block\Lantern;
use pocketmine\block\Opaque;
use pocketmine\block\Planks;
use pocketmine\block\Slab;
use pocketmine\block\Stair;
use pocketmine\block\StoneButton;
use pocketmine\block\StonePressurePlate;
use pocketmine\block\Torch;
use pocketmine\block\Transparent;
use pocketmine\block\utils\TreeType;
use pocketmine\block\Wall;
use pocketmine\block\WallSign;
use pocketmine\block\WoodenButton;
use pocketmine\block\WoodenDoor;
use pocketmine\block\WoodenFence;
use pocketmine\block\WoodenPressurePlate;
use pocketmine\block\WoodenStairs;
use pocketmine\block\WoodenTrapdoor;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\ItemBlock;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier as IID;
use pocketmine\item\ToolTier;
use pocketmine\plugin\PluginBase;

final class Loader extends PluginBase{
    protected function onLoad() : void{
        $this->registerAllBlocks();
        $this->registerAllItems();
        $this->registerAllRuntimeIds();
        $this->registerAllCreativeItems();
    }

    private function registerAllBlocks() : void{
        //Stripped logs
        foreach(TreeType::getAll() as $treeType){
            $this->registerBlock(new PillarWood(ExpansionPackLegacyIdHelper::getStripedLogIdentifier($treeType), "Stripeped {$treeType->getDisplayName()} Log", BreakInfo::instant(), $treeType, true));
        }

        //Nether plants
        $netherWoodBreakInfo = new BreakInfo(2.0, ToolType::AXE);
        foreach(NetherTreeType::getAll() as $treeType){
            $name = $treeType->getDisplayName();

            $this->registerBlock(new Pillar($treeType->getStemIdentifier(), $name . " Stem", $netherWoodBreakInfo));
            $this->registerBlock(new Pillar($treeType->getStripepedStemIdentifier(), "Stripeped {$name} Stem", $netherWoodBreakInfo));
            $this->registerBlock(new Pillar($treeType->getHyphaeIdentifier(), $name . " Hyphae", $netherWoodBreakInfo));
            $this->registerBlock(new Pillar($treeType->getStripepedHyphaeIdentifier(), "Stripeped {$name} Hyphae", $netherWoodBreakInfo));
            $this->registerBlock(new Planks($treeType->getPlanksIdentifier(), $name . " Planks", $netherWoodBreakInfo));
            $this->registerBlock(new Slab($treeType->getSlabIdentifier(), $name . " Slab", $netherWoodBreakInfo));
            $this->registerBlock(new WoodenStairs($treeType->getStairsIdentifier(), $name . " Stairs", BreakInfo::instant()));
            $this->registerBlock(new WoodenButton($treeType->getButtonIdentifier(), $name . " Button", $netherWoodBreakInfo));
            $this->registerBlock(new WoodenDoor($treeType->getDoorIdentifier(), $name . " Door", $netherWoodBreakInfo));
            $this->registerBlock(new WoodenTrapdoor($treeType->getTrapdoorIdentifier(), $name . " Trapdoor", $netherWoodBreakInfo));
            $this->registerBlock(new WoodenPressurePlate($treeType->getPressurePlateIdentifier(), $name . " Pressure Plate", $netherWoodBreakInfo));
            $this->registerBlock(new WoodenFence($treeType->getFenceIdentifier(), $name . " Fence", $netherWoodBreakInfo));
            $this->registerBlock(new FenceGate($treeType->getFenceGateIdentifier(), $name . " Fence Gate", $netherWoodBreakInfo));
            $this->registerBlock(new FloorSign($treeType->getFloorSignIdentifier(), $name . " Sign", $netherWoodBreakInfo));
            $this->registerBlock(new WallSign($treeType->getWallSignIdentifier(), $name . " Wall Sign", $netherWoodBreakInfo));
            $this->registerBlock(new Transparent($treeType->getRootsIdentifier(), $name . " Roots", BreakInfo::instant()));
            if(($wartBlockIdentifier = $treeType->getWartBlockIdentifier()) !== null){
                $this->registerBlock(new Opaque($wartBlockIdentifier, $name . " Wart", new BreakInfo(1.0, ToolType::HOE)));
            }
            $this->registerBlock(new Transparent($treeType->getFungusIdentifier(), $name . " Fungus", BreakInfo::instant()));
            $this->registerBlock(new Opaque($treeType->getNyliumIdentifier(), $name . " Nylium", new BreakInfo(0.4, ToolType::PICKAXE)));
            $this->registerBlock(new NetherVines($treeType));
        }

        //Black stons
        $blackStoneBreakInfo = new BreakInfo(1.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel());
        foreach(BlackStoneType::getAll() as $stoneType){
            $name = $stoneType->getDisplayName();

            $this->registerBlock(new Opaque($stoneType->getOpaqueIdentifier(), $name, $blackStoneBreakInfo));
            if(($slabIdentifier = $stoneType->getSlabIdentifier()) !== null){
                $this->registerBlock(new Slab($slabIdentifier, $name . " Slab", $blackStoneBreakInfo));
            }
            if(($stairIdentifier = $stoneType->getStairsIdentifier()) !== null){
                $this->registerBlock(new Stair($stairIdentifier, $name . " Stairs", $blackStoneBreakInfo));
            }
            if(($buttonIdentifier = $stoneType->getButtonIdentifier()) !== null){
                $this->registerBlock(new StoneButton($buttonIdentifier, $name . " Button", $blackStoneBreakInfo));
            }
            if(($pressurePlateIdentifier = $stoneType->getPressurePlateIdentifier()) !== null){
                $this->registerBlock(new StonePressurePlate($pressurePlateIdentifier, $name . " Pressure Plate", $blackStoneBreakInfo));
            }
            if(($wallIdentifier = $stoneType->getWallIdentifier()) !== null){
                $this->registerBlock(new Wall($wallIdentifier, $name . " Wall", $blackStoneBreakInfo));
            }
        }

        //Simple blocks (has one meta data)
        $this->registerBlock(new Opaque(new BID(BlockIds::ANCIENT_DEBRIS, 0, ItemIds::ANCIENT_DEBRIS), "Ancient Debris", new BreakInfo(30.0, ToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel())));
        $this->registerBlock(new Opaque(new BID(BlockIds::CARTOGRAPHY_TABLE, 0, ItemIds::CARTOGRAPHY_TABLE), "Cartography Table", new BreakInfo(2.5, ToolType::AXE)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CHISELED_NETHER_BRICKS, 0, ItemIds::CHISELED_NETHER_BRICKS), "Chiseled Nether Bricks", new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CRACKED_NETHER_BRICKS, 0, ItemIds::CRACKED_NETHER_BRICKS), "Cracked Nether Bricks", new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CRYING_OBSIDIAN, 0, ItemIds::CRYING_OBSIDIAN), "Crying Obsidian", new BreakInfo(50.0, ToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel())));
        $this->registerBlock(new Opaque(new BID(BlockIds::FLETCHING_TABLE, 0, ItemIds::FLETCHING_TABLE), "Fletching Table", new BreakInfo(2.5, ToolType::AXE)));
        $this->registerBlock(new Opaque(new BID(BlockIds::HONEYCOMB, 0, ItemIds::HONEYCOMB_BLOCK), "Honeycomb Block", new BreakInfo(0.6)));
        $this->registerBlock(new Opaque(new BID(BlockIds::HONEY, 0, ItemIds::HONEY_BLOCK), "Honey Block", BreakInfo::instant()));
        $this->registerBlock(new Opaque(new BID(BlockIds::MOVINGBLOCK, 0, ItemIds::MOVINGBLOCK), "Moving Block", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::NETHERITE_BLOCK, 0, ItemIds::NETHERITE_BLOCK), "Block of Netherite", new BreakInfo(50.0, ToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel())));
        $this->registerBlock(new Opaque(new BID(BlockIds::NETHER_GOLD_ORE, 0, ItemIds::NETHER_GOLD_ORE), "Nether Gold Ore", new BreakInfo(3, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new Opaque(new BID(BlockIds::QUARTZ_BRICKS, 0, ItemIds::QUARTZ_BRICKS), "Quartz Bricks", new BreakInfo(0.8, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new Opaque(new BID(BlockIds::SLIME, 0, ItemIds::SLIME), "Slime Block", new BreakInfo(0.05)));
        $this->registerBlock(new Opaque(new BID(BlockIds::SMITHING_TABLE, 0, ItemIds::SMITHING_TABLE), "Smithing Table", new BreakInfo(2.5, ToolType::AXE)));
        $this->registerBlock(new Opaque(new BID(BlockIds::SOUL_SOIL, 0, ItemIds::SOUL_SOIL), "Soul Soil", new BreakInfo(0.5, ToolType::SHOVEL)));
        $this->registerBlock(new Opaque(new BID(BlockIds::TARGET, 0, ItemIds::TARGET), "Target", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::UNDYED_SHULKER_BOX, 0, ItemIds::UNDYED_SHULKER_BOX), "Undyed Shulker Box", new BreakInfo(50.0, ToolType::AXE)));
        $this->registerBlock(new Opaque(new BID(BlockIds::LODESTONE, 0, ItemIds::LODESTONE), "Lodestone", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new Opaque(new BID(BlockIds::SHROOMLIGHT, 0, ItemIds::SHROOMLIGHT), "Shroomlight", new BreakInfo(1, ToolType::HOE)));
        $this->registerBlock(new Opaque(new BID(BlockIds::RESPAWN_ANCHOR, 0, ItemIds::RESPAWN_ANCHOR), "Respawn Anchor", new BreakInfo(50.0, ToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel())));
        $this->registerBlock(new Transparent(new BID(BlockIds::END_GATEWAY, 0, ItemIds::END_GATEWAY), "End Gateway", BreakInfo::indestructible()));
        $this->registerBlock(new Transparent(new BID(BlockIds::NETHER_SPROUTS, 0, ItemIds::NETHER_SPROUTS), "Nether Sprouts", BreakInfo::instant()));
        $this->registerBlock(new Transparent(new BID(BlockIds::WITHER_ROSE, 0, ItemIds::WITHER_ROSE), "Wither Rose", BreakInfo::instant()));
        $this->registerBlock(new Opaque(new BID(BlockIds::ALLOW, 0, ItemIds::ALLOW), "Allow", BreakInfo::instant()));
        $this->registerBlock(new Opaque(new BID(BlockIds::DENY, 0, ItemIds::DENY), "Deny", BreakInfo::instant()));
        $this->registerBlock(new Opaque(new BID(BlockIds::CAMERA, 0, ItemIds::CAMERA_BLOCK), "Camera", BreakInfo::instant()));
        //TODO: Implementing bounding box
        $this->registerBlock(new Transparent(new BID(BlockIds::END_PORTAL, 0, ItemIds::END_PORTAL), "End Portal", BreakInfo::indestructible()));
        $this->registerBlock(new Transparent(new BID(BlockIds::GLOW_STICK, 0, ItemIds::GLOW_STICK), "Glow Stick", BreakInfo::instant()));
        $this->registerBlock(new Transparent(new BID(BlockIds::CHORUS_PLANT, 0, ItemIds::CHORUS_PLANT), "Chorus Plant", new BreakInfo(0.4, ToolType::AXE)));
        $this->registerBlock(new Transparent(new BID(BlockIds::CONDUIT, 0, ItemIds::CONDUIT), "Conduit", new BreakInfo(3.0, ToolType::PICKAXE)));

        //Pillar blocks
        $baslatBreakInfo = new BreakInfo(1.25, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel());
        $this->registerBlock(new Pillar(new BID(BlockIds::BASALT, 0, ItemIds::BASALT), "Basalt", $baslatBreakInfo));
        $this->registerBlock(new Pillar(new BID(BlockIds::POLISHED_BASALT, 0, ItemIds::POLISHED_BASALT), "Polished Basalt", $baslatBreakInfo));

        //Horizontal blocks
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::COMMAND_BLOCK, 0, ItemIds::COMMAND_BLOCK), "Command Block", BreakInfo::indestructible()));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::REPEATING_COMMAND_BLOCK, 0, ItemIds::REPEATING_COMMAND_BLOCK), "Repeating Command Block", BreakInfo::indestructible()));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::CHAIN_COMMAND_BLOCK, 0, ItemIds::CHAIN_COMMAND_BLOCK), "Chain Command Block", BreakInfo::indestructible()));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::BEE_NEST, 0, ItemIds::BEE_NEST), "Bee Nest", new BreakInfo(0.3, ToolType::AXE)));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::BEEHIVE, 0, ItemIds::BEEHIVE), "Beehive", new BreakInfo(0.6, ToolType::AXE)));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::BLAST_FURNACE, 0, ItemIds::BLAST_FURNACE), "Blast Furnace", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::DROPPER, 0, ItemIds::DROPPER), "Dropper", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::DISPENSER, 0, ItemIds::DISPENSER), "Dispenser", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::LIT_BLAST_FURNACE, 0, ItemIds::LIT_BLAST_FURNACE), "Lit Blast Furnace", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::SMOKER, 0, ItemIds::SMOKER), "Smoker", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::LIT_SMOKER, 0, ItemIds::LIT_SMOKER), "Lit Smoker", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::LECTERN, 0, ItemIds::LECTERN), "Lectern", new BreakInfo(2.5, ToolType::AXE)));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::LOOM, 0, ItemIds::LOOM), "Loom", new BreakInfo(2.5, ToolType::AXE)));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::OBSERVER, 0, ItemIds::OBSERVER), "Observer", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::PISTON, 0, ItemIds::PISTON), "Piston", new BreakInfo(1.5, ToolType::AXE)));
        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::STICKY_PISTON, 0, ItemIds::STICKY_PISTON), "Sticky Piston", new BreakInfo(1.5, ToolType::AXE)));

        $this->registerBlock(new HorizontalOpaque(new BID(BlockIds::STONECUTTER_BLOCK, 0, ItemIds::STONECUTTER_BLOCK), "Stonecutter", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new HorizontalTransparent(new BID(BlockIds::PISTONARMCOLLISION, 0, ItemIds::PISTONARMCOLLISION), "Piston Arm Collision", BreakInfo::instant()));
        $this->registerBlock(new HorizontalTransparent(new BID(BlockIds::STICKYPISTONARMCOLLISION, 0, ItemIds::STICKYPISTONARMCOLLISION), "Sticky Piston Arm Collision", BreakInfo::instant()));

        $this->registerBlock(new Lantern(new BID(BlockIds::SOUL_LANTERN, 0, ItemIds::SOUL_LANTERN), "Soul Lantern", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new Fire(new BID(BlockIds::SOUL_FIRE, 0, ItemIds::SOUL_FIRE), "Soul Fire", BreakInfo::instant()));
        $this->registerBlock(new Torch(new BID(BlockIds::SOUL_TORCH, 0, ItemIds::SOUL_TORCH), "Soul Touch", BreakInfo::instant()));
        $this->registerBlock(new SweetBerryBush(new BID(BlockIds::SWEET_BERRY_BUSH, 0, ItemIds::SWEET_BERRIES), "Sweet Berries", BreakInfo::instant()));
        $this->registerBlock(new Chain(new BID(BlockIds::CHAIN, 0, ItemIds::CHAIN), "Chain", new BreakInfo(5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new LightBlock(new BID(BlockIds::LIGHT_BLOCK, 0, ItemIds::LIGHT_BLOCK), "Light Block", BreakInfo::indestructible()));
        $this->registerBlock(new ShulkerBox(new BID(BlockIds::SHULKER_BOX, 0, ItemIds::SHULKER_BOX), "Shulker Box"));
        $this->registerBlock(new BubbleColumn(new BID(BlockIds::BUBBLE_COLUMN, 0, ItemIds::BUBBLE_COLUMN), "Bubble Column", BreakInfo::indestructible()));
        $this->registerBlock(new Bell(new BID(BlockIds::BELL, 0, ItemIds::BELL), "Bell", new BreakInfo(5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new Grindstone(new BID(BlockIds::GRINDSTONE, 0, ItemIds::GRINDSTONE), "Grindstone", new BreakInfo(2, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
        $this->registerBlock(new Campfire(new BID(BlockIds::CAMPFIRE, 0, ItemIds::CAMPFIRE), "Campfire", new BreakInfo(2, ToolType::AXE)));
        $this->registerBlock(new Campfire(new BID(BlockIds::SOUL_CAMPFIRE, 0, ItemIds::SOUL_CAMPFIRE), "Soul Campfire", new BreakInfo(2, ToolType::AXE)));

        //TODO: Implementing below blocks
        $this->registerBlock(new Opaque(new BID(BlockIds::CAULDRON, 0, ItemIds::CAULDRON), "CAULDRON_BLOCK", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CHORUS_FLOWER, 0, ItemIds::CHORUS_FLOWER), "CHORUS_FLOWER", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::STRUCTURE_BLOCK, 0, ItemIds::STRUCTURE_BLOCK), "STRUCTURE_BLOCK", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::SEAGRASS, 0, ItemIds::SEAGRASS), "SEAGRASS", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CORAL, 0, ItemIds::CORAL), "CORAL", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CORAL_FAN, 0, ItemIds::CORAL_FAN), "CORAL_FAN", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CORAL_FAN_DEAD, 0, ItemIds::CORAL_FAN_DEAD), "CORAL_FAN_DEAD", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CORAL_FAN_HANG, 0, ItemIds::CORAL_FAN_HANG), "CORAL_FAN_HANG", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CORAL_FAN_HANG2, 0, ItemIds::CORAL_FAN_HANG2), "CORAL_FAN_HANG2", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::CORAL_FAN_HANG3, 0, ItemIds::CORAL_FAN_HANG3), "CORAL_FAN_HANG3", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::KELP, 0, ItemIds::KELP), "KELP", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::TURTLE_EGG, 0, ItemIds::TURTLE_EGG), "TURTLE_EGG", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::SCAFFOLDING, 0, ItemIds::SCAFFOLDING), "SCAFFOLDING", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::LAVA_CAULDRON, 0, ItemIds::CAULDRON), "LAVA_CAULDRON", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::JIGSAW, 0, ItemIds::JIGSAW), "JIGSAW", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::COMPOSTER, 0, ItemIds::COMPOSTER), "COMPOSTER", new BreakInfo(0)));

        $this->registerBlock(new Opaque(new BID(BlockIds::BORDER_BLOCK, 0, ItemIds::BORDER_BLOCK), "BODER_BLOCK", new BreakInfo(0)));
        $this->registerBlock(new Opaque(new BID(BlockIds::STRUCTURE_VOID, 0, ItemIds::STRUCTURE_VOID), "STRUCTURE_VOID", new BreakInfo(0)));
    }

    private function registerBlock(Block $block) : void{
        $idInfo = $block->getIdInfo();
        $itemId = $idInfo->getItemId();
        if(255 - $idInfo->getBlockId() !== $idInfo->getItemId()){
            ItemFactory::getInstance()->register(new ItemBlock(new IID($itemId, 0), $block), true);
        }

        BlockFactory::getInstance()->register($block, true);
    }

    private function registerAllItems() : void{
        $factory = ItemFactory::getInstance();
        $factory->register(new SweetBerries(new IID(ItemIds::SWEET_BERRIES, 0), "Sweet Berries"), true);
    }

    private function registerAllRuntimeIds() : void{
        RuntimeIdsRegister::register();

        //Apply runtime registering to async workers
        $asyncPool = $this->getServer()->getAsyncPool();
        foreach($asyncPool->getRunningWorkers() as $workerId){
            $asyncPool->submitTaskToWorker(new RuntimeIdsRegister(), $workerId);
        }
        $asyncPool->addWorkerStartHook(function(int $workerId) use ($asyncPool) : void{
            $asyncPool->submitTaskToWorker(new RuntimeIdsRegister(), $workerId);
        });
    }

    private function registerAllCreativeItems() : void{
        $originItems = CreativeInventory::getInstance()->getAll();

        CreativeInventory::reset();
        $inv = CreativeInventory::getInstance();
        foreach($originItems as $item){
            if(!$inv->contains($item)){
                $inv->add($item);
            }
        }
    }
}