<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 设置表名
    protected $table='category';
    // 设置主键id
    protected $primaryKey='cate_id';
    public $timestamps=false;
    // 设置黑名单
    protected $guarded=[];
}
