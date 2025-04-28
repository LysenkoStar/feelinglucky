<?php

namespace App\Actions\LuckyDraw;

use App\Actions\LuckyDraw\WinAmountCalculator\WinAmountCalculatorFactory;
use App\DTOs\LuckyDrawResultDto;
use App\Models\LuckyHistory;
use App\Models\UniqueLink;

class LuckyDrawAction
{
    public function execute(string $uuid): LuckyDrawResultDto
    {
        $link = UniqueLink::where('uuid', $uuid)
            ->activeAndNotExpired()
            ->firstOrFail();

        $number = NumberGenerator::generate();
        $isWin = WinDeterminer::determine($number);
        $winAmount = 0;

        if ($isWin) {
            $calculator = WinAmountCalculatorFactory::getCalculator($number);
            $winAmount = $calculator->calculate($number);
        }

        LuckyHistory::create([
            'user_id' => $link->user_id,
            'number' => $number,
            'is_win' => $isWin,
            'win_amount' => $winAmount,
        ]);

        return new LuckyDrawResultDto(
            number: $number,
            isWin: $isWin,
            winAmount: round($winAmount, 2)
        );
    }
}
