@extends('admin.layout.index')
@section('content')

   @if (session('success'))

      <div class="alert alert-success">

      {{ session('success') }}

      </div>

     @endif

  @if (session('error'))

     <div class="alert alert-success">

      {{ session('error') }}

      </div>
   @endif


		<div class="row-fluid sortable ui-sortable">
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2><i class="halflings-icon white edit"></i><span class="break">	</span>{{$title or '修改用户信息'}}</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="/admin/users/{{  $data->id   }}" enctype="multipart/form-data">

							{{csrf_field()}}

              {{ method_field('PUT') }}
							<fieldset>

								<div class="control-group">
								<label class="control-label" for="auth">权限</label>
								<div class="controls">
								  <select name="auth" id="auth">
								  	<option value="1" @if($data->auth=='1') selected  @endif> 普通管理员</option>
								  	<option value="2"   @if($data->auth=='2') selected  @endif>超级管理员</option>
								  </select>
								</div>
							  </div>


								<div class="control-group">
								<label class="control-label" for="username">
									登录名
								</label>
								<div class="controls">
								  <input class="input-xlarge focused"  value="{{$data->uname}}" name="uname" id="username" type="text" value="">
								  <span class="x-red" id="span_uname">6-15位字母数字下划线</span>
								</div>
							  </div>

							
							  	<div class="control-group">
								<label class="control-label" for="phone">电话</label>
								<div class="controls">
								  <input class="input-xlarge focused"  value="{{$data->tel}}" id="phone" type="number" name="tel" value="">
								   <span class="x-red" id="span_phone">6-15位字母数字下划线</span>
								</div>
							  </div>

							  	<div class="control-group">
								<label class="control-label" for="faceInput">头像</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="faceInput" type="file" name="face" value=""  accept='image/*'>
                  <img src="{{$data->face}}" width="60px">
								</div>
							  </div>

							    	<div class="control-group">
								<label class="control-label" for="L_pass">新密码</label>
								<div class="controls">
								  <input class="input-xlarge focused" name="pwd" id="L_pass" type="password" value="">
								   <span class="x-red" id="span_upwd">6-16位密码</span>
								</div>
							  </div>



							  	<div class="control-group">
								<label class="control-label" for="L_repass">确认密码</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="L_repass" type="password" name="repwd" value="">
								  <span class="x-red" id="span_repwd">再一次输入密码</span>
								</div>
							  </div>



							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">确认修改</button>
								
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div>
			    <script type="text/javascript">
			    	isL_repass=false;
      //检测用户名格式是否符合要求(6-15字母数字下划线)

      $('#username').blur(function()
          {
            var  user_val = $(this).val();

            var uname_preg = /^\w{6,15}$/;

            if(uname_preg.test(user_val)){

                $('#span_uname').html('格式正确');

                $('#span_uname').removeClass('x-red');
                	isUsername=true;
                  $('button').click(function(){

                return true;
              })

            }else{
              //如果格式不正确禁止表单提交

              $('#span_uname').html('您输入的用户名格式不正确');
              isUsername=false;

              //   $('button').click(function(){

              //   return false;
              // })
            }
          });

      //检测手机号格式是否正确
      $('#phone').blur(function()
          {
            var phone_val=$(this).val();
            // console.log(phone_val);
            var phone_preg=/^1[3456789]\d{9}$/;
            if(phone_preg.test(phone_val)){
              $('#span_phone').html('手机格式正确');

              $('#span_phone').removeClass('x-red');

                isPhone=true;
            }else{
              $('#span_phone').html('手机格式不正确');
                //如果格式不正确禁止表单提交
              //   $('button').click(function(){
              //   return false;
              // })
              isPhone=false;
            }
          })
      $('#L_email').blur(function()
          {
            var email_val=$(this).val();
            //匹配正则
            var email_preg=/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/;
            if(email_preg.test(email_val)){

               isL_email=true;
             $('#span_email').html('邮箱格式正确');
              $('#span_email').removeClass('x-red');
            }else{
              //如果验证失败 提示信息并禁止表单提交
                $('#span_email').html('您输入的邮箱名格式不正确');
                isL_email=false;
              //   $('button').click(function(){

              //   return false;
              // })

            }
          })

      //验证密码
      $('#L_pass').blur(function()

          { 
            upwd_val=$(this).val();
             
            var  upwd_preg=/^\w{6,16}$/;

            if(upwd_preg.test(upwd_val)){


             isL_pass=true;

               $('#span_upwd').html('密码符合');

               $('#span_upwd').removeClass('x-red');

            }else{

              $('#span_upwd').html('密码格式不正确');
              isL_pass=false;

              //   $('button').click(function(){
              //   	alert('密码必须填写')
              //  	return false;
              // })
            }

          })

      //验证两次密码是否一致

      $('#L_repass').blur(function()
          {
            var repwd=$(this).val();
            if(repwd==upwd_val){

              isL_repass=true;
              $('#span_repwd').html('密码一致')

              $('#span_repwd').removeClass('x-red');

            }else{

              $('#span_repwd').html('两次输入不一致')

              	isL_repass=false;

              //  $('button').click(function(){

              //   return false;
              // })
            }
          })

      			$('button').eq(0).click(function()
      				{

      					//如果所有字段都已验证通过可以表单提交
      						if(isUsername&&isPhone&&isL_email&&isL_pass&&isL_repass){
      							return true;
      						}else{
      							return false;
      						}
      				})

    </script>

@endsection