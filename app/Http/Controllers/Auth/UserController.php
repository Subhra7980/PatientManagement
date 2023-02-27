<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;
use App\Mail\AddUserMail;
use Mail;

class UserController extends Controller
{
    public function saveUser(Request $request)
    {
        // $request->validate([
        //     'password'  => 'required|min:8',
        //     'cPassword' => 'same:password'
        // ]);

        DB::beginTransaction();
        try{
                $lastId = 0;
                $getId  = User::orderBy('id','DESC')->first();
                if(empty($getId)){$lastId = 0 ;}else{$lastId = intval(explode('-',$getId->userGenId)[1]);}
                $presentId = $lastId + 1;
                
                $genPassword = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,10);

                $addUser = new User;

                $addUser->userGenId    = "USR-".str_pad($presentId,5,"0", STR_PAD_LEFT);
                $addUser->name         = $request->name;
                $addUser->email        = $request->email;
                $addUser->password     = Hash::make($genPassword);
                $addUser->save();
                Mail::to($request->email)->send(new AddUserMail($request->name,$request->email,$genPassword));
                DB::commit();
                return array('success' => true, 'msg'=> ['User Added']);

        }catch(Exception $e){
                return array('success' => true, 'msg'=> $e->errorInfo[2]);
        } 
    }

    public function getUserList()
    {
        return User::orderBy('id','ASC')->get();
    }

    public function getUserById($userId)
    {
       return User::where('userGenId',$userId)->first();
    }

    public function updateUser($userId,Request $request)
    {
        DB::beginTransaction();
        
        try
        {
            $updateUser = User::where('userGenId',$userId)->first();

            $updateUser->name         = $request->name;
            $updateUser->email        = $request->email;
            $updateUser->update();
            DB::commit();
            return array('success' => true, 'msg'=>['User Updated']);
            
          
        }catch(\Exception $e)
        {
            DB::rollBack();
            return array ('success' => false, 'msg'=>$e->errorInfo[2]);
        }
    }

    public function deleteUser($userId)
    {
        DB::beginTransaction();
    
        try
        {
            User::where('userGenId',$userId)->delete();
            DB::commit();
            return array('success' => true, 'msg'=>['User deleted']);
            
          
        }catch(\Exception $e)
        {
            DB::rollBack();
            return array ('success' => false, 'msg'=>$e->errorInfo[2]);
        }

    }

    public function getUsersCount()
    {
        return User::count();
    }

}
