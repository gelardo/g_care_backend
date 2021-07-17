<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function logout(Request $request)
    {

        auth()->user()->tokens()->delete();
        $request->session()->flush();
        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
