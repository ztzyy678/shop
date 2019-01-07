@extends('admin.layout.index')

@section ('content')
			<!-- 验证字段不为空 -->
			<div>
				@if ($errors->any())
    				<div class="alert alert-danger">
       				 	<ul>
           				 @foreach ($errors->all() as $error)
                			<li>{{ $error }}</li>
            			@endforeach
        				</ul>
    				</div>
				@endif

			</div>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>{{ $list_name or ''}}</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable ">
						  <thead>
						  	<form action="/admin/goods/{{ $data->id }}" method="post">
						  		{{ csrf_field() }}
						  		{{ method_field('PUT') }}
						  		
						  		 <tr>
								  <th>商品名称</th>
								  <td><input type="text" name="goods_name" placeholder="{{ $data->goods_name}}"></td>
							  </tr>
							  <tr>
								  <th>商品价格</th>
								  <td><input type="text" name="goods_price" placeholder="{{ $data->goods_price}}"></td>
							  </tr>
							  <tr>
								  <th>商品库存</th>
								  <td><input type="text" name="inventory" placeholder="{{ $data->inventory}}"></td>
							  </tr>
							  <tr>
								  <th>商品标题</th>
								  <td><input type="text" name="goods_title" placeholder="{{ $data->goods_title }}"></td>
							  </tr>
							  <tr>
								  <th>商品尺码</th>
								  <td><input type="text" name="goods_size" placeholder="{{ $data->goods_size }}"></td>
							  </tr>
							  <tr>
								  <th>商品状态</th>
								  <td><input type="text" name="staus" placeholder="{{ $data->staus}} "></td>
							  </tr>
							 <!--  <tr>
								  <th>商品分类</th>
								  <td><input type="text" name="" value="{{ $data->goods_name}}"></td>
							  </tr> -->
							  <!-- <tr>
								  <th>商品图片</th>
								  <td><input type="text" name="" value="{{ $data->goods_name}}"></td>
							  </tr> -->
							  <tr>
								<th></th>
								<th>
									<button type="submit" class="btn btn-primary">保存</button>
								</th>
							</tr>
						  	</form>
							 
						  </thead>   
						  <tbody>

						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			@endsection