<?php

namespace App\Services;

use App\Actions\LuckyDraw\LuckyDrawAction;
use App\DTOs\LuckyDrawResultDto;
use App\Models\LuckyHistory;
use App\Models\UniqueLink;
use Illuminate\Support\Collection;

class LuckyDrawService
{
    public function __construct(
        protected LuckyDrawAction $luckyDrawAction
    ) {}

    public function play(string $uuid): LuckyDrawResultDto
    {
        return $this->luckyDrawAction->execute($uuid);
    }

    public function history(string $uuid): Collection
    {
        $link = UniqueLink::findByUuid($uuid);

        return LuckyHistory::where('user_id', $link->user_id)
            ->latest()
            ->take(3)
            ->get();
    }
}
