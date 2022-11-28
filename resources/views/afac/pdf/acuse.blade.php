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

    <div class="grid grid-cols-3">
        <label class="font-semibold uppercase" for="">Nombre:</label>
        <label class="uppercase col-span-2" for="">{{$userAppointment->appointmentUser->name.' '.$userAppointment->appointmentUser->apParental.' '.$userAppointment->appointmentUser->apMaternal}}</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">CURP:</label>
        <label class="uppercase col-span-2" for="">{{$userAppointment->appointmentUser->curp}}</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">Número de expediente:</label>
        <label class="uppercase col-span-2" for="">1330926</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">Modo de transporte:</label>
        <label class="uppercase col-span-2" for="">Aéreo</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">Categoría:</label>
        <label class="uppercase col-span-2" for="">Grupo I</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">Puesto:</label>
        <label class="uppercase col-span-2" for="">Piloto transp. púb. ilimitado de ala fija o </label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">Trámite:</label>
        <label class="uppercase col-span-2" for="">Examen Psicofísico integral</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">No de cita:</label>
        <label class="uppercase col-span-2" for="">9965278</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">Unidad médica:</label>
        <label class="uppercase col-span-2" for="">Ciudad de México UM aeropuerto</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">Mes:</label>
        <label class="uppercase col-span-2" for="">Octubre</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">Día:</label>
        <label class="uppercase col-span-2" for="">Jueves 20</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase" for="">Hora:</label>
        <label class="uppercase col-span-2" for="">8:00</label>
    </div>
    <div class="grid gap-x-8 grid-cols-3">
        <label class="font-semibold uppercase space-y-12" for="">Folio:</label>
        <label class="uppercase col-span-2" for="">996527829/10/2022psb8:00</label>
    </div>

    <div class="grid-cols-2">
        <label class="font-semibold uppercase mt-36 inline-flex" for="">Requisitos:</label>
        <label class="" for="">Si alguno de estos documentos no son presentados el día
            de su cita, no podrá realizar su examen por lo que este se perderá. Identificación oficial (Se acepta
            únicamente INE vigente, Cédula de identidad ciudadana, Cédula profesional, cartilla militar, licencia
            federal, título, certificado o libreta de mar y de identificación marítima) ORIGINAL Y COPIA.
            Comprobante de domicilio (con vigencia no mayor a 3 meses)COPIA. Comprobante de pago. ORIGINAL. CURP
            COPIA.
        </label>
    </div>
    <div class="mt-4 relative flex py-5 items-center">
        <h1 class="text-left after:align-bottom after:w-72 after:bg-black after:h-[1px] after:inline-block after:relative after:left-2"
            for="">Firma</h1>
    </div>
</body>

</html>
