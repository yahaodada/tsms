  @extends('layouts.shop')
  @section('title','登陆')
  @section('content')

     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('index/login')}}" method="post" class="reg-login">
      @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('/rlbg')}}">注册</a></h3>
      <div class="lrBox">
        <center><b style="color:red">{{session('errors')}}</b></center>
       <div class="lrList"><input type="text" placeholder="输入手机号码" name="user_tel"/></div>
       <div class="lrList"><input type="text" placeholder="输入密码" name="user_pwd"/></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即登录" />
      </div>
     </form><!--reg-login/-->
@endsection    