<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentForm extends Model
{
    use HasFactory;

    protected $table = 'paymentforms';

    public $timestamps = false;
}
