<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>Document</title>
</head>

<body>

<div>
         {{--<img src="{{ asset('images/headerOrigen.jpg') }}" align="center" style="padding-top:1%;margin-left:1%;" width="300" height="110" alt="">--}}
         <div class="titulo">
             <h3>COMPROBANTE DE CITA</h3>
         </div>
        
        <table>
            <tr>
                <td colspan="12">NOMBRE</td>
                <td colspan="24">{{$userAppointment->appointmentUser->name.' '.$userAppointment->appointmentUser->apParental.' '.$userAppointment->appointmentUser->apMaternal}}</td>
            </tr>
            <tr>
                <td colspan="12">CURP:</td>
                <td>{{$userAppointment->appointmentUser->curp}}</td>
            </tr>
            <tr>
                <td colspan="12">NUMERO DE EXPEDIENTE:</td>
                <td colspan="24">1330926</td>
            </tr>
            <tr>
                <td colspan="12">MODO DE TRASPORTE:</td>
                <td colspan="24">AÉREO</td>
            </tr>
             <tr>
                <td colspan="12">TIPO DE EXAMEN:</td>
                <td colspan="24">TIPO DE EXAMEN</td>
            </tr>
            <tr>
                <td colspan="12">TIPO DE CLASE</td>
                <td colspan="24">TIPO DE CLASE</td>
            </tr>
            <tr>
                <td colspan="12">TRAMITE</td>
                <td colspan="24">EXAMEN PSICOFISICO INTEGRAL</td>
            </tr>
            <tr>
                <td colspan="12">NO. DE CITA</td>
                <td colspan="24">9965278</td>
            </tr>
            <tr>
                <td colspan="12">UNIDAD MÉDICA:</td>
                <td colspan="24">Ciudad de México UM aeropuerto</td>
            </tr>
            <tr>
                <td colspan="12">MES:</td>
                <td colspan="24">Octubre</td>
            </tr>
             <tr>
                <td colspan="12">DIA:</td>
                <td colspan="24">Jueves 20</td>
            </tr>
             <tr>
                <td colspan="12">HORA:</td>
                <td colspan="24">8:00</td>
            </tr>
            <tr>
                <td colspan="12">FOLIO:</td>
                <td colspan="24">EXAMEN PSICOFISICO INTEGRAL</td>
            </tr>
        </table>
        <div style="padding-top:5%">
            <label  for="">Requisitos:</label>
            <div style="padding-left:18%;padding-top:-4%;text-align: justify;"><label >Si alguno de estos documentos no son presentados el día de su cita, no podrá realizar su examen
            por lo que este se perderá. Identificación oficial (Se acepta únicamente INE vigente, Cédula de identidad
            ciudadana, Cédula profesional, cartilla militar, licencia federal, título, certificado o libreta de mar y de
            identificación marítima) ORIGINAL Y COPIA. Comprobante de domicilio (con vigencia no mayor a 3
            meses)COPIA. Comprobante de pago. ORIGINAL. CURP COPIA. </label></div>
            
        </div>
        <p style="padding-left:15%">FIRMA: </p>
        <hr Style="margin-top:-2%" width="50%">
    </div>
</body>

</html>
