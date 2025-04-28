<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


/**
 * @property int $id
 * @property int $user_id
 * @property string $uuid
 * @property bool $is_active
 * @property Carbon $expires_at
 */
class UniqueLink extends Model
{
    use HasFactory;

    protected $table = 'unique_links';

    protected $fillable = [
        'user_id',
        'uuid',
        'is_active',
        'expires_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function findByUuid(string $uuid): self
    {
        return self::where('uuid', $uuid)->firstOrFail();
    }

    public function scopeActiveAndNotExpired($query)
    {
        return $query->where('is_active', true)
            ->where('expires_at', '>', now());
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
