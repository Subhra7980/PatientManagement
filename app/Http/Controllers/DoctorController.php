<?php
namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DoctorController extends Controller
{
    public function saveDoctor(Request $request)
    {
        DB::beginTransaction();

        try
        {
            $lastId = 0;
            $getId  = User::orderBy('Id','DESC')->first();
            if(empty($getId)){$lastId = 0 ;}else{$lastId = intval(explode('-',$getId->doctorGenId)[1]);}
            $presentId = $lastId + 1 ;

             $addDoctor = new Doctor;

             $addDoctor->doctorGenId          =  "DOC-".str_pad($presentId,5,"0", STR_PAD_LEFT);
             $addDoctor->doctorName           =  $request->doctorName;
             $addDoctor->doctorEmailId        =  $request->doctorEmailId;
             $addDoctor->doctorContactNo      =  $request->doctorContactNo;
             $addDoctor->doctorAltContactNo   =  $request->doctorAltContactNo;
             $addDoctor->doctorSpecialization =  $request->doctorSpecialization;
             $addDoctor->save();

            DB::commit();
            return array('success' => true, 'msg'=> ['Doctor Added']);
        }catch(\Exception $e){
            DB::rollBack();
            return array('success' => true, 'msg'=> $e->errorInfo[2]);
         }
    }
}
