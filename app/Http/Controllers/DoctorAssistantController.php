<?php

namespace App\Http\Controllers;

use App\Models\BookAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

//c|ra|

class DoctorAssistantController extends Controller
{
    public function index(){
        return view('doctorassistant.index');
    }
    //doctorassistant login
    public function doctorAssistantLogin(){
        return view('doctorassistant.login');
    }

    public function doctorAssistantLoginProcess(Request $request) {
//        dd(Auth::guard('doctorassistant')->attempt(['email' => $request->email, 'password' => $request->password]));
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
            if(Auth::guard('doctorassistant')->attempt(['email' => $request->email, 'password' => $request->password])){
//                dd(route('doctorassistant.dashboard'));
                return redirect('/doctorassistant/dashboard');
            }else{
                Session::flash('error_message','Invalid Email Or Password');
                return redirect('/doctorassistant/login');
            }

        }

    }

    public function dashboard(){
//        dd(Auth::guard('doctorassistant')->user()->doctor_id);
        $patient = BookAppointment::where('doctor_id',Auth::guard('doctorassistant')->user()->doctor_id)->with('patients')->get();
        return view('doctorassistant.user.index',compact('patient'));
    }

    public function logout(){
        Auth::guard('doctorassistant')->logout();
        return redirect('/doctorassistant/login');
    }
}
