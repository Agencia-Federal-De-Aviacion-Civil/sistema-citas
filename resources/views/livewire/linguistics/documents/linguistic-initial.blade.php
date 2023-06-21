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
        margin-top: 2%;
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
        <center><img src="{{ public_path('images/fooderafac2023.png') }}" width="112%" height=80" alt="">
        </center>
    </footer>
    <div>
        {{-- <img src="{{ public_path('images/AFAC1.png') }}" width="130" height="100" alt=""> --}}
        <img src="{{ public_path('images/banner2023afac.png') }}" width="450" height="45" alt="">
        <div class="cuadrado-2">
            <p>Folio de cita: <b>CL-{{ $linguisticReserves[0]->id }}</b></p>
        </div>
        <div class="titulo">
            <h3>ACUSE DE CITA PARA EVALUACIÓN DE COMPETENCIA LINGÜISTICA</h3>
        </div>
        <table style="margin-top: 3%;">
            <tr>
                <td>NOMBRE:</td>
                <td>
                    {{ ($linguisticReserves[0]->linguisticReserve->linguisticUser->name ?? 'SIN INFORMACIÓN') . ' ' . $linguisticReserves[0]->linguisticReserve->linguisticUser->UserParticipant->pluck('apParental')->first() . ' ' . $linguisticReserves[0]->linguisticReserve->linguisticUser->UserParticipant->pluck('apMaternal')->first() }}
                </td>
            </tr>
            <tr>
                <td>CURP:</td>
                <td>
                    {{ ($linguisticReserves[0]->linguisticReserve->linguisticUser->userParticipant->pluck('curp')->first() ?? 'SIN INFORMACIÓN') }}
                </td>
            </tr>
            <tr>
                <td>LLAVE DE PAGO</td>
                <td>{{ $linguisticReserves[0]->linguisticReserve->reference_number }}</td>
            </tr>
            <tr>
                <td>FECHA DE PAGO</td>
                <td>{{ $linguisticReserves[0]->linguisticReserve->pay_date }}</td>
            </tr>
            <tr>
                <td>TIPO DE EVALUACIÓN:</td>
                <td>
                    {{ $linguisticReserves[0]->linguisticReserve->linguisticTypeExam->name }}
                </td>
            </tr>
            <tr>
                <td>NÚMERO DE LICENCIA:</td>
                <td>
                    {{ $linguisticReserves[0]->linguisticReserve->license_number }}
                </td>
            </tr>
            <tr>
                <td>TIPO DE LICENCIA:</td>
                <td>
                    {{ $linguisticReserves[0]->linguisticReserve->linguisticTypeLicense->name }}
                </td>
            </tr>
            <tr>
                <td>NÚMERO ROJO:</td>
                <td>
                    {{ $linguisticReserves[0]->linguisticReserve->red_number }}
                </td>
            </tr>
            <tr>
                <td>SEDE:</td>
                <td>
                    {{ $linguisticReserves[0]->linguisticUserHeadquers->name }}
                </td>
            </tr>
            <tr>
                <td>DIRECCIÓN SEDE:</td>
                <td>
                    {{ $linguisticReserves[0]->linguisticUserHeadquers->userHeadquarter[0]->direction }}
                </td>
            </tr>
            <tr>
                <td>FECHA</td>
                {{ mb_strtoupper($dateConvertedFormatted) }}
                <td>
            </tr>
            <tr>
                <td>HORA</td>
                <td>{{ $linguisticReserves[0]->linguisticReserveSchedule->time_start }}</td>
            </tr>

        </table>
        <div class="codigoqr">
            <img src="http://chart.googleapis.com/chart?chs=70x70&chld=L|0&cht=qr&chl={{ $keyEncrypt }}"
                width="120" height="120" />
        </div>
        <div style="background-color: #e6e6e6;height: 25px;">
            <h3 class="titulo2">REQUISITOS</h3>
        </div>
        <div style="padding-top:2%">
            <label style="text-align: justify;font-size:17px" for="">Estimado usuario, con el fin de facilitar el procedimiento de su EVALUACIÓN DE COMPETENCIA LINGÜÍSTICA, le mostramos los siguientes
                <b>requisitos</b>, para realizar su evaluación.
            </label>
        </div>
        <div style="padding-top:1%;font-size:17px">
            <ol style="text-align: justify" type="I">
                <li value="I">Presentarse puntual según la cita agendada.</li>
                <li>Presentar identificación oficial (INE, pasaporte, cédula profesional).</li>
                <li>Durante la prueba no se permitirá utilizar teléfono celular o cualquier dispositivo electrónico de almacenamiento</li>
                <li>Se podrá llevar lápiz y pluma para tomar nota de lo que se considere necesario durante el desarrollo del examen.</li>
                <li>La evaluación tendrá una duración de 30 minutos y una vez iniciado el examen no se podrá suspender por lo que se solicita considerar el tiempo necesario para dicha evaluación.</li>
            </ol>
        </div>
    </div>
</body>

</html>
