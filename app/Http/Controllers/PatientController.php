<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Excel;
use App\Exports\PatientExport;

class PatientController extends Controller
{
    public function savePatient(Request $request)
    {
        DB::beginTransaction();
        try{
                $lastId  = 0;
                $lastIdA = 0;

                $getId   = Patient::orderBy('id', 'DESC')->first();
                $getIdA  = Address::orderBy('id', 'DESC')->first();

                #genID for Address
                if(empty($getIdA)){$lastIdA = 0;}else{$lastIdA = intval(explode('-',$getIdA->addressGenId)[1]);}
                $presentIdA = $lastIdA+1;

                $addAddress = new Address;
                
                $addAddress->addressGenId    = "ADD-".str_pad($presentIdA,5,"0", STR_PAD_LEFT);
                $addAddress->addressLine1    = $request->addressLine1;
                $addAddress->addressLine2    = $request->addressLine2;
                $addAddress->addressCity     = $request->addressCity;
                $addAddress->addressDistrict = $request->addressDistrict;
                $addAddress->addressState    = $request->addressState;
                $addAddress->addressPinCode  = $request->addressPinCode;
                $addAddress->save();

                #genId for Patient 
                if(empty($getId)){$lastId = 0;}else{$lastId = intval(explode('-',$getId->patientGenId)[1]);}
                $presentId = $lastId+1;

                $addPatient = new Patient;

                $addPatient->patientGenId         = "PAT-".str_pad($presentId,5,"0", STR_PAD_LEFT);
                $addPatient->patientFName         = $request->patientFName;
                $addPatient->patientMName         = $request->patientMName;
                $addPatient->patientLName         = $request->patientLName;
                $addPatient->patientEmailId       = $request->patientEmailId;
                $addPatient->patientContactNo     = $request->patientContactNo;
                $addPatient->patientAltContactNo  = $request->patientAltContactNo;
                $addPatient->addressId            = $addAddress->id;
                $addPatient->save();

                DB::commit();
                return array('success' => true, 'msg'=>['Patient Added']);
        }catch(\Exception $e){
            DB::rollBack();
            return array('success' => false, 'msg'=>$e->errorInfo[2]);
         }
    }

    public function getPatientList()
    {
        return Patient::with('get_address')->orderBy('id','ASC')->get();
    }

    public function getPatientById($patId)
    {
       return Patient::where('patientGenId',$patId)->with('get_address')->first();
    }

    public function updatePatient($patId,Request $request)
    {
        DB::beginTransaction();

        try {
                $updatePatient = Patient::where ('PatientGenId',$patId)->first();
                $updateAddress = Address::where ('id',$updatePatient->addressId)->first();

                $updatePatient->patientFName         = $request->patientFName;
                $updatePatient->patientMName         = $request->patientMName;
                $updatePatient->patientLName         = $request->patientLName;
                $updatePatient->patientEmailId       = $request->patientEmailId;
                $updatePatient->patientContactNo     = $request->patientContactNo;
                $updatePatient->patientAltContactNo  = $request->patientAltContactNo;
                $updatePatient->update();


                $updateAddress->addressLine1                = $request->addressLine1;
                $updateAddress->addressLine2                = $request->addressLine2;
                $updateAddress->addressCity                 = $request->addressCity;
                $updateAddress->addressDistrict             = $request->addressDistrict;
                $updateAddress->addressState                = $request->addressState;
                $updateAddress->addressPinCode              = $request->addressPinCode;           
                $updateAddress->update();
                DB::commit();
                return array('success' => true, 'msg'=>['Patient detailed Updated']);

        } catch (\Exception $e) 
        {
            DB::rollBack();
            return array ('success' => false, 'msg'=>$e->errorInfo[2]);
            
        }
    }
    
    public function getPatientCount()
    {
        return Patient::count();
    }

    public function deletePatient($patId)
    {
        DB::beginTransaction();
        try 
        {
            $getPat   = Patient::where('patientGenId',$patId)->first();
            $findAddr = Address::where('id',$getPat->addressId)->delete();
            DB::commit();
            return array('success'=>true,'msg'=>['Patient Deleted']);
        } catch (\Exception $e) 
        {
            DB::rollBack();
            return array('success' => false, 'msg'=>$e->errorInfo[2]);
        }
    }
    
}

