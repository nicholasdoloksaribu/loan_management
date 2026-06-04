<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'loan_id',
    'transaction_date',
    'customer_id',
    'customer_name',
    'currency_id',
    'currency_name',
    'paid_amount',
    'os_balance',
])]
class Payment extends Model
{
    //
}
