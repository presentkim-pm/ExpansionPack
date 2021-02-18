<?php
declare(strict_types=1);

namespace kim\present\expansionpack;

use pocketmine\inventory\CreativeInventory;
use pocketmine\plugin\PluginBase;

final class Loader extends PluginBase{
    protected function onLoad() : void{
        //TODO: register blocks
        //TODO: register items
        //TODO: register block runtime ids
        $this->registerAllCreativeItems();
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