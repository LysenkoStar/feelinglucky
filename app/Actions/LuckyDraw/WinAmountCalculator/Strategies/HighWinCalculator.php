<?php

namespace App\Actions\LuckyDraw\WinAmountCalculator\Strategies;

class HighWinCalculator implements WinCalculatorInterface
{
    public function calculate(int $number): float
    {
        return $number * 0.7;
    }
}
