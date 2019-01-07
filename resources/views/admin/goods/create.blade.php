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
				<form action="{{asset('admin/goods') }}" method="post" enctype="multipart/form-data">
					
					{{ csrf_field() }}
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
						  </thead>   
						  <tbody>
							<div>
						  		<tr>
								 <th>商品名称</th>
								  <td><input type="" name="goods_name" style="width: 300px"></td>
								</tr>
								<tr>
								<th>商品价格</th>
								  <td><input type="" name="goods_price" style="width: 100px">元</td>
								</tr>
								<tr>
								 <th>商品标题</th>
								  <td><input type="" name="goods_title" style="width: 300px"></td>
								</tr>
								<tr>
								 <th>商品库存</th>
								  <td><input type="" name="inventory" style="width: 100px">件</td>
								</tr>
								<tr>
								 <th>商品尺码</th>
								  <td>
								  	<select name="goods_size">
								  		<option>37</option>
								  		<option>38</option>
								  		<option>39</option>
								  		<option>40</option>
								  		<option>41</option>
								  		<option>42</option>
								  		<option>42.5</option>
								  		<option>43</option>
								  		<option>43.5</option>
								  		<option>44</option>
								  		<option>45</option>
								  	</select>
								  </td>
								</tr>
								<tr>
								 <th>商品状态</th>
								  <td>
								  	<select name="staus">
								  		<option>1</option>
								  		<option>2</option>
								  	</select>
								  </td>
								</tr>
								<tr>
								 <th>商品图片</th>
								  <td><label for="file"></label>
       								 <input id="file" type="file" class="form-control" multiple name="goods_img[]" required accept='image/*'></td>
								</tr>
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
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

@endsection

