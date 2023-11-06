<?php

namespace App\Http\Controllers\Api\Medicine;

use App\Http\Controllers\Controller;
use App\Models\Catalogue\TypeExam;
use App\Models\Linguistic\Reserve;
use App\Models\Medicine\CertificateQr\MedicineCertificateQr;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineReservesExtension;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class UsersController extends Controller
{
    public function list(Request $request)
    {
        // TODO FALTA COLOCAR SEGURIDAD Y PROTECCION
        $userList = MedicineReserve::with(
            'medicineReserveHeadquarter:id,name_headquarter',
            'medicineReserveMedicine:id,user_id,type_exam_id',
            'medicineReserveMedicine.medicineInitial:id,medicine_id,type_class_id',
            'medicineReserveMedicine.medicineRenovation:id,medicine_id,type_class_id',
            'medicineReserveMedicine.medicineRevaluation:id,medicine_id',
            'medicineReserveMedicine.medicineRevaluation.revaluationMedicineInitial:id,medicine_revaluation_id,type_class_id',
            'medicineReserveMedicine.medicineRevaluation.revaluationMedicineRenovation:id,medicine_revaluation_id,type_class_id',
            // 'medicineReserveMedicineExtension:id,medicine_reserve_id,type_class_extension_id,status',
            'medicineReserveFromUser:id,name',
            'medicineReserveFromUser.UserParticipant:id,user_id,apParental,apMaternal,age,curp'
        )
            ->whereIn('status', [1, 8])->get();
        return response([
            "status" => 1,
            "message" => "Lista de usuarios",
            "data" => $userList
        ]);
    }
    // TODO BUSQUEDA MAS RAPIDAS
    // TODO BUSQUEDA DE USUARIOS POR ID
    public function listUserId(Request $request)
    {
        $ids = $request->input('ids'); // Obtener la cadena de IDs separada por comas desde el cuerpo de la solicitud
        if (!$ids) {
            return response([
                "status" => 0,
                "message" => "Los IDs de usuario no se proporcionaron correctamente en la solicitud.",
            ], 400);
        }
        $idsArray = explode(',', $ids);
        $userList = MedicineReserve::with(
            'medicineReserveHeadquarter:id,name_headquarter',
            'medicineReserveMedicine:id,user_id,type_exam_id',
            'medicineReserveMedicine.medicineInitial:id,medicine_id,type_class_id',
            'medicineReserveMedicine.medicineRenovation:id,medicine_id,type_class_id',
            'medicineReserveMedicine.medicineRevaluation:id,medicine_id',
            'medicineReserveMedicine.medicineRevaluation.revaluationMedicineInitial:id,medicine_revaluation_id,type_class_id',
            'medicineReserveMedicine.medicineRevaluation.revaluationMedicineRenovation:id,medicine_revaluation_id,type_class_id',
            'medicineReserveMedicineExtension:id,medicine_reserve_id,type_class_extension_id,status',
            'medicineReserveFromUser:id,name',
            'medicineReserveFromUser.UserParticipant:id,user_id,apParental,apMaternal,age,curp'
        )
            ->whereIn('status', [1, 8, 9])
            ->whereIn('id', $idsArray) // Usar la matriz de IDs
            ->get();
        return response([
            "status" => 1,
            "message" => "Lista de usuarios",
            "data" => $userList
        ]);
    }
    // TODO API PARA LA LIBERACIÓN DE CODIGO QR
    public function listHeadquarter(Request $request)
    {
        $id = $request->input('id');
        if (!$id) {
            return response([
                "status" => 0,
                "message" => "Los IDs de usuario no se proporcionaron correctamente en la solicitud.",
            ], 400);
        }
        $userList = MedicineReserve::with(
            'medicineReserveHeadquarter:id,name_headquarter',
            'medicineReserveMedicine:id,user_id,type_exam_id',
            'medicineReserveFromUser:id,name',
            'medicineReserveFromUser.UserParticipant:id,user_id,apParental,apMaternal,age,curp'
        )
            ->whereHas('medicineReserveHeadquarter', function ($q) use ($id) {
                $q->where('id', $id);
            })
            ->whereIn('status', [1, 7])
            ->where('is_external', 1)
            ->get();
        return response([
            "status" => 1,
            "message" => "Lista de usuarios",
            "data" => $userList
        ]);
    }
    public function listCurp(Request $request)
    {
        $curp = $request->input('curp');
        if (!$curp) {
            return response([
                "status" => 0,
                "message" => "El CURP no se proporcionó en la solicitud.",
            ], 400);
        }
        $userList = MedicineReserve::with(
            'medicineReserveHeadquarter:id,name_headquarter',
            'medicineReserveMedicine:id,user_id,type_exam_id',
            'medicineReserveMedicine.medicineInitial:id,medicine_id,type_class_id',
            'medicineReserveMedicine.medicineRenovation:id,medicine_id,type_class_id',
            'medicineReserveMedicine.medicineRevaluation:id,medicine_id',
            'medicineReserveMedicine.medicineRevaluation.revaluationMedicineInitial:id,medicine_revaluation_id,type_class_id',
            'medicineReserveMedicine.medicineRevaluation.revaluationMedicineRenovation:id,medicine_revaluation_id,type_class_id',
            'medicineReserveMedicineExtension:id,medicine_reserve_id,type_class_extension_id,status',
            'medicineReserveFromUser:id,name',
            'medicineReserveFromUser.UserParticipant:id,user_id,apParental,apMaternal,age,curp'
        )
            ->whereIn('status', [1, 8, 9])
            ->whereHas('medicineReserveFromUser.UserParticipant', function ($query) use ($curp) {
                $query->where('curp', $curp);
            })
            ->get();
        return response([
            "status" => 1,
            "message" => "Lista de usuarios",
            "data" => $userList
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);
        $medicineReserve = MedicineReserve::find($id);
        if (!$medicineReserve) {
            return response([
                "status" => 0,
                "message" => "Registro no encontrado"
            ], 404);
        }
        $medicineReserve->status = $request->status;
        $medicineReserve->save();
        return response([
            "status" => 1,
            "message" => "Registro actualizado exitosamente"
        ]);
    }
    public function updateStatus(Request $request, $ids)
    {
        try {
            $idsArray = explode(',', $ids);
            foreach ($idsArray as $id) {
                $medicineReserve = MedicineReserve::find($id);
                if (!$medicineReserve) {
                    throw new \Exception('NO SE ENCONTRÓ NINGUN REGISTRO CON ESE ID, NO SE PUEDE ACTUALIZAR');
                }
                $medicineReserve->status = $request->status;
                $medicineReserve->save();
            }
            return response([
                "status" => 1,
                "message" => "REGISTROS ACTUALIZADOS EXITOSAMENTE"
            ]);
        } catch (\Exception $e) {
            return response([
                "status" => 0,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function updateStatusExtension(Request $request, $id)
    {
        try {
            $medicineReserveExtension = MedicineReservesExtension::where('medicine_reserve_id', $id)->first();
            if (!$medicineReserveExtension) {
                throw new \Exception('REGISTRO NO ENCONTRADO');
            }
            $medicineReserveExtension->status = $request->status;
            $medicineReserveExtension->save();
            return response([
                "status" => 1,
                "message" => "REGISTRO ACTUALIZADO EXITOSAMENTE"
            ]);
        } catch (\Exception $e) {
            return response([
                "status" => 0,
                "message" => $e->getMessage()
            ], 404);
        }
    }
}
