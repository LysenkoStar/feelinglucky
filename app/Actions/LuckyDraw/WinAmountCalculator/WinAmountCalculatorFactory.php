<?php

namespace App\Actions\LuckyDraw\WinAmountCalculator;

use App\Actions\LuckyDraw\WinAmountCalculator\Strategies\HighWinCalculator;
use App\Actions\LuckyDraw\WinAmountCalculator\Strategies\LowWinCalculator;
use App\Actions\LuckyDraw\WinAmountCalculator\Strategies\MediumWinCalculator;
use App\Actions\LuckyDraw\WinAmountCalculator\Strategies\MinimalWinCalculator;
use App\Actions\LuckyDraw\WinAmountCalculator\Strategies\WinCalculatorInterface;

class WinAmountCalculatorFactory
{
    public static function getCalculator(int $number): WinCalculatorInterface
    {
        return match (true) {
            $number > 900 => new HighWinCalculator(),
            $number > 600 => new MediumWinCalculator(),
            $number > 300 => new LowWinCalculator(),
            default => new MinimalWinCalculator(),
        };
    }
}
