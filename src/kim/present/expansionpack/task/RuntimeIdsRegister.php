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
 * @noinspection PhpInternalEntityUsedInspection
 */

declare(strict_types=1);

namespace kim\present\expansionpack\task;

use Exception;
use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\scheduler\AsyncTask;

final class RuntimeIdsRegister extends AsyncTask{
    public function onRun() : void{
        self::register();
    }

    /** Register all block runtime ids from canonical_block_states.nbt */
    public static function register() : void{
        (function(){ //HACK : Closure bind hack to access inaccessible members
            $stringToLegacyMap = LegacyBlockIdToStringIdMap::getInstance()->getStringToLegacyMap();
            $metaMap = [];
            /** @see RuntimeBlockMapping::getBedrockKnownStates() */
            foreach($this->getBedrockKnownStates() as $runtimeId => $state){
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
                    if(isset($this->runtimeToLegacyMap[$runtimeId]))
                        continue;

                    $this->registerMapping($runtimeId, $legacyId, $meta);
                }catch(Exception){
                }
            }
        })->call(RuntimeBlockMapping::getInstance());
    }
}