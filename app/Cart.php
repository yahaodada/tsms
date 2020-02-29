<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table='cart';
    // 主键
    protected $primarykey='cart_id';
    public $timestamps=false;
    protected $guarded=[]; 
}
