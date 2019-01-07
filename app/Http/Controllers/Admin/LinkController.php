<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取数据库信息
        $data = DB::table('friendly_link')->get();

        // 加载视图
        return view ('admin.link.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载视图
        return view ('admin.link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data = $request->except('_token');

         // 验证字段
            $this->validate($request, [
            'link_name' => 'required',
            'link_href' => 'required',

                ],
            [
                'link_name.required'=>'名称必填',
                'link_href.required'=>'地址必填',
            ]);

           // 添加数据库
            $res = DB::table('friendly_link')->insert($data);
            if($res == true)
            {
                return redirect('admin/link');
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
         $res = DB::table('friendly_link')->where('id',$id)->delete();

        if($res){
            return redirect('admin/link')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }
    }
}
