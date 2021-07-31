<?php

namespace App\Http\Controllers;

use App\Models\DoctorAssistant;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;


class AdminController extends Controller
{
    //admin login
    public function adminLogin(){
        return view('admin.login');
    }

    public function adminLoginProcess(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        else{
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('admin.dashboard');
            }else{
                Session::flash('error_message','Invalid Email Or Password');
                return redirect('/admin/login');
            }

        }

    }
    public function add_doctor_assistant(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:doctor_assistants|email',
            'password' => 'required',
            'phone' => 'required|digits:11',
            'doctor_id' => 'required',
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        DoctorAssistant::create($input);
        return redirect('admin/doctor_assistant/index');

    }
    public function edit_doctor_assistant(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:11',

        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
        if($request->doctor_id){
            DoctorAssistant::where('id',$request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'doctor_id' => $request->doctor_id
            ]);
        }
        else{
            DoctorAssistant::where('id',$request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
        }

        return redirect('admin/doctor_assistant/index');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

}
