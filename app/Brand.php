<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table='brand';
    // 主键
    protected $primarykey='brand_id';
    public $timestamps=false;
    protected $guarded=[]; 
}
