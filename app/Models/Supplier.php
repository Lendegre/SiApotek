<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $primaryKey = 'supplier_id';
    protected $table = 'supplier';
    protected $fillable = [
        'nama_supplier',
        'nama_sales',
        'no_telp',
        'alamat'
    ];
}
