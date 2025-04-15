<?php

namespace App\Enums;

enum ShipmentStatus: string
{
    case PAYED = 'payed';
    case PENDINGPAYED = 'pending';
    case NOTPAYED = 'notPayed';
}
