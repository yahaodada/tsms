<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table='users';
    // 主键
    protected $primarykey='user_id';
    public $timestamps=false;
    protected $guarded=[]; 
}
