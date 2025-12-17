<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'sparepart_id',
        'user_id',
        'quantity',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }

    /**
     * Get the sparepart that owns the transaction.
     */
    public function sparepart(): BelongsTo
    {
        return $this->belongsTo(Sparepart::class);
    }

    /**
     * Get the user that owns the transaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if this is a stock-in transaction.
     */
    public function isStockIn(): bool
    {
        return $this->type === 'masuk';
    }

    /**
     * Check if this is a stock-out transaction.
     */
    public function isStockOut(): bool
    {
        return $this->type === 'keluar';
    }
}
