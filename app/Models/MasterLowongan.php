<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterLowongan extends Model
{
    protected $table = 'master_lowongans';

    protected $fillable = [
        'dept_id',
        'posisi',
        'quota',
        'deskripsi',
        'user_create',
        'user_update',
    ];

    protected $casts = [
        'dept_id' => 'integer',
        'quota' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function departemen(): BelongsTo
    {
        return $this->belongsTo(MasterDepartemen::class, 'dept_id');
    }

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(TransaksiPendaftaran::class, 'id_lowongan');
    }
}
