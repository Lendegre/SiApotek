<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barangmasuk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'barangmasuks';
    protected $fillable = [
        // 'purchase_id',
        'no_faktur',
        'nama_brg',
        'tgl_trm',
        'tgl_tempo',
        'sbayar',
        'jumlah_trm',
        'h_beli',
        'purchase_product_id',
        'total',
        'g_total',
    ];

    // table relation with supplier
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(purchase::class, 'purchase_id');
    }

    public function purchaseproduct(): BelongsTo
    {
        return $this->belongsTo(purchase_product::class, 'purchase_product_id');
    }
}
