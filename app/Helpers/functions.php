<?php

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
//无限极分类
function getcategory($data,$p_id=0,$level=1){
    if(!$data){
        return;
    }
    static $info=[];
    foreach($data as $k=>$v){
        if ($v->p_id==$p_id) {
            $v->level=$level;
            $info[]=$v;
            getcategory($data,$v->cate_id,$level+1);  
        }
    }
    return $info;
}
//文件上传
function upload($filename){
        if (request()->file($filename)->isValid()) {
            $res=request()->file($filename);
            $ass=$res->store('uploads');
            return $ass;
        }
        exit('为获取上传文件或文件上传出错');    
}
//多文件上传
function uploads($filename){
    //接受数组
    $imgs=request()->file($filename);
    if(!is_array($imgs)){
        return;
    }
    foreach ($imgs as $k => $v) {
        if ($v->isValid()) {
            $ass[]=$v->store('uploads');
        }
    }
    return $ass;       
        // exit('为获取上传文件或文件上传出错');
}