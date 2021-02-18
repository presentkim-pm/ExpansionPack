<?php

declare(strict_types=1);

namespace kim\present\expansionpack\block;

use kim\present\expansionpack\sound\BellHitSound;
use kim\present\expansionpack\utils\AttachmentableBlockTrait;
use pocketmine\block\Transparent;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class Bell extends Transparent{
    use AttachmentableBlockTrait;

    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
        $this->pos->getWorld()->addSound($this->pos, new BellHitSound());
        return true;
    }
}