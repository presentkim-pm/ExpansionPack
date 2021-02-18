<?php

declare(strict_types=1);

namespace kim\present\expansionpack\block;

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
use kim\present\expansionpack\utils\NetherTreeType;

class NetherVines extends Flowable{
    private NetherTreeType $treeType;

    protected int $age = 0;

    public function __construct(NetherTreeType $treeType){
        $this->treeType = $treeType;

        switch($treeType->id()){
            case NetherTreeType::CRIMSON()->id():
                $name = "Weeping Vines";
                break;
            case NetherTreeType::WARPED()->id():
                $name = "Twisting Vines";
                break;
            default:
                $name = "Nether Vines";
        }
        parent::__construct($treeType->getVinesIdentifier(), $name, BlockBreakInfo::instant());
    }

    protected function writeStateToMeta() : int{
        return $this->age;
    }

    public function readStateFromData(int $id, int $stateMeta) : void{
        $this->age = BlockDataSerializer::readBoundedInt("age", $stateMeta, 0, 25);
    }

    //NOTICE: 원래 0b11001(25)지만, PM이  0b1111(15)까지만 지원
    public function getStateBitmask() : int{
        return 0b1111;
    }

    public function getAge() : int{ return $this->age; }

    /** @return $this */
    public function setAge(int $age) : self{
        if($age < 0 || $age > 15){
            throw new \InvalidArgumentException("Age must be in range 0-15");
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
                $this->pos->getWorld()->setBlock($this->pos, $ev->getNewState());
            }

            $item->pop();

            return true;
        }

        return false;
    }

    public function onNearbyBlockChange() : void{
        $hangingBlock = $this->getSide($this->getHangingSide());
        if($hangingBlock->isTransparent() && !$hangingBlock instanceof NetherVines){
            $this->pos->getWorld()->useBreakOn($this->pos);
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
                $this->pos->getWorld()->setBlock($this->pos, $ev->getNewState());
            }
        }
    }

    public function getHangingSide() : int{
        switch($this->treeType->id()){
            case NetherTreeType::CRIMSON()->id():
                return Facing::UP;
            case NetherTreeType::WARPED()->id():
                return Facing::DOWN;
        }
        throw new AssumptionFailedError("Switch should cover all wood types");
    }
}