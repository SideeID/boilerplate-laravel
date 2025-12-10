<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterDepartemen extends Model
{
    protected $table = 'master_departemens';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function lowongans(): HasMany
    {
        return $this->hasMany(MasterLowongan::class, 'dept_id');
    }
}
