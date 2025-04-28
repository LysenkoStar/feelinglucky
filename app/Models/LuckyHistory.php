<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $number
 * @property bool $is_win
 * @property float $win_amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class LuckyHistory extends Model
{
    use HasFactory;

    protected $table = 'lucky_histories';

    protected $fillable = [
        'user_id',
        'number',
        'is_win',
        'win_amount',
    ];

    protected $casts = [
        'is_win' => 'boolean',
        'win_amount' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
