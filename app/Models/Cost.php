<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class Cost extends Model
{
    use HasFactory, HasFormatRupiah, SearchableTrait;
    protected $guarded = [];
    protected $append = ['amount_name_full'];

    protected $searchable = [
        'columns' => [
            'name' => 10,
            'quantity' => 10
        ]
    ];

    protected function amountNameFull(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->name . ' - ' . $this->formatRupiah('quantity'),
        );
    }

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
