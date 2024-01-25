<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;
    protected $primaryKey = 'satuan_id';
    protected $table = 'satuan';
    protected $fillable = [
        'satuan_barang'
    ];

    public function barang(): hasMany
    {
        return $this->hasMany(Barang::class);
    }

}
