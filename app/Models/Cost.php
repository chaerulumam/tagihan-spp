<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cost extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user that owns the Cost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // event handler
    protected static function booted()
    {
        static::creating(function ($cost) {
            $cost->user_id = auth()->user()->id;
        });

        static::updating(function ($cost) {
            $cost->user_id = auth()->user()->id;
        });
    }
}
