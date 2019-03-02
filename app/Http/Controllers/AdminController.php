<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
             if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'admin' => '1'])) {
                //Session::put('adminSession',$data['email']);
				return redirect('/admin/dashboard');
            }else{
                return redirect('/admin')->with('flash_message_error','Geçersiz Kullanıcı adı veya Parola');
            }
        }
        return view('admin.admin_login');
    } 
	
	public function dashboard(){
		 //if(Session::has('adminSession')){
        //}else{
            //return redirect('/admin')->with('flash_message_error','Erişmek için giriş yapın');
        //}
        return view('admin.dashboard');
    }

    public function settings(){
        return view('admin.settings');
    }
	    
	public function chkPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else {
            echo "false"; die;
        }
	}	
	
	public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $check_password = User::where(['email' => Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password,$check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('id','1')->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success','Parola başarıyla güncellendi!');
            }else {
                return redirect('/admin/settings')->with('flash_message_error','girdiğiniz parola yanlış');
            }
        }
    }
	
	
    public function deleteCategory(Request $request, $id = null){
        if(!empty($id)){
            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Kategori başarıyla silindi.');
        }
    }
	
	public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Başarıyla çıkış yapıldı.'); 
    }
}
