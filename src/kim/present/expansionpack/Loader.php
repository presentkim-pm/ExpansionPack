<?php
declare(strict_types=1);

namespace kim\present\expansionpack;

use kim\present\expansionpack\task\RuntimeIdsRegister;
use pocketmine\inventory\CreativeInventory;
use pocketmine\plugin\PluginBase;

final class Loader extends PluginBase{
    protected function onLoad() : void{
        //TODO: register blocks
        //TODO: register items
        $this->registerAllRuntimeIds();
        $this->registerAllCreativeItems();
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