<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cangku extends Model
{
     // 设置表名
    protected $table='cangku';
    // 设置主键id
    protected $primaryKey='cang_id';
    public $timestamps=false;
    // 设置黑名单
    protected $guarded=[];
}
