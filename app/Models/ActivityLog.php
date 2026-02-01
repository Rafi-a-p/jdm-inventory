<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'action',
        'subject_type',
        'subject_id',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'url',
        'method',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get human-readable action label.
     */
    public function getActionLabelAttribute(): string
    {
        return match ($this->action) {
            'login' => 'Login',
            'logout' => 'Logout',
            'create' => 'Tambah Data',
            'update' => 'Ubah Data',
            'delete' => 'Hapus Data',
            'view' => 'Lihat',
            'transaction_masuk' => 'Barang Masuk',
            'transaction_keluar' => 'Barang Keluar',
            default => ucfirst($this->action),
        };
    }

    /**
     * Get subject type label.
     */
    public function getSubjectTypeLabelAttribute(): string
    {
        return match ($this->subject_type) {
            'sparepart' => 'Sparepart',
            'transaction' => 'Transaksi',
            'category' => 'Kategori',
            'user' => 'User',
            default => $this->subject_type ?? '-',
        };
    }
}
