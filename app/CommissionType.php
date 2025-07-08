<?php

namespace App;

enum CommissionType: string
{
    case DIRECT = 'direct';
    case LAYER1 = 'layer1';
    case LAYER2 = 'layer2';
    case TEAM = 'team';

    public static function values(): array
    {
        return [
            self::DIRECT->value,
            self::LAYER1->value,
            self::LAYER2->value,
            self::TEAM->value,
        ];
    }
}
