@extends('admin.layout.index')

@section ('content')

			<div class="row-fluid sortable" style="overflow:auto">		
				<div class="box span12" style="overflow:auto">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>{{ $list_name or ''}}</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">

						  <thead>
							  <tr>
							  	  <th>id</th>
								  <th>商品名称</th>
								  <th>商品价格</th>
								  <th>商品库存</th>
								  <th>商品状态</th>
								  <th>操作</th>
							  </tr>
						  </thead>   
						  <tbody>
						  	@foreach($data as $k=>$v)
							<tr>
								<td class="center">{{ $v->id }}</td>
								<td class="center">{{ $v->goods_name }}</td>
								<td class="center">{{ $v->goods_price }}</td>
								<td class="center">{{ $v->inventory }}件</td>
								<td class="center">{{ $v->staus ? '待售' : '上架' }}</td>
								<td class="center">
									<a class="btn btn-success" href="goods/{{ $v->id }}">
										<i class="halflings-icon white zoom-in" title="查看详情"></i>                                            
									</a>




									<a class="btn btn-info" href="goods/{{ $v->id }}/edit">
										<i class="halflings-icon white edit" title="修改"></i>                                            
									</a>



									<form style="display: inline-block;" action="/admin/goods/{{$v->id}}" method="post">
										{{	csrf_field() }}
										{{ method_field('DELETE') }}

									<button class="btn btn-danger" id="delete" onclick="demo({{$v->id}})"><i class="halflings-icon white trash" title="删除"></i></button>	
									
									</form>

									
								</td>
							</tr>
							@endforeach
						  </tbody>
					  </table>            
					</div>
				</div>
			
			</div>

			@endsection

								
