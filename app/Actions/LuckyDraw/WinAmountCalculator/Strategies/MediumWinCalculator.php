<?php

namespace App\Actions\LuckyDraw\WinAmountCalculator\Strategies;

class MediumWinCalculator implements WinCalculatorInterface
{
    public function calculate(int $number): float
    {
        return $number * 0.5;
    }
}
