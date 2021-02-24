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
use kim\present\expansionpack\BlockIds;
use kim\present\expansionpack\ItemIds;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Flowable;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\entity\Entity;
use pocketmine\event\block\BlockGrowEvent;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Fertilizer;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

use function mt_rand;

class SweetBerryBush extends Flowable{
    protected int $age = 0;

    protected function writeStateToMeta() : int{
        return $this->age;
    }

    public function readStateFromData(int $id, int $stateMeta) : void{
        $this->setAge(BlockDataSerializer::readBoundedInt("age", $stateMeta, 0, 4));
    }

    public function getStateBitmask() : int{
        return 0b11;
    }

    public function getAge() : int{
        return $this->age;
    }

    /** @return $this */
    public function setAge(int $age) : self{
        if($age < 0 || $age > 3){
            throw new InvalidArgumentException("Age must be in range 0-3");
        }
        $this->age = $age;

        $this->breakInfo = $this->age < 1 ? BlockBreakInfo::instant() : new BlockBreakInfo(0.25);
        return $this;
    }

    public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
        if($this->isValidFloorBlock($blockReplace->getSide(Facing::DOWN))){
            return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
        }

        return false;
    }

    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
        if($this->age < 3 && $item instanceof Fertilizer){
            $block = clone $this;
            $block->age += mt_rand(1, 2);
            if($block->age > 3){
                $block->age = 3;
            }

            $ev = new BlockGrowEvent($this, $block);
            $ev->call();
            if(!$ev->isCancelled()){
                $this->pos->getWorld()->setBlock($this->pos, $ev->getNewState());
            }

            $item->pop();

            return true;
        }elseif($this->age > 1){
            $block = clone $this;
            $block->setAge(1);
            $this->pos->getWorld()->setBlock($this->pos, $block);

            $pos = $this->getPos();
            $dropPos = $pos->add(0.5, 0.5, 0.5);
            foreach($this->getDropsForCompatibleTool($item) as $drop){
                if(!$drop->isNull()){
                    $pos->getWorld()->dropItem($dropPos, $drop);
                }
            }
            return true;
        }

        return false;
    }

    public function onNearbyBlockChange() : void{
        if(!$this->isValidFloorBlock($this->getSide(Facing::DOWN))){
            $this->pos->getWorld()->useBreakOn($this->pos);
        }
    }

    public function hasEntityCollision() : bool{
        return true;
    }

    public function onEntityInside(Entity $entity) : bool{
        if($this->age > 0){
            $ev = new EntityDamageByBlockEvent($this, $entity, EntityDamageEvent::CAUSE_CONTACT, 1);
            $entity->attack($ev);

            $entity->resetFallDistance();
        }
        return true;
    }

    public function ticksRandomly() : bool{
        return true;
    }

    public function onRandomTick() : void{
        if($this->age < 3 && mt_rand(0, 4) === 1){
            $block = clone $this;
            ++$block->age;
            $ev = new BlockGrowEvent($this, $block);
            $ev->call();
            if(!$ev->isCancelled()){
                $this->pos->getWorld()->setBlock($this->pos, $ev->getNewState());
            }
        }
    }

    public function getDropsForCompatibleTool(Item $item) : array{
        if($this->age < 2){
            return [];
        }elseif($this->age < 3){
            return [ItemFactory::getInstance()->get(ItemIds::SWEET_BERRIES, 0, mt_rand(1, 2))];
        }else{
            return [ItemFactory::getInstance()->get(ItemIds::SWEET_BERRIES, 0, mt_rand(2, 3))];
        }
    }

    public function isValidFloorBlock(Block $block) : bool{
        $id = $block->getId();
        return $id === BlockIds::GRASS || $id === BlockIds::DIRT;
    }
}