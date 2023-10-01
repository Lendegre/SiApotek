<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $primaryKey = 'golongan_id';
    protected $table = 'golongan';
    protected $fillable = [
        'jenis_golongan',
    ];
}
