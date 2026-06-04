<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['customer_name', 'birth_place', 'birth_date', 'no_identity', 'address', 'user_id'])]
class Customer extends Model
{
    //
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
