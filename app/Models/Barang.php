<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $primaryKey = 'barang_id';
    protected $table = 'barang';
    protected $fillable = [
        'nama_barang',
        'supplier_id',
        'tanggal_kedaluwarsa',
        'tanggal_masuk',
        'isi',
        'bentuk',
        'stok',
        'harga_jual',
        'satuan_jual',
        'minimal_stok',
        'satuan_id',
        'kategori_id',
        'golongan_id'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->tanggal_masuk = $model->created_at->toDateString();
        });

        self::updating(function ($model) {
            $model->tanggal_masuk = $model->updated_at->toDateString();
        });
    }

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

    public function purchaseproduct(): BelongsTo
    {
        return $this->belongsTo(purchaseproduct::class, 'purchase_product_id');
    }

    // table relation with bentuk sediaan
    public function bentuk(): BelongsTo
    {
        return $this->belongsTo(Bentuk::class, 'bentuk_id');
    }

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

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
