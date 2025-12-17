<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sparepart extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'spareparts';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode_part',
        'nama_barang',
        'merk',
        'stok',
        'harga',
        'category_id',
        'lokasi_rak',
        'stok_minimum',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'stok' => 'integer',
            'harga' => 'decimal:2',
            'stok_minimum' => 'integer',
        ];
    }

    /**
     * Get the category that owns the sparepart.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all transactions for this sparepart.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Check if stock is low (at or below minimum).
     */
    public function isLowStock(): bool
    {
        return $this->stok <= $this->stok_minimum;
    }

    /**
     * Check if out of stock.
     */
    public function isOutOfStock(): bool
    {
        return $this->stok <= 0;
    }

    /**
     * Get total stock value (stok * harga).
     */
    public function getValueAttribute(): float
    {
        return $this->stok * $this->harga;
    }
}
