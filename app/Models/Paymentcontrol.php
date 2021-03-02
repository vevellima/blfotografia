<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentcontrol extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function paycontrolserv()
    {
        return $this->belongsTo('App\Models\Service');
    }
}
