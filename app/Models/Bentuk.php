<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bentuk extends Model
{
    use HasFactory;
    protected $primaryKey = 'bentuk_id';
    protected $table = 'bentuk';
    protected $fillable = [
        'nama_bentuk'
    ];

    // table relation with satuan
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}

