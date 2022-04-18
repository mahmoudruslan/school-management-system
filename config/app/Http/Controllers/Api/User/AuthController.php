<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use GeneralTrait;
    public function login(Request $request)
    {
        try {
            $rouls = [
                'email' => 'required|exists:students,email',
                'password' => 'required',
            ];


            $validator = Validator::make($request->all(), $rouls);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);


                return $this->returnValidationError($code, $validator);
            }



            ////////////////////////////////////////login////////////////////////////////////

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('user-api')->attempt($credentials);
            if (!$token)
                return $this->returnError('E001', __('Incorrect email or password'));

            $user = Auth::guard('user-api')->user();
            $user->api_token = $token;
            //return token
            return $this->returnData('user', $user);
        } catch (\Exception $e) {
            return $this->returnerror($e->getCode(), $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $token = $request->header('auth-token');

        JWTAuth::setToken($token)->invalidate(); //logout
        return $this->returnsuccessmessage('', __('Signed out successfully'));
    }
}
