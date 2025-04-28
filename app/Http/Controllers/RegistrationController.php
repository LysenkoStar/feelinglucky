<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UniqueLinkService;
use Exception;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function __construct(private readonly UniqueLinkService $uniqueLinkService)
    {
    }

    public function showForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            $link = $this->uniqueLinkService->create($request);

            return redirect()->route('link.show', $link->uuid);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to create link: ' . $e->getMessage()]);
        }

    }
}
