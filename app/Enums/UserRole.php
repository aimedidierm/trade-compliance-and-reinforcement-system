<?php

namespace App\Enums;

enum UserRole: string
{
    case SELLER = 'seller';
    case EXPORTER = 'exporter';
    case MINICOM = 'minicom';
}
