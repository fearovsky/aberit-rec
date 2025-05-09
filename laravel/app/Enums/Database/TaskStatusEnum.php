<?php

namespace Laravel\App\Enums\Database;

enum TaskStatusEnum: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case ON_HOLD = 'on_hold';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
