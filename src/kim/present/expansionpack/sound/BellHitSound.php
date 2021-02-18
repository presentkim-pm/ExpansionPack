<?php

declare(strict_types=1);

namespace kim\present\expansionpack\sound;

use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\world\sound\Sound;

class BellHitSound implements Sound{
    public function encode(?Vector3 $pos) : array{
        return [LevelSoundEventPacket::create(LevelSoundEventPacket::SOUND_BLOCK_BELL_HIT, $pos)];
    }
}
