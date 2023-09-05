<?php

namespace App\Http\Controllers\Api\Medicine;

use App\Http\Controllers\Controller;
use App\Models\Catalogue\TypeExam;
use App\Models\Linguistic\Reserve;
use App\Models\Medicine\CertificateQr\MedicineCertificateQr;
use App\Models\Medicine\MedicineReserve;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'medicine_reserves_id' => 'required',
            'date_expire' => 'required',
            'medical_name' => 'required',
            'evaluation_result' => 'required',
            'document_license_id' => 'required',
        ]);
        $users = new MedicineCertificateQr();
        $users->medicine_reserves_id = $request->medicine_reserves_id;
        $users->date_expire = $request->date_expire;
        $users->medical_name = $request->medical_name;
        $users->evaluation_result = $request->evaluation_result;
        $users->document_license_id = $request->document_license_id;
        $users->save();
        return response([
            "status" => 1,
            "message" => "éxitoso"
        ]);
    }
    public function list(Request $request)
    {
        $userList = MedicineReserve::with(
            'medicineReserveHeadquarter:id,name_headquarter',
            'medicineReserveMedicine:id,user_id,type_exam_id',
            'medicineReserveMedicine.medicineInitial:id,medicine_id,type_class_id',
            'medicineReserveMedicine.medicineRenovation:id,medicine_id,type_class_id',
            'medicineReserveMedicine.medicineRevaluation:id,medicine_id',
            'medicineReserveMedicine.medicineRevaluation.revaluationMedicineInitial:id,medicine_revaluation_id,type_class_id',
            'medicineReserveFromUser:id,name',
            'medicineReserveFromUser.UserParticipant:id,user_id,apParental,apMaternal,age,curp'
        )
            ->where('status', 1)->get();
        return response([
            "status" => 1,
            "message" => "Lista de usuarios",
            "data" => $userList
        ]);
    }
    public function show()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
