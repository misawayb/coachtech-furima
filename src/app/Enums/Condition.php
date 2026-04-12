<?php

namespace App\Enums;

enum Condition: string
{
    case GoodCondition = '良好';
    case NoScratches = '目立った傷や汚れなし';
    case SlightScratches = 'やや傷や汚れあり';
    case BadCondition = '状態が悪い';
}