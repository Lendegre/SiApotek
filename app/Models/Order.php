<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'no_order',
        'customer_id',
        'barang_id',
        'isi',
        'harga',
    ];

    // relationship with barang
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    // relationship with bentuk sediaan
    public function bentuk(): BelongsTo
    {
        return $this->belongsTo(Bentuk::class, 'bentuk_id');
    }
    // relationship with bentuk customer
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
