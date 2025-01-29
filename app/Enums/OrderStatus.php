<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Canceled = 'canceled';

    public function label(): string
    {
        return match ($this) {
          self::Pending=>'В ожидании',
          self::Approved=>'Подвержден',
          self::Canceled=>'Отменен',
        };
    }
}
