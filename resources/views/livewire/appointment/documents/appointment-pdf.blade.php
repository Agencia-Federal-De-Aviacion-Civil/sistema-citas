<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>
        {{ $printQuery->appointmentUser->name . ' ' . $printQuery->appointmentUser->apParental . ' ' . $printQuery->appointmentUser->apMaternal }}
    </title>
</head>
<style>
    .titulo {
        text-align: center;
        font-weight: bold;
        color: #000000;
    }
</style>

<body>
    <div>
        <img src="{{public_path('images/AFAC1.png')}}" width="100" height="64" alt="">
        <div class="titulo">
            <h2>COMPROBANTE DE CITA</h2>
        </div>

        <table>
            <tr>
                <td colspan="12">NOMBRE</td>
                <td colspan="24">
                    {{ $printQuery->appointmentUser->name . ' ' . $printQuery->appointmentUser->apParental . ' ' . $printQuery->appointmentUser->apMaternal }}
                </td>
            </tr>
            <tr>
                <td colspan="12">CURP:</td>
                <td>{{ $printQuery->appointmentUser->curp }}</td>
            </tr>
            <tr>
                <td colspan="12">NUMERO DE EXPEDIENTE:</td>
                <td colspan="24">{{ $printQuery->id }}</td>
            </tr>
            <tr>
                <td colspan="12">MODO DE TRASPORTE:</td>
                <td colspan="24">AÉREO</td>
            </tr>
            <tr>
                <td colspan="12">TIPO DE EXAMEN:</td>
                <td colspan="24">{{ $printQuery->appointmentTypeExam->name }}</td>
            </tr>
            <tr>
                <td colspan="12">TIPO DE CLASE</td>
                @if ($printQuery->type_exam_id == 1)
                    <td colspan="24">{{ $printQuery->appointmentStudying[0]->studyingClass->name }}</td>
                @elseif($printQuery->type_exam_id == 2)
                    <td colspan="24">{{ $printQuery->appointmentRenovation[0]->renovationClass->name }}</td>
                @endif
            </tr>
            <tr>
                <td colspan="12">TRAMITE</td>
                <td colspan="24">EXAMEN PSICOFISICO INTEGRAL</td>
            </tr>
            <tr>
                <td colspan="12">NO. DE CITA</td>
                <td colspan="24">{{ $printQuery->id }}</td>
            </tr>
            <tr>
                <td colspan="12">UNIDAD MÉDICA:</td>
                <td colspan="24"> {{ $printQuery->appointmentSuccess[0]->successHeadquarter->name }}</p>
                </td>
            </tr>
            <tr>
                <td colspan="12">FECHA:</td>
                <td colspan="24">{{ $printQuery->appointmentSuccess[0]->appointmentDate }}</td>
            </tr>
            <tr>
                <td colspan="12">HORA:</td>
                <td colspan="24">{{ $printQuery->appointmentSuccess[0]->appointmentTime }} AM</td>
            </tr>
            <tr>
                <td colspan="12">FOLIO:</td>
                <td colspan="24">{{ $printQuery->id }}</td>
            </tr>
        </table>
        <div style="padding-top:5%">
            <label for="">Requisitos:</label>
            <div style="padding-left:18%;padding-top:-4%;text-align: justify;"><label>Si alguno de estos documentos no
                    son presentados el día de su cita, no podrá realizar su examen
                    por lo que este se perderá. Identificación oficial (Se acepta únicamente INE vigente, Cédula de
                    identidad
                    ciudadana, Cédula profesional, cartilla militar, licencia federal, título, certificado o libreta de
                    mar y de
                    identificación marítima) ORIGINAL Y COPIA. Comprobante de domicilio (con vigencia no mayor a 3
                    meses)COPIA. Comprobante de pago. ORIGINAL. CURP COPIA. </label></div>

        </div>
        <p style="padding-left:15%">FIRMA: </p>
        <hr Style="margin-top:-2%" width="50%">
        {{-- PAGINA 2 --}}
        <div style='page-break-before:always;'></div>
        <div style="text-align: center;">
            <h2>GUÍA DE RECOMENDACIONES</h2>
        </div>
        <div class="mt-10 mx-7 text-justify">
            <p>Estimado usuario con el fin de apoyarle y hacer más ágil su examen psicofísico, deberá tomar en cuenta
                los
                siguientes puntos:</p>
            <ol class="">
                <li value="1">En el caso de que las damas que acudan a realizar EPI solicitamos que las <b>uñas</b>
                    estén
                    <b>cortas
                        para evitar dificultad en la captura de sus huellas, acudir con <b>ropa cómoda</b> <u>evitando
                            sea
                            de una sola pieza</u></b>.
                </li><br>
                <li>
                    Presentarse en <b>ayuno</b> el cual debe ser con un promedio <u>de 8 horas</u> <b>sin suspender
                        medicación</b> prescrita por su médico.
                </li><br>
                <li>
                    Conocer su grupo y Rh; cuando vaya a realizar <u>Examen Psicofísico Integral por primera vez traer
                        comprobante de Grupo y Rh</u>
                </li><br>
                <li>
                    En case de haber tenido algún <b>procedimiento dental esperar mínimo 72 horas</b> posteriores a este
                    procedimiento para agendar su cita.
                </li><br>
                <li>
                    Si presentas alguna <b>enfermedad crónica</b>, deberás presentar un resumen clínico expedido por tu
                    médico tratante y/o estudios adicionales con vigencia no mayor a tres meses para acreditar el estado
                    actual de salud (enfermedades cardiacas, respiratorias, hipertiroidismo, entre otras...).
                </li><br>
                <li>
                    Si presentas alguna <b>disminución en la capacidad visual</b>, deberás presentarte con lentes de
                    armazón
                    o de contacto con graduación actualizada. En caso de que alternes el uso de ambos tendrás que
                    presentar
                    ambos (no olvida estuche y líquidos necesarios en caso de usar lentes de contacto).
                </li><br>
                <li>
                    Si estás <b>embarazada</b>, deberás presentar constancia de control de embarazo actualizada y
                    hacérselo
                    saber al servicio de rayos X cuando acudas a realizar el EPI.
                </li><br>
                <li>
                    Tendrás que <b>presentar el resultado de una química sanguínea</b> la cual contenga los valores de:
                    glucosa, Hemoglobina Glucosilada, colesterol, HDL, LDL, Triglicéridos y ácido úrico; así como un
                    Examen
                    General de Orina (EGO) ambos estudios con fecha de emisión de resultados no mayor a un mes, VIH y Rx
                    de torax.
                </li><br>
                <li>
                    Imprimir el <u>consentimiento</u>. <u>Declaración salud</u>.
                </li>
            </ol>
        </div>
    </div>
</body>

</html>
