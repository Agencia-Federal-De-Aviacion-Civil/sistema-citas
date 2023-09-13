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
    public function list(Request $request)
    {
        // if ($request->header('Authorization') === 'Bearer 2|4ZWgUwhajRaJQyQv40tBvMVHzh1YU1EWN9GMTtGZ') {
        $userList = MedicineReserve::with('medicineReserveFromUser.UserParticipant')
            ->where('status', 1)->get();
        return response([
            "status" => 1,
            "message" => "Lista de usuarios",
            "data" => $userList
        ]);
        // } else {
        //     return response([
        //         "status" => 0,
        //         "message" => "No autorizado",
        //     ], 401);
        // }
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
}
