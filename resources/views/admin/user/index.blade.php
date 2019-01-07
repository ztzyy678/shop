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


     					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
						  	
							  <tr>
							  	  <td>编号</td>
								  <th>姓名</th>
								  <th>创建日期</th>
								  <th>电话</th>
								  <th>角色</th>
								  <th>头像</th>
								  <th>操作</th>
							  </tr>
						  </thead>   
						  <tbody>
						  	@foreach($data as $k=>$v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->uname}}</td>
								<td class="center">{{$v->created_at}}</td>
								<td class="center">{{$v->tel}}</td>
								<td class="center">
									@if($v->auth=='1')
										<span class="label label-success">普通管理员</span>
										@else
										<span class="label label-success">超级管理员</span>
									@endif
									
								</td>
								<td>  <img src="{{$v->face}}" width="60px" > </td>
								<td class="center">
									<form style="display: inline-block;" action="/admin/users/{{$v->id}}/edit" method="get">
										
										

									<button class="btn btn-warning" id="update" >修改</button>	
									
									</form>
									<form style="display: inline-block;" action="/admin/users/{{$v->id}}" method="post">
										{{	csrf_field() }}
										{{ method_field('DELETE') }}

									<button class="btn btn-danger" id="delete" onclick="demo({{$v->id}})">删除</button>	
									
									</form>
								</td>
							</tr>
							@endforeach
						  </tbody>
					  </table>            
					</div>
					<script type="text/javascript">
						$.ajaxSetup({
		      			  headers: {
		            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		       			 }
						});
						// $('button').click(function(){return false});
						 function demo(id)
							{
								return confirm('确认删除吗?');
								// $.post('/admin/users/'+id,{'id':id,'_method':$('input:_method').val(),'_token':$('input:_token').val()},function(msg)
								// 	{
								// 		console.log(msg);
								// 	},'html')
								// alert(id);
								
							}
					</script>

@endsection