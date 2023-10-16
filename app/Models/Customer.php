<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'nama_customer',
        'usia',
        'alamat',
        'jenis_obat',
        'status',
        'total_harga'
    ];
}
