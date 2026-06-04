<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable([
    'customer_id',
    'customer_name',
    'currency_id',
    'currency_name',
    'transaction_date',
    'loan_amount',
    'previous_balance',
    'total_loan'
])]
class Loan extends Model
{
    //

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'currency_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
