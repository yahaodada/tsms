<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table='admin';
    // 主键
    protected $primarykey='user_id';
    public $timestamps=false;
    protected $guarded=[]; 
}
