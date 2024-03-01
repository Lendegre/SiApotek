<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseProduct extends Model
{
    use HasFactory;
    protected $primaryKey = 'purchase_product_id';
    protected $table = 'purchase_product';
    protected $fillable = [
        'barang_id',
        'purchase_id',
        'satuan_beli',
        'jumlah',
        'isi',
        'bentuk',
        'zat',
    ];

    // relationship with barang
    // public function barang(): BelongsTo
    // {
    //     return $this->belongsTo(Barang::class, 'barang_id');
    // }
    
    public function faktur(): BelongsTo
    {
        return $this->belongsTo(Faktur::class, 'id');
    }
    // relationship with purchase

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }


    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    
    // public function faktur(): BelongsTo
    // {
    //     return $this->belongsTo(Faktur::class, 'id');
    // }
        


}
