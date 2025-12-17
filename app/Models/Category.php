<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'warna',
    ];

    /**
     * Get the spareparts for the category.
     */
    public function spareparts(): HasMany
    {
        return $this->hasMany(Sparepart::class);
    }

    /**
     * Get count of spareparts in this category.
     */
    public function getSparepartCountAttribute(): int
    {
        return $this->spareparts()->count();
    }
}
