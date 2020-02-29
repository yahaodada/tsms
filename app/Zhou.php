<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zhou extends Model
{
	// 设置表名
    protected $table='zhou';
    // 设置主键id
    protected $primaryKey='id';
    public $timestamps=false;
    // 设置黑名单
    protected $guarded=[];
}
