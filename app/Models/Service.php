<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function servuser()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function servpaycontrol()
    {
        return $this->hasMany('App\Models\Paymentcontrol');
    }
}
