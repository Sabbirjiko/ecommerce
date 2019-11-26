<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'isadmin'=>'1'])) {
                Session::put('adminSession',$data['email']);
                return redirect()->route('admin_dashboard');
            }else{
                return redirect()->route('admin_login')->with('flash_error_message','Invalid Username Or Password');
            }
        }else{
            return view('admin.admin_login');
        }
        
    }

    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin_login')->with('flash_success_message','Logged Out Successfully!!');   
    }

    public function settings()
    {
        return view('admin.admin_settings');
    }
    public function check_pass(Request $request)
    {
        $data = $request->all();
        $given_pass = $data['current_pwd'];
        $user_pass = Auth::user()->password; 
        if (Hash::check($given_pass,$user_pass)) {
            echo "true";die;
        }else{
            echo "False";die;
        }

        return view('admin.admin_settings');
    }
 
    public function update_pass(Request $request)
    {
        if ($request->isMethod('post')) {
           $data = $request->all();
           $given_pass = $data['current_pwd'];
           $user = User::where(['isadmin' =>'1','email'=>Auth::user()->email])->first();
            if (Hash::check($given_pass,$user->password)) {
                $user->password = Hash::make($data['new_pwd']);
                $user->save();
                return redirect(route('admin_settings'))->with('flash_success_message','Password changed successfully!!');
            }else{
               return redirect(route('admin_settings'))->with('flash_error_message','Incorrect current password');
            }    
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
    }
}
