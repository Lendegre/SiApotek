<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faktur extends Model
{
    use HasFactory;
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    
    // public function purchase_product(): BelongsTo
    // {
    //     return $this->belongsTo(PurchaseProduct::class, 'purchase_product_id');
    // }


    


}
