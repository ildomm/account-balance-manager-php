<?php

namespace App\Entity\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class TransactionSourceType extends StringType
{
    const TRANSACTION_SOURCE = 'transaction_sources';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (string)$value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string)$value;
    }
}
