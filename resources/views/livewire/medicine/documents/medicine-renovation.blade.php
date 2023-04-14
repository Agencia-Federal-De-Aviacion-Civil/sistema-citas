<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>
    </title>
</head>
<style>
    .titulo {
        text-align: right;
        font-weight: bold;
        color: #000000;
        margin-top: -13%;
        font-size: 17px;

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
        margin-top: -5%;
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
    }
    footer {
        position: fixed;
        bottom: 30px;
        right: 0px;
        height: 60px;
    }  
</style>

<body class="bgsize">
    <div>
        {{-- <img src="{{ public_path('images/AFAC1.png') }}" width="130" height="100" alt=""> --}}
        <img src="{{ public_path('images/logoafac.png') }}" width="225" height="85" alt="">
        <div class="titulo">
            <p>ACUSE DE CITA PARA EXAMEN MÉDICO RENOVACIÓN</p>
        </div>
        <div class="cuadrado-2">
            <p>Folio de cita: <b>MED-{{ $medicineReserves[0]->id }}</b></p>
        </div>
        <table style="margin-top: 6%;">
            <tr>
                <td>NOMBRE:</td>
                <td>
                    {{ mb_strtoupper($medicineReserves[0]->medicineReserveMedicine->medicineUser->name . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apParental')->first() . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apMaternal')->first()) }}
                </td>
            </tr>
            <tr>
                <td>CURP:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('curp')->first() }}
                </td>
            </tr>
            <tr>
                <td>MODO DE TRANSPORTE:</td>
                <td>AÉREO</td>
            </tr>
            <tr>
                <td>TIPO DE EXAMEN:</td>
                <td>
                    {{ mb_strtoupper($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name) }}</td>
            </tr>
            <tr>
                <td>TIPO DE CLASE:</td>
                <td>
                    {{ mb_strtoupper($medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name) }}
                </td>
            </tr>
            <tr>
                <td>TRAMITE:</td>
                <td>EXAMEN PSICOFISICO INTEGRAL</td>
            </tr>
            <tr>
                <td>UNIDAD MÉDICA:</td>
                <td><b>{{ mb_strtoupper($medicineReserves[0]->user->name) }}</b></p>
                </td>
            </tr>
            <tr>
                <td>DIRECCIÓN SEDE:</td>
                <td> {{ strtoupper($medicineReserves[0]->user->userHeadquarter[0]->direction) }}</p>
                </td>
            </tr>
            <tr>
                <td>FECHA Y HORA:</td>
                <td>{{ $medicineReserves[0]->dateReserve }}</td>
            </tr>
        </table>
        <div style="background-color: #e6e6e6;height: 25px; ">
            <h3 class="titulo2">REQUISITOS</h3>
        </div>
        <div style="padding-top:2%">
            <label style="text-align: justify;font-size:18px" for="">
                Estimado usuario, con el fin de facilitar el procedimiento de registro y apoyarle en el proceso de su
                EVALUACIÓN MÉDICA, le mostramos los siguientes <b>requisitos indispensables</b> para presentarse a su
                cita; es preciso que acuda con los siguientes documentos en
                <u>original y copia</u> de lo contrario, no podrá realizar su examen y éste se perderá:
            </label>
        </div>
        <div style="padding-top:2%;font-size:18px">
            <ol class="">
                <li value="1">Comprobante de domicilio con vigencia no mayor a 3 meses.</li>
                <li>Comprobante de pago.</li>
                <li>Comprobante de cita.</li>
                <li>Clave Única de Registro de Población (CURP).</li>
                <li>Deberá presentar en forma impresa los formatos de declaración de salud, consentimiento informado (mismos que debe llenar y firmar) así como el vale de servicios que se incluyen al final de este documento.</li>
                <li>Una de las siguientes identificaciones con fotografía:</li>
                <p style="padding-left:2%;">A. Cédula de identidad ciudadana (INE) vigente.</p>
                <p style="padding-left:2%;margin-top:-2%;">B. Cédula profesional.</p>
                <p style="padding-left:2%;margin-top:-2%;">C. Cartilla Militar (personal masculino).</p>
                <p style="padding-left:2%;margin-top:-2%;">D. Licencia de manejo.</p>
                <p style="padding-left:2%;margin-top:-2%;">E. Pasaporte.</p>
            </ol>
        </div>
        <footer>
            <div class="codigoqr">
                <img src="http://chart.googleapis.com/chart?chs=70x70&chld=L|0&cht=qr&chl={{ $keyEncrypt }}"
                    width="120" height="120" />
            </div>
        </footer>
        {{-- PAGINA 2 --}}
        <div style='page-break-before:always;'></div>
        <!-- <div style="text-align: center;">
            <h2>GUÍA DE RECOMENDACIONES</h2>
        </div> -->
        <div class="mt-4 mx-7 text-justify ">
            <p>Se hace de su conocimiento la siguiente <b> guía de recomendaciones </b> para agilizar su evaluación
                médica:</p>
            <ol class="">
                <li value="1">Acudir con ropa cómoda, evitando sea de una sola pieza
                </li>
                <li>Presentarse en ayuno, no tomar alimentos las 8 horas previas a su hora de cita</u>
                </li>
                <li>No suspender medicación prescrita
                </li>
                <li>En caso de haber tenido algún procedimiento dental, esperar mínimo 72 horas posteriores al mismo
                    para agendar su cita.
                </li>
                <li>En caso de haber sido diagnosticado con alguna(s) enfermedad(es) crónica(s) (enfermedades cardiacas, respiratorias, hipertiroidismo, etc.), presentar un resumen clínico expedido por su médico tratante de especialidad acorde a la patología y estudios <b>adicionales (Ver ANEXO)</b> con vigencia no mayor a 2 meses para acreditar el estado actual de salud. 
                </li>
                <li>En caso de presentar disminución en la agudeza visual, deberá presentarse con lentes de armazón
                    o de contacto con graduación actualizada. Si alterna el uso de ambos, deberá presentarlos. Para el
                    personal de pilotos en caso de usar lentes de contacto deberá acudir con sus lentes de armazón de
                    repuesto.
                </li>
                <li>En caso de presentar embarazo, presentar constancia de control del mismo, actualizada y hacerlo
                    saber al servicio de rayos X al acudir a su examen.
                </li>
                <li>Acudir con los estudios de laboratorio que a continuación se enlistan, los cuales deberán
                    realizarse en una institución acreditada por la
                    <b>Norma ISO15189-2012</b>, la cual deberá contener: nombre de la institución, dirección, nombre
                    completo del laboratorista,
                    su cédula profesional y número telefónico, a fin de que la Autoridad de Aviación Civil cuente con
                    los elementos
                    para acreditar su validez.
                    <p style="padding-left:3%">A) Biometría hemática.</p>
                    <p style="padding-left:3%">B) Química sanguínea de 6 elementos (Glucosa, Nitrógeno Ureico en Sangre,
                        Creatinina, Ácido úrico, Colesterol total y Triglicéridos).</p>
                    <p style="padding-left:3%">C) Examen General de Orina.</p>
                    <p style="padding-left:3%">E) Prueba de detección de sustancias psicoactivas en orina, de 5
                        reactivos (Cocaína, Cannabinoides (Marihuana), Barbitúricos, Anfetaminas y Benzodiazepinas).</p>
                    <p style="padding-left:3%">F) Radiografía de Tórax Posteroanterior, la cual se deberá presentar
                        con la siguiente periodicidad de acuerdo a la clase:</p>
                    <p style="padding-left:5%;margin-top:-2%">1. Clase I – cada 3 años.</p>
                    <p style="padding-left:5%;margin-top:-2%">2. Clase II – cada 3 años.</p>
                    <p style="padding-left:5%;margin-top:-2%">3. Clase III – cada 3 años.</p>
                    <p style="padding-left:5%;margin-top:-2%">4. O antes a indicación de su médico examinador.</p>
                </li>
                <p style="margin-top:-2%">****En caso de hacer cita en la UM Aeropuerto no será necesario presentar RX de Tórax</p>
                <li>Los estudios previamente descritos deberán tener fecha de emisión no mayor a un mes.
                </li>
                {{-- <li>Imprimir el formato de Declaración de salud.
                </li> --}}
            </ol>
        </div>
        {{-- PAGINA 3 ANEXOS --}}
        <div style='page-break-before:always;'></div>
        <h2 class="titulo3">ANEXO</h2>
        <h3 style="margin-top:-2%" class="titulo3">Estudios de laboratorio en caso de tener diagnóstico de enfermedad
            crónica</h3>
        <div class="mt-4 mx-7">
            <table class="normal" style="width:100%">
                <tr>
                    <td>Diabetes tipo 2</td>
                    <td>Hemoglobina glucosilada</td>
                </tr>
                <tr>
                    <td>Hipertensión arterial sistémica</td>
                    <td>Presentar curva de tensión arterial*</td>
                </tr>
                <tr>
                    <td>Hiper o hipotiroidismo</td>
                    <td>Perfil tiroideo (TSH, T4 Libre y T3 Total)</td>
                </tr>
                <tr>
                    <td>Antecedente de COVID 19</td>
                    <td>Radiografía de Tórax Posteroanterior y posteriormente a indicación de su médico examinador.</td>
                </tr>
                <tr>
                    <td>Antecedente de Infarto Agudo al Miocardio</td>
                    <td>Perfil lipídico (Colesterol total, triglicéridos, HDL, LDL) Deberá proporcionar los estudios con que cuente desde el inicio de su padecimiento.</td>
                </tr>
                <tr>
                    <td>HIV positivo</td>
                    <td>Carga viral y recuento de linfocitos CD4 y CD8</td>
                </tr>
            </table>
        </div>
        <p>*Pasos para el registro de la toma de tensión arterial:</p>
        <ol>
            <li value="1">Recuerde la medida de la presión arterial consta de 2 números presión sistólica sobre
                diastólica (por ejemplo, 120/80)
            </li>
            <li>Elija una hora del día para su medición la cual deberá ser la misma durante los 10 días de medición.
            </li>
            <li>Antes de realizarla asegúrese de no estar agitador permanezca 10 minutos sentado y tranquilo antes de
                realizar la medición.</u>
            </li>
            <li>Si lleva ropa de manga larga suba la manga lo mayor posible evitando que quede demasiado apretada, sino
                es posible, retire esa prenda.
            </li>
            <li>Asegúrese de haber colocado adecuadamente el aparto para la medición (siga las instrucciones de uso)
            </li>
            <li>Tras la toma, registre los datos en el día correspondiente
            </li>
        </ol>
        <div class="mt-4 mx-7">
            <table class="normal" style="width:100%">
                <tr>
                    <td colspan="5">Nombre del paciente:</td>
                </tr>
                <tr>
                    <td colspan="5">Medicamentos que está tomando para la presión (anotar dosis y frecuencia)
                        Ejemplo: Captopril 50 mg cada 24 hrs.
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td rowspan="2">Día</td>
                    <td rowspan="2">Fecha</td>
                    <td rowspan="2">Hora</td>
                    <td colspan="2">PRESIÓN ARTERIAL</td>
                </tr>
                <tr style="text-align: center;">
                    <td>SISTOLICA</td>
                    <td>DIASTOLICA</td>
                </tr>
                <tr style="text-align: center;">
                    <td>1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="text-align: center;">
                    <td>2</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="text-align: center;">
                    <td>3</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="text-align: center;">
                    <td>4</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="text-align: center;">
                    <td>5</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="text-align: center;">
                    <td>6</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="text-align: center;">
                    <td>7</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="text-align: center;">
                    <td>8</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="text-align: center;">
                    <td>9</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="text-align: center;">
                    <td>10</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
