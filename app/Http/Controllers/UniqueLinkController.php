<?php

namespace App\Http\Controllers;

use App\Models\LuckyHistory;
use App\Models\UniqueLink;
use App\Services\LuckyDrawService;
use App\Services\UniqueLinkService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UniqueLinkController extends Controller
{
    public function __construct(
        private readonly UniqueLinkService $uniqueLinkService,
        private readonly LuckyDrawService $luckyDrawService
    )
    {
    }

    public function show($uuid)
    {
        $link = UniqueLink::where('uuid', $uuid)
            ->activeAndNotExpired()
            ->firstOrFail();

        if (! $link) {
            abort(404, 'The link is expired or inactive.');
        }

        return view('link', compact('link'));
    }

    public function regenerate(string $uuid): RedirectResponse
    {
        try {
            $link = $this->uniqueLinkService->regenerate($uuid);

            return redirect()->route('link.show', $link->uuid);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to regenerate link: ' . $e->getMessage()]);
        }
    }

    /**
     * @param string $uuid
     * @return RedirectResponse
     */
    public function deactivate(string $uuid): RedirectResponse
    {
        try {
            $this->uniqueLinkService->deactivate($uuid);

            return redirect('/');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to deactivate link: ' . $e->getMessage()]);
        }
    }

    public function lucky(string $uuid): JsonResponse
    {
        try {
            $resultDto = $this->luckyDrawService->play($uuid);

            return response()->json($resultDto->toArray());
        } catch (\Throwable $exception) {
            report($exception);

            return response()->json([
                'message' => 'Unexpected error occurred',
            ], 500);
        }
    }

    public function history(string $uuid): JsonResponse
    {
        try {
            $history = $this->luckyDrawService->history($uuid);

            return response()->json($history);
        } catch (\Throwable $exception) {
            report($exception);

            return response()->json([
                'message' => 'Unexpected error occurred',
            ], 500);
        }

    }
}
