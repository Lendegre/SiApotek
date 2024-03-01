<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faktur extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'faktur';
    protected $fillable = [
        // 'purchase_id',
        'no_faktur',
        'image',
        'barang_id',
        'tgl_trm',
        'tgl_tempo',
        'sbayar',
        'jumlah_trm',
        'h_beli',
        'purchase_product_id',
        'total',
        'g_total',
    ];

    // table relation with purchase
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(purchase::class, 'purchase_id');
    }

    // table relation with purchaseproduct
    public function purchaseproduct(): BelongsTo
    {
        return $this->belongsTo(purchaseproduct::class, 'purchase_product_id');
    }

    // table relation with barang
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
