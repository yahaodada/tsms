<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guan extends Model
{
    	// 设置表名
    protected $table='guanliyuan';
    // 设置主键id
    protected $primaryKey='guan_id';
    public $timestamps=false;
    // 设置黑名单
    protected $guarded=[];
}
