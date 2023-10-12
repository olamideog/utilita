<?php

namespace App\Enums;

enum ReconciliationStatus: int
{
    case PENDING = 0;
    case RESOLVED = 1;

    const DEFAULT = self::PENDING;

    public function title(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::RESOLVED => 'Resolved',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::PENDING => 'badge-secondary',
            self::RESOLVED => 'badge-success',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::PENDING => 'dripicons-case',
            self::RESOLVED => 'dripicons-checkmark',
        };
    }
}
