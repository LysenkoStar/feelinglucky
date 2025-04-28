<?php

namespace App\Actions\LuckyDraw\WinAmountCalculator\Strategies;

class LowWinCalculator implements WinCalculatorInterface
{
    public function calculate(int $number): float
    {
        return $number * 0.3;
    }
}
