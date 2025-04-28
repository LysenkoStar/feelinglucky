<?php

namespace App\Actions\LuckyDraw\WinAmountCalculator\Strategies;

interface WinCalculatorInterface
{
    public function calculate(int $number): float;
}
