<?php

namespace App\Actions\LuckyDraw;

class NumberGenerator
{
    public static function generate(): int
    {
        return rand(1, 1000);
    }
}
