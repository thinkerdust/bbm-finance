<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produksi extends Model
{
    use SoftDeletes;
    protected $table = "produksi";
    protected $dates = ['deleted_at'];
}
