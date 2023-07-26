<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>
        {{-- {{ $printQuery->appointmentUser->name . ' ' . $printQuery->appointmentUser->apParental . ' ' . $printQuery->appointmentUser->apMaternal }} --}}
    </title>
</head>
<style>
    .titulo {
        text-align: center;
        font-weight: bold;
        color: #000000;
        margin-top: 5%;
    }

    .titulo2 {
        text-align: center;
        color: #4f4f4f;
    }

    .titulo3 {
        text-align: center;
        color: #000000;
    }

    .normal {
        width: 250px;
        border: 1px solid #000;
        border-collapse: collapse;
    }

    .normal th,
    .normal td {
        border: 1px solid #000;
    }

    .cuadrado-2 {
        width: 200px;
        height: auto;
        border: 3px solid #767676;
        float: right;
        margin-top: -1%;
        text-align: center;
    }

    .info {
        margin-top: 10%;
        font-size: 18px;
    }

    .bgsize {
        background-color: transparent;
        background-image: url("{{ public_path('images/AFAC7.png') }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: 65%;
    }

    .codigoqr {
        text-align: right;
        margin-top: -7%;
    }
    footer {
        position: fixed;
        bottom: 30px;
        height: 0px;
        right: -0.2%;
    }  
</style>

<body class="bgsize">
    <footer>
        <center><img src="{{ public_path('images/fooderafac2023.png') }}" width="112%" height=80" alt=""></center>
    </footer>
    <div>
        {{-- <img src="{{ public_path('images/AFAC1.png') }}" width="130" height="100" alt=""> --}}
        <img src="{{ public_path('images/banner2023afac.png') }}" width="450" height="45" alt="">
        <div class="cuadrado-2">
            <p>Folio de cita: <b>MED-{{ $medicineReserves[0]->id }}</b></p>
        </div>
        <div class="titulo">
            <h3>ACUSE DE CITA PARA EXAMEN MÉDICO DE REVALORACIÓN</h3>
        </div>
        <table style="margin-top: 3%;">
            <tr>
                <td>NOMBRE:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineUser->name . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apParental')->first() . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apMaternal')->first() }}
                </td>
            </tr>
            <tr>
                <td>CURP:</td>
                <td>{{ $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('curp')->first() }}
                </td>
            </tr>
            <tr>
                <td>MODO DE TRANSPORTE:</td>
                <td>AÉREO</td>
            </tr>
            <tr>
                <td>TIPO DE EXAMEN:</td>
                <td> <b> <u>{{ $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name }}</u> </b>
                    </td>
            </tr>
            <tr>
                <td>TIPO DE REVALORACIÓN:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->RevaluationTypeExam->name }}</td>
            </tr>
            @if ($medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->RevaluationTypeExam->id ===1 )
            <tr>
                <td>TIPO DE CLASE:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name }}
                </td>
            </tr>
            <tr>
                <td>TIPO DE LICENCIA:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialClasificationClass->name }}
                </td>
            </tr>
            @else
            <tr>
                <td>TIPO DE CLASE:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationTypeClass->name }}
                </td>
            </tr>
            <tr>
                <td>TIPO DE LICENCIA:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationClasificationClass->name }}
                </td>
            </tr>
            @endif
            <tr>
                <td>TRAMITE:</td>
                <td>EVALUACIÓN MEDICA</td>
            </tr>
            {{-- <tr>
                <td colspan="12">NO. DE CITA:</td>
            </tr> --}}
            <tr>
                <td>UNIDAD MÉDICA:</td>
                <td> <b>{{ $medicineReserves[0]->medicineReserveHeadquarter->name_headquarter }}</b></p>
                </td>
            </tr>
            <tr>
                <td>DIRECCIÓN SEDE:</td>
                <td> {{ $medicineReserves[0]->medicineReserveHeadquarter->direction }}</p>
                </td>
            </tr>
            <tr>
                <td>FECHA</td>
                <td>{{ mb_strtoupper($dateConvertedFormatted) }}</td>
            </tr>
            <tr>
                <td>HORA</td>
                <td>{{ $medicineReserves[0]->reserveSchedule->time_start }}</td>
            </tr>
            <tr>
                <td>LLAVE DE PAGO</td>
                <td>{{ $medicineReserves[0]->medicineReserveMedicine->reference_number }}</td>
            </tr>
        </table>
        <div class="codigoqr">
            <img src="http://chart.googleapis.com/chart?chs=70x70&chld=L|0&cht=qr&chl={{ $keyEncrypt }}"
                width="120" height="120" />
        </div>
        <div style="background-color: #e6e6e6;height: 25px; ">
            <h3 class="titulo2"></h3>
        </div>
        <div>
            <p><b>NOTA:</b> REVISAR EL DOCUMENTO DE AUTORIZACIÓN EMITIDO POR LA AUTORIDAD PARA VERIFICAR LOS 
                REQUISITOS QUE DEBE DE PRESENTAR EL DÍA DE SU CITA.</p>
        </div>        
    </div>
</body>
</html>