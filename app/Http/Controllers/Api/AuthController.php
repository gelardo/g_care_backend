<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BlendxHelpers;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSpeciality;
use App\Models\User;
use App\Rules\MatchOldPassword;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class   AuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request)
    {
    //        return $request->all();
    //        die();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'phone' => 'required|digits:11'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['name'] =  $user->name;
        $success['role_id'] = $user->role;

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        else{

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $user = Auth::user();
                $success['token'] =  $user->createToken($user->id)-> plainTextToken;
                $success['name'] =  $user->name;
//                return $this->sendResponse($success, 'User login successfully.');
                return $this->success([
                    'token' => auth()->user()->createToken('API Token')->plainTextToken
                ]);

            }
            else{
                return $this->error('Unauthorised.', ['error' =>['Something is wrong, Please try again  ']]);
            }
        }

    }
    public function update_profile(Request $request){
//        return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|digits:11',
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_new_password' => ['same:new_password'],

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        User::where('id',auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'age' => $request->age,
            'location' => $request->location,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'password'=> Hash::make($request->new_password)
        ]);

        $success['status'] =  'Done';
        return $this->sendResponse($success, 'User Updated successfully.');

    }
    public function logout(Request $request)
    {

        auth()->user()->tokens()->delete();
        $request->session()->flush();
        return [
            'message' => 'Tokens Revoked'
        ];
    }

//Temporary Function to load doctors with speciality
    public function doctor_with_speciality($speciality_id){
        $result  = [];
        $dr_speciality_id = DoctorSpeciality::where('speciality_id',$speciality_id)->get();
        foreach ($dr_speciality_id as $dr_special){
            $doctor = array(Doctor::where('id',$dr_special->doctor_id)->with(['specialities','hospitals'])->get());

            $result = array_merge($result,$doctor);
        }
//        $doctor = BlendxHelpers::route_to_model('doctor');
        return response()->json($result);
    }


}
