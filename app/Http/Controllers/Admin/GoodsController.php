<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取数据库信息
        $data = DB::table('goods')->get();

        // 加载视图
        return view ('admin.goods.index',['data'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载视图
        return view ('admin.goods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dump($request->except('_token'));
        // dump($request['staus']);

        // 获取数据
         $data = $request->except('_token');
        
        //判断文件
         $img = $request->hasFile('goods_img');

        if($request->hasFile('goods_img')){
            $profile = $request->file('goods_img');
            $arr = array();
            foreach ($profile as $key=>$value) 
            {

                //获取图片后缀
                $ext = $value->extension();
                //定义图片名称
                $name = time().rand().'.'.$ext;
                $res = $value->storeAs('goods',  $name);     
                $arr[] .= $res;
            } 

            $arr = implode('|@x@|',$arr);

            $data['goods_img'] = $arr;


            // 添加时间
            $created_at = date ('Y-m-d H:i:s',time());
            $data['created_at'] = $created_at;

            

        
            // 验证字段
            $this->validate($request, [
            'goods_name' => 'required',
            'goods_price' => 'required',
            'goods_title' => 'required',
            'inventory' => 'required',
            'goods_size' => 'required',
            // 'goods_img' => 'required',
                ],
            [
                'goods_name.required'=>'名称必填',
                'goods_price.required'=>'价格必填',
                'goods_title.required'=>'标题必填',
                'inventory.required'=>'库存必填',
                'goods_size.required'=>'尺寸必填',
                // 'goods_img.required'=>'图片必填',
            ]);
            
        

            // 添加数据库
            $res = DB::table('goods')->insert($data);
            if($res == true)
            {
                return redirect('admin/goods');
            }
        }
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 获取数据库信息
        $data = DB::table('goods')->where('id',$id)->first();

        $arr  = $data->goods_img;
        $arr = explode('|@x@|', $arr);


        // 加载视图
        return view ('admin.goods.show',['data'=>$data,'arr'=>$arr]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取数据库信息
        $data = DB::table('goods')->where('id',$id)->first();
        
        // 加载视图
        return view('admin.goods.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 接收数据

        $data = $request->except(['_token','_method']);
        $updated_at = date ('Y-m-d H:i:s',time());
        $data['updated_at'] = $updated_at;

        

        // 验证字段
        $this->validate($request, [
        'goods_name' => 'required',
        'goods_price' => 'required',
        'goods_title' => 'required',
        'inventory' => 'required',
        'goods_size' => 'required',
        // 'goods_img' => 'required',
            ],
            [
                'goods_name.required'=>'名称必填',
                'goods_price.required'=>'价格必填',
                'goods_title.required'=>'标题必填',
                'inventory.required'=>'库存必填',
                'goods_size.required'=>'尺寸必填',
                // 'goods_img.required'=>'图片必填',
            ]);

        // 修改进数据库
        $res  = DB::table('goods')->where('id',$id)->update($data);



        // 修改成功跳转
        if ($res == true) {
             return redirect('admin/goods');
        }else{
            return back();
        }
       
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $res = DB::table('goods')->where('id',$id)->delete();

        if($res){
            return redirect('admin/goods')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }
    }
}
