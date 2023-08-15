<?php

namespace App\Http\Controllers\Afac\CertificateQr;

use App\Http\Controllers\Controller;
use App\Models\Medicine\CertificateQr\MedicineCertificateQr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateQrController extends Controller
{
    public function index()
    {
        $document = MedicineCertificateQr::with('certificateQrDocument')->where('id', 1)->firstOrFail();
        // $outputFile = Storage::disk('do')->path('ready.pdf');
        $outputFile = storage_path("app\public/" . $document->certificateQrDocument->name_document);
        // fill data
        $queuServer = $this->fillPDF(Storage::disk('do')->url($this->document->file), $outputFile);
        //output to browser
        return response()->file($outputFile);
    }
    public function fillPDF($file, $outputFile)
    {
        $fpdi = new Rpdf;
        // merger operations
        // $count = $fpdi->setSourceFile($file);
        $count = $fpdi->setSourceFile(StreamReader::createByString(file_get_contents($file)));
        for ($i = 1; $i <= $count; $i++) {
            $template   = $fpdi->importPage($i);
            $size       = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
            $dataResult = Crypt::encryptString($this->document->curp);
            //  $dataResult = $this->document->id;
            $fpdi->SetFont("arial", "", 7);
            $fpdi->Image('http://chart.googleapis.com/chart?chs=70x70&chld=L|0&cht=qr&chl=' . $dataResult . '&.png', 150, 170, 25, 0,);
            //   $fpdi->Image('http://chart.googleapis.com/chart?chs=70x70&chld=L|0&cht=qr&chl=http://127.0.0.1:8000/license/' . $dataResult . '&.png', 150, 170, 25, 0,);
            //------------ Segunda página------------------------------------------------------------------
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));

            //FUENTE
            $fpdi->SetTextColor(110, 110, 110);
            $fpdi->SetFontSize(10);
            //$fpdi->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');
            //LOGO MARCA DE AGUA CENTRO 
            $fpdi->Image('images/afachorizX20.png', 20, 100, 70, 90, 'png');
            $fpdi->Image('images/afachorizX20.png', 165, 25, 25, 35, 'png');
            $fpdi->Image('images/afachorizX20.png', 165, 95, 25, 35, 'png');
            $fpdi->Image('images/afachorizX20.png', 165, 165, 25, 35, 'png');
            $fpdi->Image('images/afachorizX20.png', 165, 235, 25, 35, 'png');
            //Texto caja 1
            $fpdi->Ln(0); // Line gap
            $fpdi->SetX(199);
            $fpdi->Rotate(270);
            $fpdi->MultiCell(66, 4, utf8_decode('1.El certificado de Aptitud Psicofísica tendrá una validez de noventa días naturales, contados a partir de la fecha de su expedición para efectos de que el personal obtenga o revalide la Licencia Federal o Titulo. Si concluida la vigencia del certificado, el personal no obtiene, renueva, revalida o recupera la Licencia Federal, deberá practicarse otra vez el examen respectivo y efectuar nuevamente el pago correspondiente de conformidad con la circular obligatoria CO DMED 08/22 Numeral 8.6, inciso a.'), 0, 'J', false);
            $fpdi->Ln(18); // Line gap
            $fpdi->SetX(199);
            $fpdi->Rotate(270);
            $fpdi->MultiCell(66, 4, utf8_decode('2. El personal deberá portar durante todo el tiempo que lleve a cabo sus funciones, el certificado de aptitud psicofísica, de conformidad con lo establecido articulo 88 Quáter de la Ley de Aviación Civil; además la alteración de este documento, actualizará lo previsto en los artículos 243 y 244 del Código Penal Federal.
            
3. Siempre que se porte el certificado deberá acompañarse de una identificación oficial con fotografía.'), 0, 'J', false);
            $fpdi->Ln(19); // Line gap
            $fpdi->SetX(199);
            $fpdi->Rotate(270);
            $fpdi->MultiCell(66, 4, utf8_decode('4. En caso de presentar alguna situación medica que disminuya su aptitud psicofísica lo hará del conocimiento de la autoridad de forma inmediata de conformidad con la circular obligatoria CO DMED 02/22.
            
5. El titular de este certificado reúne los requisitos psicofísicos para ejercer las funciones acordes a la licencia para que ostente o porte, sin perjuicio de las limitaciones o condiciones que se indiquen.'), 0, 'J', false);
            $fpdi->Ln(17); // Line gap
            $fpdi->SetX(198);
            $fpdi->Rotate(270);
            $fpdi->SetFontSize(8);
            $fpdi->MultiCell(66, 3, utf8_decode('1.Yo ' . $this->document->medical . ' bajo protesta de decir verdad, declaro ante la Agencia Federal de Aviación Civil, que verifiqué la veracidad de los documentos que avalan la identidad del personal, que emito este certificado derivado de la evaluación médica realizada el ' . $this->document->evaluationDay . ' en ' . $this->document->testPlace . ' y que la información contenida en el certificado de aptitud psicofísica es verídica, y fue obtenida empleando para ello las mejores prácticas médicas por personal calificado, que me hago responsable de la información aportada con mi firma y en su caso con mi cédula profesional, así como el equipo idóneo, apercibido de que aquél que interrogado por autoridad pública distinta de la judicial (en ejercicio de sus funciones o con motivo de ellas) faltare a la verdad, se hace acreedor a  lo estipulado por el artículo 247, fracción I del Código Penal.'), 0, 'J', false);
        }
        return $fpdi->Output($outputFile, 'F');
    }
}
