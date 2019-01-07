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
				<form action="{{asset('admin/link') }}" method="post" enctype="multipart/form-data">
					
					{{ csrf_field() }}
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
						  </thead>   
						  <tbody>
							<div>
						  		<tr>
								 <th>链接名称</th>
								  <td><input type="" name="link_name" style="width: 300px"></td>
								</tr>
								<tr>
								<th>链接地址</th>
								  <td><input type="" name="link_href" style="width: 500px"></td>
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

