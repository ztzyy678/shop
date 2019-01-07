<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // 获取数据库信息
        $data = DB::table('advertisement')->get();

        // 加载视图
        return view ('admin.advertisement.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // 加载视图
        return view ('admin.advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取数据
         $data = $request->only('advertisement_img','advertisement_name');
         
      
         // 图片
        if($request->hasFile('advertisement_img'))
        {
            $profile = $request->file('advertisement_img');
            //获取图片后缀
            $ext = $profile->extension();
            //定义图片名称
            $name = time().rand().'.'.$ext;
            $res = $profile->storeAs('advertisement',$name);    
            $data['advertisement_img'] = $res;

            // 验证字段
            $this->validate($request, [
            'advertisement_name' => 'required',
            'advertisement_img' => 'required',
            ],
            [
                'advertisement_name.required'=>'名称必填',
                'advertisement_img.required'=>'图片必填',
            ]);
            
        

            // 添加数据库
            $res = DB::table('advertisement')->insert($data);
            if($res == true)
            {
                return redirect('admin/advertisement');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('advertisement')->where('id',$id)->delete();

        if($res){
            return redirect('admin/advertisement')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }
    }
}
