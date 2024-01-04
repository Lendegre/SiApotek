<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;
    protected $primaryKey = 'barang_id';
    protected $table = 'barang';
    protected $fillable = [
        'nama_barang',
        'tanggal_kedaluwarsa',
        'jumlah',
        'satuan_id',
        'isi',
        'harga_beli',
        'harga_jual',
        'satuan_jual',
        'minimal_stok',
        'kategori_id',
        'golongan_id'
    ];

    // table relation with supplier
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // table relation with satuan
    public function satuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    // table relation with bentuk sediaan
    // public function bentuk(): BelongsTo
    // {
    //     return $this->belongsTo(Bentuk::class, 'bentuk_id');
    // }

    // table relation with kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // table relation with golongan
    public function golongan(): BelongsTo
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }

    // table relation with Order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'id');
    }
}
