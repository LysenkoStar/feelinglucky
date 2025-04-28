<?php

namespace App\Actions\LuckyDraw;

class WinDeterminer
{
    public static function determine(int $number): bool
    {
        return $number % 2 === 0;
    }
}
