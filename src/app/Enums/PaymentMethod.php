<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case ConvenienceStore = 'コンビニ支払い';
    case CreditCard = 'カード支払い';
}
