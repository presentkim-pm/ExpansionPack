<?php /** @noinspection PhpInternalEntityUsedInspection */
declare(strict_types=1);

namespace kim\present\expansionpack\task;

use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\scheduler\AsyncTask;

final class RuntimeIdsRegister extends AsyncTask{
    public function onRun() : void{
        self::register();
    }

    /**
     * Register all block runtime ids from canonical_block_states.nbt
     *
     * @noinspection PhpUnhandledExceptionInspection
     */
    public static function register() : void{
        $stringToLegacyMap = LegacyBlockIdToStringIdMap::getInstance()->getStringToLegacyMap();
        $runtimeBlockMapping = RuntimeBlockMapping::getInstance();

        $reflection = new \ReflectionClass($runtimeBlockMapping);
        $registerMappingMethod = $reflection->getMethod("registerMapping");
        $registerMappingMethod->setAccessible(true);
        $runtimeToLegacyMapProperty = $reflection->getProperty("runtimeToLegacyMap");
        $runtimeToLegacyMapProperty->setAccessible(true);

        $runtimeToLegacyMap = $runtimeToLegacyMapProperty->getValue($runtimeBlockMapping);
        $metaMap = [];
        foreach($runtimeBlockMapping->getBedrockKnownStates() as $runtimeId => $state){
            try{
                $name = $state->getString("name");
                if(!isset($stringToLegacyMap[$name]))
                    continue;

                $legacyId = $stringToLegacyMap[$name];
                if(!isset($metaMap[$legacyId])){
                    $metaMap[$legacyId] = 0;
                }

                $meta = $metaMap[$legacyId]++;
                if($meta > 0xf)
                    continue;

                /** @see RuntimeBlockMapping::$runtimeToLegacyMap */
                if(isset($runtimeToLegacyMap[$runtimeId]))
                    continue;

                /** @see RuntimeBlockMapping::registerMapping() */
                $registerMappingMethod->invokeArgs($runtimeBlockMapping, [$runtimeId, $legacyId, $meta]);
            }catch(\Exception $e){
            }
        }
    }
}