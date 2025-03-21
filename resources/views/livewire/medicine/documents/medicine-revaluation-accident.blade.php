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
        bottom: 35px;
        height: 0px;
        right: -0.2%;
    }
</style>

<body class="bgsize">
    <footer>
        @if ($medicineReserves[0]->dateReserve > '2023-12-31')
        <center><img src="{{ public_path('images/fooderafac2024.png') }}" width="112%" height=80" alt="">
        </center>
        @else
        <center><img src="{{ public_path('images/fooderafac2023.png') }}" width="112%" height=80" alt="">
        </center>
        @endif
    </footer>
    <div>
        {{-- <img src="{{ public_path('images/AFAC1.png') }}" width="130" height="100" alt=""> --}}
        <img src="{{ public_path('images/banner2023afac.png') }}" width="450" height="45" alt="">
        <div class="cuadrado-2">
            <p>Folio de cita: <b>MED-{{ $medicineReserves[0]->id }}</b></p>
        </div>
        <div class="titulo">
            <h3>ACUSE DE CITA PARA EXAMEN MÉDICO REVALUACIÓN POR ACCIDENTE</h3>
        </div>
        <table style="margin-top: 3%;">
            <tr>
                <td>NOMBRE:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineUser->name . ' ' .
                    $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apParental')->first()
                    . ' ' .
                    $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apMaternal')->first()
                    }}
                </td>
            </tr>
            <tr>
                <td>CURP:</td>
                <td>
                    {{
                    $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('curp')->first()
                    }}
                </td>
            </tr>
            <tr>
                <td>MODO DE TRANSPORTE:</td>
                <td>AÉREO</td>
            </tr>
            <tr>
                <td>TIPO DE EXAMEN:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name }}</td>
            </tr>
            <tr>
                <td>TIPO DE CLASE:</td>
                <td>
                    {{ $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name
                    }}
                </td>
            </tr>
            <tr>
                <td>TIPO DE LICENCIA:</td>
                <td>
                    @foreach ($medicineReserves[0]->medicineReserveMedicine->medicineRenovation as $renovationEach)
                    {{-- MAS DE UNA LICENCIA --}}
                    @if ($medicineReserves[0]->medicineReserveMedicine->medicineRenovation->count() > 1)
                    <ul>
                        <li>
                            {{ $renovationEach->renovationClasificationClass->name }}
                        </li>
                    </ul>
                    @else
                    {{-- UNA SOLA LICENCIA --}}
                    {{ $renovationEach->renovationClasificationClass->name }}
                    @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>TRAMITE:</td>
                <td>EVALUACIÓN MEDICA</td>
            </tr>
            <tr>
                <td>UNIDAD MÉDICA:</td>
                <td><b>{{ $medicineReserves[0]->medicineReserveHeadquarter->name_headquarter }}</b></p>
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
            <!-- CADENA DE DEPENDECIA PARTIR DE 24/01/2025  -->
            @if($medicineReserves[0]->medicineReserveMedicine->dep_chain != '')
            <tr>
                <td>CADENA DE DEPENDENCIA</td>
                <td>{{ $medicineReserves[0]->medicineReserveMedicine->dep_chain }}</td>
            </tr>
            @endif
        </table>
        <div class="codigoqr">

            <img src="{{ $keyEncrypt }}" width="120" height="120" />
            {{-- <img src="http://chart.googleapis.com/chart?chs=70x70&chld=L|0&cht=qr&chl={{ $keyEncrypt }}"
                width="120" height="120" /> --}}
        </div>
        <div style="background-color: #e6e6e6;height: 25px; ">
            <h3 class="titulo2">REQUISITOS</h3>
        </div>
        <div style="padding-top:2%">
            <label style="text-align: justify;font-size:17px" for="">Estimado usuario, con el fin de facilitar
                el procedimiento de registro y apoyarle en el proceso de su <b> EVALUACIÓN MÉDICA</b>, le mostramos los
                siguientes
                <b>requisitos indispensables</b> con los que deberá acudir a su cita <u>original y
                    copia</u> de lo contrario no podrá realizar su examen y éste se perderá:</label>
        </div>
        <div style="padding-top:1%;font-size:17px">
            <ol style="text-align: justify">
                <li value="1">Acta de nacimiento (Con formato vigente a la fecha de su examen).</li>
                <li>Comprobante de domicilio con vigencia no mayor a 3 meses.</li>
                <li>Comprobante de pago (original).</li>
                <li>Comprobante de cita.</li>
                <li>Clave Única de Registro de Población (CURP).</li>
                <li>Deberá presentar en forma impresa los formatos de declaración de salud,
                    consentimiento informado (mismos que debe llenar y firmar) así como el vale de
                    servicios que se incluyen al final de este documento.</li>
                <li>Una de las siguientes identificaciones con fotografía:</li>
                <p style="padding-left:2%;">A. Cédula de identidad ciudadana (INE) vigente.</p>
                <p style="padding-left:2%;margin-top:-2%;">B. Cédula profesional (siempre y cuando cuente con
                    fotografía).</p>
                <p style="padding-left:2%;margin-top:-2%;">C. Cartilla Militar (personal masculino).</p>
                <p style="padding-left:2%;margin-top:-2%;">D. Pasaporte.</p>
                <p style="padding-left:2%;margin-top:-2%;">E. Credencial con fotografía de la Institución Educativa,
                    donde esté realizando
                    estudios, exclusivamente para menores de edad, que no cuenten con ninguna
                    de las identificaciones anteriores, y en caso de no contar con esta última, se
                    podrá utilizar la CURP como identificación oficial.</p>
                <li>Acudir con ropa cómoda, evitando sea de una sola pieza.</li>
                <li>Tomar un desayuno ligero, en caso de acudir en ayuno llevar su refrigerio.</li>
                <li>No suspender medicación prescrita.</li>
                <li>En caso de haber tenido algún procedimiento dental, esperar mínimo 72 horas posteriores al mismo
                    para agendar su cita.</li>
                <li>En caso de haber sido diagnosticado con alguna(s) enfermedad(es) crónica(s)
                    (enfermedades cardiacas, respiratorias, hipertiroidismo, etc.), presentar un resumen
                    clínico expedido por su médico tratante de especialidad acorde a la patología y
                    estudios <b> adicionales (Ver Anexo)</b> con vigencia no mayor a 2 meses para acreditar
                    el estado actual de salud.
                </li>
                <li>
                    En caso de presentar disminución en la agudeza visual, deberá presentarse con
                    lentes de armazón o de contacto con graduación actualizada. Si alterna el uso de
                    ambos, deberá presentarlos. Para el personal de pilotos en caso de usar lentes de
                    contacto deberá acudir con sus lentes de armazón de repuesto.
                </li>
                <li>En caso de encontrarse embarazada, presentar constancia o expediente de control del mismo
                    actualizada y hacerle saber al servicio de rayos X al acudir a su examen.
                </li>
                <li>Acudir con los estudios de laboratorio que a continuación se enlistan, los cuales deberán realizarse
                    en una institución acreditada por la <b> Norma ISO15189-2012</b>, debiendo contener nombre de la
                    institución, dirección, nombre completo
                    del laboratorista, cédula profesional y número telefónico, así como <b>fecha de emisión no
                        mayor a un mes de la cita programada.</b></li>
                <p style="padding-left:3%">A) Biometría hemática.</p>
                <p style="padding-left:3%">B) Química sanguínea de 6 elementos (Glucosa, Nitrógeno Ureico en Sangre,
                    Creatinina, Ácido úrico, Colesterol total y Triglicéridos).</p>
                <p style="padding-left:3%">C) Examen General de Orina.</p>
                <p style="padding-left:3%">D) Prueba de detección de sustancias psicoactivas en orina, de 5 reactivos
                    (Cocaína, Cannabinoides, Opiaceos, Anfetaminas y Benzodiazepinas). Verificar que la totalidad de sus
                    resultados esten reportados o de lo contrario no podrá ser atendido.</p>
                <p style="padding-left:3%">E) Hemoglobina glucosilada.</p>
                <p style="padding-left:3%">F) Radiografía de tórax postero-anterior o más conocida como la tele de
                    tórax, se
                    deberá presentar cada 3 años para cualquier tipo de licencia o antes en caso de
                    que su médico examinador lo indique de acuerdo con la condición clínica
                    preexistente o a las patologías agregadas <b> (en
                        caso de hacer cita en la Unidad Médica Aeropuerto, Ciudad de México, no será
                        necesario presentar RX de Tórax)</b>.
                </p>
            </ol>
            <p><b> Nota:</b> Es importante notar, que, si no ha entregado en los tres años anteriores a
                la fecha de su examen, una radiografía de tórax en el sitio de su evaluación
                médica, esta se deberá llevar el día de su evaluación y a partir de esa fecha, será
                cada 3 años.</p>
        </div>
        <footer>
            <div class="codigoqr">
                <img src="http://chart.googleapis.com/chart?chs=70x70&chld=L|0&cht=qr&chl={{ $keyEncrypt }}" width="120"
                    height="120" />
            </div>
        </footer>
        <div style='page-break-before:always;'></div>
        <h2 class="titulo3">ANEXO</h2>
        <h4 style="margin-top:-2%" class="titulo3">Estudios de laboratorio en caso de tener diagnóstico de enfermedad
            crónica
        </h4>
        <div class="mt-4 mx-7">
            <table class="normal" style="width:100%">
                <tr>
                    <th style="background-color: #e6e6e6">Diagnostico</th>
                    <th style="background-color: #e6e6e6">Estudios complementarios</th>
                </tr>
                <tr>
                    <td>Diabetes tipo 2</td>
                    <td>Hemoglobina glucosilada y los demás que solicite su médico examinador de acuerdo con su
                        condición clínica.</td>
                </tr>
                <tr>
                    <td>Hipertensión arterial sistémica</td>
                    <td>Presentar curva de tensión arterial de 10 días previos a su valoración médica,<b>ver guía*</b>.
                    </td>
                </tr>
                <tr>
                    <td>Hiper o hipotiroidismo</td>
                    <td>Perfil tiroideo (TSH, T4 Libre y T3 Total)</td>
                </tr>
                <tr>
                    <td>Antecedente de COVID 19</td>
                    <td>Telerradiografía de tórax o algún otro estudio de imagen y de la función pulmonar que determine
                        su médico examinador de acuerdo con su condición clínica.</td>
                </tr>
                <tr>
                    <td>Antecedente de Infarto Agudo al Miocardio</td>
                    <td>Perfil lipídico (Colesterol total, triglicéridos, HDL, LDL), electrocardiograma de esfuerzo y
                        los estudios que se determinen de acuerdo con su condición clínica.</td>
                </tr>
                <tr>
                    <td>HIV positivo</td>
                    <td>Carga viral, recuento de linfocitos CD4, CD8 y las que determine su médico examinador de acuerdo
                        con su condición clínica.
                    </td>
                </tr>
            </table>
            <p> <b> Nota: </b>Para todos los casos se deberá contar con la nota médica o valoración del especialista de
                cabecera que lleve control de su padecimiento</p>
        </div>
    </div>
</body>

</html>