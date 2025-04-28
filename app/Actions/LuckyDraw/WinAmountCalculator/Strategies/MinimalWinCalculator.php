<?php

namespace App\Actions\LuckyDraw\WinAmountCalculator\Strategies;

class MinimalWinCalculator implements WinCalculatorInterface
{
    public function calculate(int $number): float
    {
        return $number * 0.1;
    }
}
