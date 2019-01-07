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
								  <th>所属分类</th>
								  <th>尺码</th>
								  <th>图片</th>

							  </tr>
						  </thead>   
						  <tbody>
						  	
							<tr>
								<td class="center">{{ $data->id }}</td>
								<td class="center">{{ $data->goods_name }}</td>
								<td class="center">分类</td>		
								<td class="center">{{ $data->goods_size }}</td>
								<td>
								@foreach($arr as $value)
								<img src="/uploads/{{ $value }}" width="60px">
								@endforeach
								</td>
							</tr>
							
						  </tbody>
					  </table>            
					</div>
				</div>
			
			</div>

			@endsection

								
