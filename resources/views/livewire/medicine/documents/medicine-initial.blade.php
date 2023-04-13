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
        text-align: right;
        font-weight: bold;
        color: #000000;
        margin-top: -13%;
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
</style>

<body class="bgsize">
    <div>
        {{-- <img src="{{ public_path('images/AFAC1.png') }}" width="130" height="100" alt=""> --}}
        <img src="{{ public_path('images/logoafac.png') }}" width="225" height="85" alt="">
        <div class="titulo">
            <h3>ACUSE DE CITA PARA EXAMEN MÉDICO INICIAL</h3>
        </div>
        <div class="cuadrado-2">
            <p>Folio de cita: <b>{{ $medicineReserves[0]->id }}</b></p>
        </div>
        <table class="info">
            <tr>
                <td colspan="12">NOMBRE:</td>
                <td colspan="24">
                    {{ strtoupper($medicineReserves[0]->medicineReserveMedicine->medicineUser->name . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apParental . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apMaternal) }}
                </td>
            </tr>
            <tr>
                <td colspan="12">CURP:</td>
                <td>{{ strtoupper($medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->curp) }}
                </td>
            </tr>
            <tr>
                <td colspan="12">MODO DE TRANSPORTE:</td>
                <td colspan="24">AÉREO</td>
            </tr>
            <tr>
                <td colspan="12">TIPO DE EXAMEN:</td>
                <td colspan="24">{{ strtoupper($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name) }}</td>
            </tr>
            <tr>
                <td colspan="12">TIPO DE CLASE:</td>
                    <td colspan="24">{{ $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name }}</td>
            </tr>
            <tr>
                <td colspan="12">TRAMITE:</td>
                <td colspan="24">EXAMEN PSICOFISICO INTEGRAL</td>
            </tr>
            {{-- <tr>
                <td colspan="12">NO. DE CITA:</td>
            </tr> --}}
            <tr>
                <td colspan="12">UNIDAD MÉDICA:</td>
                <td colspan="24"> <b>{{ strtoupper($medicineReserves[0]->user->name) }}</b></p>
                </td>
            </tr>
            <tr>
                <td colspan="12">FECHA Y HORA:</td>
                <td colspan="24">{{ $medicineReserves[0]->dateReserve }}</td>
            </tr>
        </table>
        <div style="background-color: #e6e6e6;height: 25px; ">
            <h3 class="titulo2">REQUISITOS</h3>
        </div>
        <div style="padding-top:2%">
            <label style="text-align: justify;font-size:18px" for="">Estimado usuario, con el fin de facilitar
                el procedimiento de registro y apoyarle en el proceso de su EVALUACIÓN MÉDICA, le mostramos los
                siguientes
                <b>requisitos indispensables</b> para presentarse a su cita; es indispensable que acuda con los
                siguientes documentos <u>original y
                    copia</u> de lo contrario no podrá realizar su examen y éste se perderá:</label>
        </div>
        <div style="padding-top:1%;font-size:18px">
            <ol class="">
                <li value="1">Comprobante de domicilio con vigencia no mayor a 3 meses.</li>
                <li>Comprobante de pago.</li>
                <li>Comprobante de cita.</li>
                <li>Clave Única de Registro de Población (CURP).</li>
                <li>Una de las siguientes identificaciones con fotografía:</li>
                <p style="padding-left:2%;">A. Cédula de identidad ciudadana (INE) vigente.</p>
                <p style="padding-left:2%;margin-top:-2%;">B. Cédula profesional.</p>
                <p style="padding-left:2%;margin-top:-2%;">C. Cartilla Militar (personal masculino).</p>
                <p style="padding-left:2%;margin-top:-2%;">D. Pasaporte.</p>
                <li>En caso de ser renovación deberá presentar el examen médico anterior</li>
            </ol>
        </div>
        {{-- PAGINA 2 --}}
        <div style='page-break-before:always;'></div>
        <div class="mt-4 mx-4 text-justify">
            <p>Para realizar su evaluación médica, se le proporciona la siguiente <b>guía de requisitos:</b></p>
            <ol>
                <li value="1">Acudir con ropa cómoda, evitando sea de una sola pieza.
                </li>
                <li>Presentarse en ayuno, no tomar alimentos las 8 horas previas a su hora de cita.
                </li>
                <li>No suspender medicación prescrita.</u>
                </li>
                <li>En caso de haber tenido algún procedimiento dental, esperar mínimo 72 horas posteriores al mismo
                    para agendar su cita.
                </li>
                <li>En caso de haber sido diagnosticado con alguna(s) enfermedad(es) crónica(s) (enfermedades cardiacas,
                    respiratorias, hipertiroidismo, etc.), presentar un resumen clínico expedido por su médico tratante
                    de especialidad acorde a la patología y estudios
                    <b>adicionales (ver Anexo)</b> con vigencia no mayor a 2 meses para acreditar el estado actual de
                    salud.
                </li>
                <li>En caso de presentar disminución en la agudeza visual, deberá presentarse con lentes de armazón o de
                    contacto con graduación actualizada. Si alterna el uso de ambos, deberá presentarlos. Para el
                    personal de pilotos en caso de usar lentes de contacto deberá acudir con sus lentes de armazón de
                    repuesto.
                </li>
                <li>En caso de encontrarse embarazada, presentar constancia de control del mismo actualizada y hacerle
                    saber al servicio de rayos X al acudir a su examen.
                </li>
                <li>Acudir con los estudios de laboratorio que a continuación se enlistan, los cuales deberán
                    realizarse en una institución acreditada por la <b>Norma ISO15189-2012</b>, deberá contener:
                    nombre
                    de la institución, dirección, nombre completo del laboratorista, su cédula profesional y número
                    telefónico, a fin de que la Autoridad de Aviación Civil cuente con los elementos para acreditar su
                    validez.
                    <p style="padding-left:3%">A) Biometría hemática.</p>
                    <p style="padding-left:3%">B) Química sanguínea de 6 elementos (Glucosa, Nitrógeno Ureico en Sangre,
                        Creatinina, Ácido úrico, Colesterol total y Triglicéridos).</p>
                    <p style="padding-left:3%">C) Examen General de Orina.</p>
                    <p style="padding-left:3%">D) Prueba de detección de VIH (Anticuerpos).</p>
                    <p style="padding-left:3%">E) Prueba de detección de sustancias psicoactivas en orina, de 5
                        reactivos (Cocaína, Cannabinoides (Marihuana), Opiaceos, Anfetaminas y Benzodiazepinas).</p>
                    <p style="padding-left:3%">F) En el caso del examen médico inicial, presentar radiografía de tórax
                        posteroanterior, y para el examen médico de renovación como a continuación se indica:</p>
                    <p style="padding-left:5%;margin-top:-2%">1. Clase I – cada 3 años.</p>
                    <p style="padding-left:5%;margin-top:-2%">2. Clase II – cada 3 años.</p>
                    <p style="padding-left:5%;margin-top:-2%">3. Clase III – cada 3 años.</p>
                    <p style="padding-left:5%;margin-top:-2%">4. O antes a indicación de su médico examinador.</p>
                </li>
                <li>Los estudios previamente descritos deberán tener fecha de emisión no mayor a un mes.
                </li>
                {{-- <li>Imprimir el formato de Consentimiento Informado y firmarlo.
                </li> --}}
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
                    <td>Perfil lipídico (Colesterol total, triglicéridos, HDL, LDL)</td>
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