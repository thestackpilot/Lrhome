<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPayments extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'hash', 'order_data', 'order_response', 'payment_response', 'order_status', 'payment_status'];
}
