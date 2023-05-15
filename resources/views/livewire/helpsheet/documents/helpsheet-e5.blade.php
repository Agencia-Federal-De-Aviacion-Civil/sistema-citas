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
    @page {
        margin: 0cm 0cm 0cm 0cm;
        border: red 2px solid;
    }
    
    body{
        margin-top: 0.5cm;
        margin-left: 1.5cm;
        margin-right: 1.5cm;
        margin-bottom: 0.5cm;
    }

    h3{
        color:#black;
        font-size:30px;
        text-align: center;
        font-style: oblique;
    }
    
    .cuadradofull{
     width: auto; 
     height: auto; 
     border: 1.5px solid #000000;

  justify-content: center;
    }
    
   .cuadrado-3 {
     margin-left: 25px;
     width: 630px; 
     height: 18px; 
     background: #a2a2a2;
       
   }
   .dpa{
       margin-left: 960px;
       margin-top: -0.2%;
       font-size:18px;
   }
   .titulo{
       text-align:center;
        margin-top: 0.5%;
   }
   .titulo2{
       text-align:center;
       font-size:20px;
       margin-top: -2.5%;
       
   }
   .labels{
       font-size:15px;

   }
   .labelsx{
       font-size:12px;

   }
   .labels2{ 
       font-size:11px;
       font-style: oblique;
       margin-top: -0.8%;
       color:"black";
   }
   .labels3{
       font-size:17px;
   }
   .clave{
       font-size:42px;
       text-align:center;
   }
   .contenedor {
       text-align: left;
       width: 100%;
       margin: auto;
       
   }
   .derecha {
    margin-top: 1%;
       width: 50%;  /* Este será el ancho que tendrá tu columna */
       text-align:center;
       float:left; /* Aquí determinas de lado quieres quede esta "columna" */
    }
    .izquierda {
        margin-top: 1%;
       width: 50%;  /* Este será el ancho que tendrá tu columna */
       text-align:center;
       float:right; /* Aquí determinas de lado quieres quede esta "columna" */
    }
    .info{
        margin-left: 3%;
    }
    .info2{
        margin-left: 3%;
    }
    .cuadradito{
       /* Rectangle 39 */
       
       width: 22px;
       height: 22px;
       margin-left: 80%;
       margin-top: 1%;
       border: 2px solid black;
       box-sizing: border-box;
       
    }
    .cuadraditop2{
       /* Rectangle 39 */
       
       width: 22px;
       height: 22px;
       margin-left: 0.5%;
       margin-top: -1%;
       border: 2px solid black;
       box-sizing: border-box;
       
    }
    .cuadraditop3{
       /* Rectangle 39 */
       
       width: 22px;
       height: 22px;
       margin-left: 0.5%;
       margin-top: -5%;
       border: 2px solid black;
       box-sizing: border-box;
       
    }
    .infoclave{
        margin-left: 15%;
        margin-top: -10%;
    }
    .infocl2{
        margin-left: 3%;
        margin-top: 2%;
    }
    .infoclave2{
        margin-left: 15%;
        margin-top: -15%;
    }
    .line1{
        margin-top: -2.5%;

    }
    .line2{
        margin-top: -0.5%;

    }
</style>

<body class="bgsize">
    <div class="cuadradofull">
        <div class="cuadrado-3"></div>
        {{-- <p class="dpa">DPA</p> --}}
        {{-- <h4 class="titulo">HOJA DE AYUDA PARA EL PAGO EN VENTANILLA BANCARIA</h4> --}}
        <p class="titulo">HOJA DE AYUDA PARA EL PAGO EN VENTANILLA BANCARIA</p>
        <p class="titulo2"> <b>DERECHOS PRODUCTOS Y APROVECHAMIENTOS</b> </p>
        <hr width="460" class="line1">
        <div class="contenedor">
            <div class="derecha">
                <label class="labels"> <b>
                 SOSL891201MMCTNR04
                </label>
                <hr width=90% class="line2">
                <p class="labels2">REGISTRO FEDERAL DE CONTRIBUYENTES</p>
            </div>
            <div class="izquierda">
                <label class="labels"><b>
                    SOSL891201MMCTNR04
                </b>
                </label>
                <hr width=90% class="line2">
                <p class="labels2">CLAVE ÚNICA DE REGISTRO DE POBLACIÓN</p>
            </div>
        </div>
        <div class="info">
            <label class="labels"><b>
                SOTO
            </b>
                </label>
            <hr width=475 style="margin-left: -0.4%;margin-top: -0.5%;">
             <p class="labels2" style="">APELLIDO PATERNO</p>
        </div>
        <div class="info">
            <label class="labels">
                <b>SANCHEZ</b>
                </label>
            <hr width=475 style="margin-left: -0.4%;margin-top: -0.5%;">
             <p class="labels2" style="margin-top: -0.5%">APELLIDO MATERNO</p>
        </div>
        <div class="info">
            <label class="labels">
                <b>LAURA JESSICA</b>
                </label>
            <hr width=475 style="margin-left: -0.4%;margin-top: -0.5%;">
             <p class="labels2" style="margin-top: -0.5%;">NOMBRE(S)</p>
        </div>
        <div class="info">
            <label class="labels">
            </label>
            <hr width=475 style="margin-left: -0.4%;">
             <p class="labels2" style="margin-top: -0.5%;">DENOMINACIÓN O RAZÓN SOCIAL
            </p>
        </div>
        <div class="info">
            <label class="labels">
                <b>SECRETARIA DE INFRAESTRUCTURA, COMUNICACIONES Y TRANSPORTES</b>
                </label>
            <hr width=475 style="margin-left: -0.4%;margin-top: -0.5%;">
             <p class="labels2" style="margin-top: -0.5%;">DEPENDENCIA</p>
        </div>
        <div class="info">
            <p class="labelsx">MARQUE CON X</p>
        </div>
        <br>
        <div class="info">
            <div class="cuadraditop2">
                <span id="idprgusp" name="idprgusp" class="palomita"></span>
            </div>
            <p class="labels" style="margin-left: 5%;margin-top: -5%;">NO APLICA PERIODO</p>
        </div>
        <div class="info2">
            <table WIDTH="100%">
                <tr class="labels3">
                    <td><p style="margin-left: 30%">MENSUAL</p><div class="cuadraditop3"><span id="" name="" class="palomita"></span></div></td>
                    <td><p style="margin-left: 30%">BIMESTRAL</p><div class="cuadraditop3"><span id="" name="" class="palomita"></td>
                    <td><p style="margin-left: 30%">TRIMESTRAL</p><div class="cuadraditop3"><span id="" name="" class="palomita"></td>
                    <td><p style="margin-left: 20%">CUATRIMESTRAL</p><div class="cuadraditop3"><span id="" name="" class="palomita"></td>
                    <td><p style="margin-left: 30%">SEMESTRAL</p><div class="cuadraditop3"><span id="" name="" class="palomita"></td>
                    <td><p style="margin-left: 30%;font-size:16px">DEL EJERCICIO</p><div class="cuadraditop3"><span id="" name="" class="palomita"></td>
                    
                </tr>
            </table>
        </div>
        <div class="contenedor">
            <div class="derecha">
                <label class="labels">
                 DICIEMBRE
                </label>
                <hr width=70%>
                <p class="labels2">EJEMPLO : MES - ENERO, FEBRERO, ETC.</p>
            </div>
            <div class="izquierda">
                <label class="labels">
                    2022
                </label>
                <hr width=70%>
                <p class="labels2">AAAA</p>
            </div>
        </div>
        <div class="info">
            <p class="labels">CLAVE DE <br> REFERENCIA:</p>
            <div class="infoclave">
                <table WIDTH="50%">
                    <tr class="clave">
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="infocl2">
            <p class="labels">CLAVE DE LA<br> DEPENDENCIA:</p>
            <div class="infoclave2">
                <table WIDTH="90%">
                    <tr class="clave">
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                </table>
            </div>
        </div>
        
    </div>
</body>

</html>
