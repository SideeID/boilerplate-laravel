<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiPendaftaran extends Model
{
    protected $table = 'transaksi_pendaftarans';

    protected $fillable = [
        'id_lowongan',
        'name',
        'gender',
        'dob',
        'address',
        'no_telp',
        'university',
        'major',
        'ipk',
        'status',
        'path_cv',
    ];

    protected $casts = [
        'id_lowongan' => 'integer',
        'dob' => 'date',
        'ipk' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(MasterLowongan::class, 'id_lowongan');
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'P');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'A');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'R');
    }
}
