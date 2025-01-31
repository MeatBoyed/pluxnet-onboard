<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone_number',
        'street',
        'city',
        'zip_code',
        'agreed_terms', // Splynx Customer ID
        'tarrif', // Splynx Customer ID
        'splynx_id', // Splynx Customer ID
    ];  
    
    public function easypay(): HasMany
    {
        return $this->hasMany(EasyPay::class);
    }
}
