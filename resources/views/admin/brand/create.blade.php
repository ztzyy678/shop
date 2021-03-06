@extends('admin.layout.index')

@section ('content')
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
			<div class="box-content">
				<form action="{{asset('admin/brand') }}" method="post" enctype="multipart/form-data">
					
					{{ csrf_field() }}
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
						  </thead>   
						  <tbody>
							<div>
						  		<tr>
								 <th>品牌名称</th>
								  <td><input type="" name="brand_name" style="width: 300px"></td>
								</tr>
								<tr>
								 <th>品牌图片</th>
								  <td><label for="file"></label>
       								 <input id="file" type="file" class="form-control" multiple name="brand_img" required accept='image/*'></td>
								</tr>
								<tr>
								
						  	</div>
						  </tbody>
							<tr>
								<th></th>
								<th>
									<button type="submit" class="btn btn-primary">保存</button>
								</th>
							</tr>
					</table>

				</form>    
					
			</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

@endsection

