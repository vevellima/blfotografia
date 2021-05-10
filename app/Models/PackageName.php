<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageName extends Model
{
    use HasFactory;

    protected $table = 'packagenames';

    public $timestamps = false;

    public function pkname()
    {
        return $this->hasMany(Package::class);
    }

}
