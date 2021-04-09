<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function packagename()
    {
        return $this->belongsTo(PackageName::class);
    }

    public function servpackage()
    {
        return $this->hasMany(Service::class);
    }

}
