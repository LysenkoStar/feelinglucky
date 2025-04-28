<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\UniqueLink;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UniqueLinkService
{
    public function create(RegisterRequest $request): UniqueLink
    {
        $data = $request->validated();

        $user = User::create($data);

        return UniqueLink::create([
            'user_id' => $user->id,
            'expires_at' => now()->addDays(7),
        ]);
    }
    /**
     * @param string $uuid
     * @return UniqueLink
     * @throws Exception
     */
    public function regenerate(string $uuid): UniqueLink
    {
        try {
            $link = UniqueLink::findByUuid($uuid);

            $link->update([
                'uuid' => Str::uuid(),
                'expires_at' => now()->addDays(7),
                'is_active' => true,
            ]);

            return $link;
        } catch (Exception $e) {
            Log::error('Error regenerating link: ' . $e->getMessage());
            throw new Exception('Error regenerating link');
        }
    }

    /**
     * @param string $uuid
     * @return UniqueLink
     * @throws Exception
     */
    public function deactivate(string $uuid): UniqueLink
    {
        try {
            $link = UniqueLink::findByUuid($uuid);

            $link->is_active = false;
            $link->save();

            return $link;
        } catch (Exception $e) {
            Log::error('Error deactivating link: ' . $e->getMessage());
            throw new Exception('Error deactivating link');
        }
    }
}
