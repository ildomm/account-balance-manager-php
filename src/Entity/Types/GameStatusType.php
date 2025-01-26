<?php

namespace App\Entity\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class GameStatusType extends StringType
{
    const GAME_STATUS = 'game_statuses';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (string)$value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string)$value;
    }
}
