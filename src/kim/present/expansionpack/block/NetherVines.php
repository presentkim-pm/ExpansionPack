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

namespace kim\present\expansionpack\block;

use InvalidArgumentException;
use kim\present\expansionpack\utils\NetherTreeType;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Flowable;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\event\block\BlockGrowEvent;
use pocketmine\item\Fertilizer;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\AssumptionFailedError;
use pocketmine\world\BlockTransaction;

use function mt_rand;

class NetherVines extends Flowable{
    private NetherTreeType $treeType;

    protected int $age = 0;

    public function __construct(NetherTreeType $treeType){
        $this->treeType = $treeType;

        $name = match ($treeType->id()) {
            NetherTreeType::CRIMSON()->id() => "Weeping Vines",
            NetherTreeType::WARPED()->id() => "Twisting Vines",
            default => "Nether Vines"
        };
        parent::__construct($treeType->getVinesIdentifier(), $name, BlockBreakInfo::instant());
    }

    protected function writeStateToMeta() : int{
        return $this->age;
    }

    public function readStateFromData(int $id, int $stateMeta) : void{
        $this->age = BlockDataSerializer::readBoundedInt("age", $stateMeta, 0, 25);
    }

    /** NOTICE: Originally 0b11001 (25), but only supports PM up to 0b1111 (15) */
    public function getStateBitmask() : int{
        return 0b1111;
    }

    public function getAge() : int{ return $this->age; }

    /** @return $this */
    public function setAge(int $age) : self{
        if($age < 0 || $age > 15){
            throw new InvalidArgumentException("Age must be in range 0-15");
        }
        $this->age = $age;
        return $this;
    }

    public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
        $hangingBlock = $blockReplace->getSide($this->getHangingSide());
        if(!$hangingBlock->isTransparent() || $hangingBlock instanceof NetherVines){
            return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
        }

        return false;
    }

    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
        if($this->age < 15 && $item instanceof Fertilizer){
            $block = clone $this;
            $block->age += mt_rand(3, 7);
            if($block->age > 15){
                $block->age = 15;
            }

            $ev = new BlockGrowEvent($this, $block);
            $ev->call();
            if(!$ev->isCancelled()){
                $this->position->getWorld()->setBlock($this->position, $ev->getNewState());
            }

            $item->pop();

            return true;
        }

        return false;
    }

    public function onNearbyBlockChange() : void{
        $hangingBlock = $this->getSide($this->getHangingSide());
        if($hangingBlock->isTransparent() && !$hangingBlock instanceof NetherVines){
            $this->position->getWorld()->useBreakOn($this->position);
        }
    }

    public function ticksRandomly() : bool{
        return true;
    }

    public function onRandomTick() : void{
        if($this->age < 15 && mt_rand(0, 2) === 1){
            $block = clone $this;
            ++$block->age;
            $ev = new BlockGrowEvent($this, $block);
            $ev->call();
            if(!$ev->isCancelled()){
                $this->position->getWorld()->setBlock($this->position, $ev->getNewState());
            }
        }
    }

    public function getHangingSide() : int{
        return match ($this->treeType->id()) {
            NetherTreeType::CRIMSON()->id() => Facing::UP,
            NetherTreeType::WARPED()->id() => Facing::DOWN,
            default => throw new AssumptionFailedError("Should cover all wood types")
        };
    }
}