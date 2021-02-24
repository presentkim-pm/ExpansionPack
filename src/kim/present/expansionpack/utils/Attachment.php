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

namespace kim\present\expansionpack\utils;

use pocketmine\math\Facing;

final class Attachment{
    public const FLOOR = 0;
    public const CEILING = 1;
    public const SINGLE_WALL = 2;
    public const DOUBLE_WALL = 3;

    /** @return int[] facing[] */
    public static function getHaningFaces(int $attachment, int $facing = Facing::NORTH) : array{
        if($attachment === self::FLOOR){
            return [Facing::DOWN];
        }elseif($attachment === self::CEILING){
            return [Facing::UP];
        }elseif($attachment === self::SINGLE_WALL){
            return [$facing];
        }elseif($attachment === self::DOUBLE_WALL){
            return [$facing, Facing::opposite($facing)];
        }
        return [];
    }
}