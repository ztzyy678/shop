<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\User\Admin_User;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //按每页5条分页
        $data = Admin_User::orderBy('id')->get();;
        // echo "<pre>";
       // var_dump($data[2]->created_at);exit();
        return view('admin/user/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       // dd(Admin_User::get());

       //判断是否有文件上传

        

       if($request->hasFile('face')){

       //选择上传的字段

       $data= $request->all(['uname','pwd','tel','auth']);

       $data['created_at']=date('Y-m-d H:i:s',time());

       $data['pwd']=Hash::make($data['pwd']);

       $file=$request->file('face');

       $file_name=date('YmdHis',time()).rand(1000,9999).'.'.$file->extension();

       // dd($file_name);

       $file_res=$file->storeAs('admin_face',$file_name);

       //把返回来的文件储存目录添加到data中

        $data['face']='/uploads/'.$file_res;

        // dd($data);
       $res=Admin_User::insert($data);
            if($res){
                return redirect('/admin/users')->with('success','添加成功');
            }else{
              return back()->with('error','保存失败!');  
            }

        }else{
            return back()->with('error','您未上传头像!');
        }
       // dump(1);
       // dump($request->file('face'));
      
       // dd($file_res);

        
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
      
        $data=Admin_User::find($id);
        // dd($data);
        return view('admin.user.edit',['data'=>$data]);
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
               
        //获取前台表单传递来的字段和ID
        $data = $request->all(['uname','tel','auth','pwd']);



        if(empty($data['pwd'])){
            $data=$request->all(['uname','tel','auth']);
            
        }else{
            $data['pwd']=Hash::make($data['pwd']);
        }

        //判断是否是文件上传如果有上传就修改face地址
         if($request->hasFile('face')){

                $file=$request->file('face');

               $file_name=date('YmdHis',time()).rand(1000,9999).'.'.$file->extension();

               // dd($file_name);

               $file_res=$file->storeAs('admin_face',$file_name);

               //把返回来的文件储存目录添加到data中

                $data['face']='/uploads/'.$file_res;
                        
            }


        $res = Admin_User::where('id',$id)->update($data);
            //判断是否修改成功
        if($res){

            return redirect('/admin/users')->with('success','修改成功');

        }else{
            return back()->with('error','修改失败');
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
        //
       $res = Admin_User::destroy($id);
       if($res){
        return redirect('admin/users')->with('success','删除成功');
       }else{
        return back()->with('error','删除失败');
       }
    }
}
