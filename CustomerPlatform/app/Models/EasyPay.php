<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EasyPay extends Model
{
    protected $fillable = [
        'customerId',
        'splynx_id',
        'easypay_number',
        'reciever_id',
        'charachter_length',
        'check_digit',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
