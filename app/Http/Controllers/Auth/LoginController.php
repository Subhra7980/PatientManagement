<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\OTPVerification;
use Mail;

class LoginController extends Controller
{
    public function otpSend(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:8'
          ]);

             $findUser = User::where('email',$request->email)->first();
             $genOtp   = rand(100000,999999);
             $findUser->emailOtp = $genOtp;
             $findUser->update();
             try{
                Mail::to($findUser->email)->send(new OTPVerification($findUser->name,$genOtp));
                return [
                    'success' => true,
                    'message' => 'OTP Sent Successfully'
                ];
             }catch (Exception $e) {
                return [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
    }

    public function otpVerify(Request $request)
    {
        
        $findUser = User::where('email',$request->email)->first();
        
       // $start = date('H:i',strtotime($findUser->lastLogin));
                     // dd($time[1]);
        if($request->emailOtp === $findUser->emailOtp)
        {
            Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);
            $findUser->emailOtp = NULL;
            $findUser->update();
            return [
                'success' => true,
                'message' => 'User Login Successful',
                'token'   =>  $findUser->createToken('web')->plainTextToken,
                'guard'   => 'web',
                'name'    => $findUser->name
            ];
        }

        if($request->emailOtp != $findUser->emailOtp)
        {
            return [
                'success' => false,
                'message' => 'Invalid OTP!'
            ];
        }
    }

    public function logout(Request $request)
    {
        $user            = Auth::user();
        $user->lastLogin = Carbon::now()->timezone('Asia/Kolkata')->format('d/m/Y H:i A');
        $user->update();
        Auth::user()->tokens()->delete();
        return array('success' => true);
    }
}

