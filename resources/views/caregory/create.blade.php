<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>分类</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>添加分类</h1></center>
<form  action="{{url('/caregory/store')}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="cate_name" id="optionsRadios1" 
				   placeholder="请输入分类名称">
			<b style="color:red">{{$errors->first('cate_name')}}</b>	   
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="radio">
    <label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cate_show" id="optionsRadios1" value="1" >是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="cate_show" id="optionsRadios1" value="2" checked>否
        
    </label>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否导航显示</label>
		<div class="radio">
    <label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cate_nav_show" id="optionsRadios1" value="1" >是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="cate_nav_show" id="optionsRadios1" value="2" checked>否
        
    </label>
	</div><br>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">所属分类</label>
		<div class="col-sm-8">
			<select class="form-control"id="optionsRadios1" name="p_id">
				<option value="0">顶级分类</option>
				@foreach($res as $k=>$v)
				<!-- {volist name="info" id="v"} -->
					<option value="{{$v->cate_id}}">{{str_repeat("--",($v->level*2))}}

						|{{$v->cate_name}}</option>
				<!-- {/volist} -->
				@endforeach
			</select>
		</div>
	</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加<tton>
		</div>
	</div>
</form>
</body>
</html>
