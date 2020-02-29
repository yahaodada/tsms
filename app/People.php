<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{	
	// 设置表名
    protected $table='people';
    // 设置主键id
    protected $primaryKey='p_id';
    public $timestamps=false;
    // 设置黑名单
    protected $guarded=[];

}
