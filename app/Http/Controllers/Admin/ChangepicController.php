<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ChangepicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取数据库信息
        $data = DB::table('changepic')->get();

        // 加载视图
        return view ('admin.changepic.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // 加载视图
        return view ('admin.changepic.create');
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
         $data = $request->only('changepic_img','changepic_name');
         
      
         // 图片
        if($request->hasFile('changepic_img'))
        {
            $profile = $request->file('changepic_img');
            //获取图片后缀
            $ext = $profile->extension();
            //定义图片名称
            $name = time().rand().'.'.$ext;
            $res = $profile->storeAs('changepic',$name);    
            $data['changepic_img'] = $res;

            // 验证字段
            $this->validate($request, [
            'changepic_name' => 'required',
            'changepic_img' => 'required',
            ],
            [
                'changepic_name.required'=>'名称必填',
                'changepic_img.required'=>'图片必填',
            ]);
            
        

            // 添加数据库
            $res = DB::table('changepic')->insert($data);
            if($res == true)
            {
                return redirect('admin/changepic');
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
        $res = DB::table('changepic')->where('id',$id)->delete();

        if($res){
            return redirect('admin/changepic')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }
    }
}
