<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
    	echo "这是商品详情页";
    }
    public function brands(){
    	return view('brand');
    }
    public function ass(){
    	echo "这是商品id";
    	echo "{$id}";
    }
}
