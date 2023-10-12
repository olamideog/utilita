<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case UNPAID = 0;
    case PAID = 1;

    const DEFAULT = self::UNPAID;

    public function title(): string
    {
        return match ($this) {
            self::UNPAID => 'Unpaid',
            self::PAID => 'Paid',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::UNPAID => 'badge-secondary',
            self::PAID => 'badge-success',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::UNPAID => 'dripicons-case',
            self::PAID => 'dripicons-checkmark',
        };
    }
}
