<?php

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