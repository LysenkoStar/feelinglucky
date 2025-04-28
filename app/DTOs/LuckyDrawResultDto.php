<?php

namespace App\DTOs;

class LuckyDrawResultDto
{
    public function __construct(
        public int $number,
        public bool $isWin,
        public float $winAmount
    ) {}

    public function toArray(): array
    {
        return [
            'number' => $this->number,
            'result' => $this->isWin ? 'Win' : 'Lose',
            'win_amount' => $this->winAmount,
        ];
    }
}
