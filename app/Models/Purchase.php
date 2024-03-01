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
        'status',
        'keterangan',
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

    public function faktur(): BelongsTo
    {
        return $this->belongsTo(faktur::class, 'id');
    }

    public function purchaseproduct(): BelongsTo
    {
        return $this->belongsTo(PurchaseProduct::class, 'purchase_product_id');
    }

}
