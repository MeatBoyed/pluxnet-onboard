<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EasyPay extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'easypay';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customerId',
        'splynx_id',
        'easypay_number',
        'reciever_id',
        'charachter_length',
        'check_digit',
    ];
}
