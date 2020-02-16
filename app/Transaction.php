<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount', 'operator_id', 'phone', 'type', 'user_id'
    ];
}
