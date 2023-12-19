<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return $this->sendResponse('success', 'Logout successfully.');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users',
            'district_id' => 'required',
            'area_id' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->status == 'Pending'){
                Auth::logout();
                return $this->sendError('Your request is pending.', ['error' => 'Your request is pending.']);
            }

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            $otp = rand(100000, 999999);
            //$otp = 123456;

            $success['otp'] = $otp;
            User::where('id', $user->id)->update([
                'otp' => $otp
            ]);

            $body = ' Welcome to MediSource. Your OTP is ' . $otp . '.';
            send_sms($body, $user->phone);

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function verify_otp(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if (isset($user)) {
            $otp_check = User::where('phone', $request->phone)->where('otp', $request->otp)->first();

            if (!isset($otp_check)) {
                return $this->sendError('Unmatched.', ['error' => 'OTP did not match']);
            }

            $success['name'] = $user->name;
            $success['phone'] = $user->phone;
            $success['token'] = $user->createToken('MyApp')->plainTextToken;

            return $this->sendResponse($success, 'Otp verify successfully.');
        } else {
            return $this->sendError('Unmatched.', ['error' => 'User Not Found']);
        }
    }

    public function otp_send(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if (isset($user)) {

            //$otp = rand(10000, 99999);
            $success['phone'] = $user->phone;
            $success['name'] = $user->name;

            $otp = rand(100000, 999999);
            //$otp = 123456;
            $success['otp'] = $otp;

            $user->update([
                'otp' => $otp
            ]);

            $body = ' Welcome to MediSource. Your OTP is ' . $otp . '.';
            send_sms($body, $user->phone);

            return $this->sendResponse($success, 'Otp send successfully.');
        } else {
            return $this->sendError('Error.', ['error' => 'User Not Found']);
        }
    }

    public function new_password_create(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if (isset($user)) {


            if ($request->confirm_password != $request->new_password) {
                return $this->sendError('Error.', ['error' => 'Password should be similar']);
            }

            if (!Hash::check($request->old_password, $user->password)){
                return $this->sendError('Error.', ['error' => 'Old password did not match']);
            }

            //$otp = rand(10000, 99999);
            $success['phone'] = $user->phone;
            $success['name'] = $user->name;

            $user->update([
                'password' => bcrypt($request->new_password)
            ]);

            return $this->sendResponse($success, 'Password Changed Successfully!.');
        } else {
            return $this->sendError('Error.', ['error' => 'User Not Found']);
        }
    }

    public function new_password_set(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if (isset($user)) {


            if ($request->confirm_password != $request->new_password) {
                return $this->sendError('Error.', ['error' => 'Password should be similar']);
            }

            //$otp = rand(10000, 99999);
            $success['phone'] = $user->phone;
            $success['name'] = $user->name;

            $user->update([
                'password' => bcrypt($request->new_password)
            ]);

            return $this->sendResponse($success, 'Password Changed Successfully!.');
        } else {
            return $this->sendError('Error.', ['error' => 'User Not Found']);
        }
    }
}
