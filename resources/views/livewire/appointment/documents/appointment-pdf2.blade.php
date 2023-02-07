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

    .normal {
        width: 250px;
        border: 1px solid #000;
        border-collapse: collapse;
    }

    .normal th,
    .normal td {
        border: 1px solid #000;
    }
</style>

<body>
    <div>
        <img src="{{ public_path('images/AFAC1.png') }}" width="130" height="100" alt="">
        <div class="titulo">
            <h2>CITA PARA EXAMEN MÉDICO RENOVACIÓN</h2>
        </div>
        <table>
            <tr>
                <td colspan="12">NOMBRE:</td>
                <td colspan="24">
                    {{ strtoupper($printQuery->appointmentUser->name . ' ' . $printQuery->appointmentUser->apParental . ' ' . $printQuery->appointmentUser->apMaternal) }}
                </td>
            </tr>
            <tr>
                <td colspan="12">CURP:</td>
                <td>{{ strtoupper($printQuery->appointmentUser->curp) }}</td>
            </tr>
            <tr>
                <td colspan="12">NUMERO DE EXPEDIENTE:</td>
                <td colspan="24">{{ $printQuery->id }}</td>
            </tr>
            <tr>
                <td colspan="12">MODO DE TRANSPORTE:</td>
                <td colspan="24">AÉREO</td>
            </tr>
            <tr>
                <td colspan="12">TIPO DE EXAMEN:</td>
                <td colspan="24">{{ strtoupper($printQuery->appointmentTypeExam->name) }}</td>
            </tr>
            <tr>
                <td colspan="12">TIPO DE CLASE:</td>
                @if ($printQuery->type_exam_id == 1)
                    <td colspan="24">{{ $printQuery->appointmentStudying[0]->studyingClass->name }}</td>
                @elseif($printQuery->type_exam_id == 2)
                    <td colspan="24">{{ $printQuery->appointmentRenovation[0]->renovationClass->name }}</td>
                @endif
            </tr>
            <tr>
                <td colspan="12">TRAMITE:</td>
                <td colspan="24">EXAMEN PSICOFISICO INTEGRAL</td>
            </tr>
            <tr>
                <td colspan="12">NO. DE CITA:</td>
                <td colspan="24">{{ $sumappointment }}</td>
            </tr>
            <tr>
                <td colspan="12">UNIDAD MÉDICA:</td>
                <td colspan="24"> {{ strtoupper($printQuery->appointmentSuccess->successHeadquarter->name) }}</p>
                </td>
            </tr>
            <tr>
                <td colspan="12">FECHA:</td>
                <td colspan="24">{{ $printQuery->appointmentSuccess->appointmentDate }}</td>
            </tr>
            <tr>
                <td colspan="12">HORA:</td>
                <td colspan="24">{{ $printQuery->appointmentSuccess->appointmentTime }} AM</td>
            </tr>
            <tr>
                <td colspan="12">FOLIO:</td>
                <td colspan="24">{{ $printQuery->id }}</td>
            </tr>
        </table>
        <div style="padding-top:5%">
            <label style="text-align: justify;font-size:18px" for="">
                Estimado usuario, con el fin de facilitar el procedimiento de registro y apoyarle en el proceso de su
                examen psicofísico, le presentamos los siguientes <b>requisitos</b> para presentarse a su
                cita;
                es<b> indispensable</b> que acuda con el <u>original y copia</u> de los siguientes documentos, de lo
                contrario,
                no
                podrá realizar su examen y éste se perderá:
            </label>
        </div>
        <div style="padding-top:2%;font-size:18px">
            <ol class="">
                <li value="1">Comprobante de domicilio con vigencia no mayor a 3 meses.</li>
                <li>Comprobante de pago.</li>
                <li>Cédula de identidad ciudadana (INE) vigente en caso de no contar con ella puede presentar:</li>
                {{-- <p tyle="padding-left:2%">a) Clave Única de Registro de Población (CURP) vigente.</p> --}}
                <p tyle="padding-left:2%">b) Cédula profesional.</p>
                <p tyle="padding-left:2%">c) Licencia de conducir.</p>
                <p tyle="padding-left:2%">d) Pasaporte.</p>
            </ol>
        </div>
        {{-- PAGINA 2 --}}
        <div style='page-break-before:always;'></div>
        <!-- <div style="text-align: center;">
            <h2>GUÍA DE RECOMENDACIONES</h2>
        </div> -->
        <div class="mt-4 mx-7 text-justify ">
            <p>Se hace de su conocimiento la siguiente <b>guía de recomendaciones</b>para agilizar su
                examen psicofísico:</p>
            <ol class="">
                <li value="1">Presentarse en ayuno, no tomar alimentos las 8 horas previas a su hora de cita.
                </li>
                <li>No suspender medicación prescrita.</u>
                </li>
                <li>En caso de haber tenido algún procedimiento dental, esperar mínimo 72 horas posteriores al mismo
                    para agendar su cita.
                </li>
                <li>En caso de haber sido diagnosticado con alguna(s) enfermedad(es) crónica(s) como: enfermedades
                    cardiacas, respiratorias, hipertiroidismo, etc., presentar un resumen clínico expedido por su
                    médico tratante y estudios <b>adicionales (ver ANEXO)</b> con vigencia no mayor a 3 meses para
                    acreditar el estado actual de salud.
                </li>
                <div style="text-align:center;">
                    <h2>EJEMPLO</h2>
                    {{-- <h4>Estudios de laboratorio en caso de tener diagnóstico de enfermedad crónica</h4> --}}
                </div>
                <div class="mt-4 mx-7">
                    <table class="normal" style="width:100%">
                        <tr>
                            <th>PADECIMIENTOS</th>
                            <th>TIPO DE ESTUDIOS</th>
                        </tr>
                        {{-- <tr>
                            <td>Artritis reumatoide</td>
                            <td></td>
                        </tr> --}}
                        <tr>
                            <td>Enfermedad tiroides</td>
                            <td>Perfil Tiroideo</td>
                        </tr>
                    </table>
                </div>
                <br>
                <li>En caso de padecer disminución en la agudeza visual, deberá presentarse con lentes de armazón o de
                    contacto con graduación actualizada. Si alterna el uso de ambos, deberá presentarlos.
                </li>
                <li>En caso de embarazo, presentar constancia de control del mismo, actualizada y hacerlo
                    saber al servicio de rayos X al acudir a su examen.
                </li>
                <li>Acudir con los estudios de laboratorio que a continuación se enlistan, los cuales deberán realizarse
                    en una institución acreditada por la <b>Norma ISO15189-2012</b>, la cual deberá contener: nombre de
                    la institución, dirección, nombre completo del laboratorista, su cédula profesional y número
                    telefónico, a fin de que la Autoridad de Aviación Civil cuente con los elementos para acreditar su
                    validez.
                    <p style="padding-left:10%;">a) Biometría hemática.</p>
                    <p style="padding-left:10%;">b) Química sanguínea de 6 elementos (Glucosa, Nitrógeno Ureico en
                        Sangre,
                        Creatinina, Ácido úrico, Colesterol total y Triglicéridos).</p>
                    <p style="padding-left:10%;">c) Examen General de Orina</p>
                    <p style="padding-left:10%;">d) Radiografía de Tórax Posteroanterior de la siguiente manera:</p>
                    <p style="padding-left:14%;">1. Clase I – cada 3 años.</p>
                    <p style="padding-left:14%;">2. Clase II – cada 4 años.</p>
                    <p style="padding-left:14%;">3. Clase III – cada 3 años.</p>
                    <p style="padding-left:14%;">4. O antes a indicación de su médico examinador.</p>
                    <p style="padding-left:14%;">5. Prueba de detección de sustancias psicoactivas.</p>
                </li>
                <li>Los estudios previamente descritos deberán tener fecha de emisión no mayor a un mes.
                </li>
                <li>Imprimir el formato de Consentimiento Informado y firmarlo.
                </li>
                {{-- <li>Imprimir el formato de Declaración de salud.
                </li> --}}
            </ol>
        </div>
    </div>
</body>

</html>
