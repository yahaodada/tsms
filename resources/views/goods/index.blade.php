<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品展示</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>商品列表</h1></center>
  <table class="table">
	<thead>
		<tr>
			<th>商品id</th>
			<th>商品名字</th>
			<th>商品价格</th>
			<th>商品库存</th>
			<th>商品图片</th>
			<th>商品相册</th>
			<th>是否新品</th>
			<th>是否精品</th>
			<th>是否热卖</th>
			<th>是否上架</th>
			<th>商品品牌</th>
			<th>商品分类</th>
			<th>商品货号</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_num}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="50px" height="50px"></td>
			<td>
            @if($v->goods_imgs)
			@php $imgs=explode('|',$v->goods_imgs);@endphp
            
				@foreach($imgs as $kk=>$vv)
				<img src="{{env('UPLOAD_URL')}}{{$vv}}" width="50px" height="50px">
				@endforeach
			@endif
			</td>
			<td>{{$v->is_new==1?'√':'×'}}</td>
			<td>{{$v->is_best==1?'√':'×'}}</td>
			<td>{{$v->is_hot==1?'√':'×'}}</td>
			<td>{{$v->is_up==1?'√':'×'}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->goods_cargo}}</td>
			<td><a href="{{url('goods/edit/'.$v->goods_id)}}" class="btn btn-info">编辑</a>
				<a href="{{url('goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a></td>			
		</tr>
		@endforeach
		<tr><td colspan="7">{{$res->links()}}</td></tr>
	</tbody>
</table>

</body>
<ml>
