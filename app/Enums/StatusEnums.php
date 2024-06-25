<?php
//We first declare the namespace for the enums
namespace App\Enums;

enum StatusEnums: string{
    case PENDING = 'pending';

    case COMPLETED = 'completed';

    case CANCELLED = 'cancelled';

    case DECLINED = 'declined';
}
