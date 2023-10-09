<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;
    protected $primaryKey = 'purchase_id';
    protected $table = 'purchase';
    protected $fillable = [
        'no_surat',
        'golongan_id',
        'supplier_id',
        'tgl_pengajuan',
        'status'
    ];

    // relationship with supplier
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // relationship with golongan
    public function golongan(): BelongsTo
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }
}
