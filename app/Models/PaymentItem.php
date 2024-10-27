<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    protected $fillable = [
        'id_paymeny',
        'id_item',
        'amount'
    ]
}
