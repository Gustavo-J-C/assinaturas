<?php
require_once ('../modules/pdf/fpdf/fpdf.php');
require_once ('../modules/pdf/fpdi/src/autoload.php');

use setasign\Fpdi\Fpdi;

class PDF extends Fpdi
{
    function Header() {}
    function Footer() {}
}

function generatePDF($formData) {
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->setSourceFile('./Declaracao_de_Prova_de_Vida.pdf');
    // $pdf->setSourceFile('./Declaração_ceadeb_Beneficiario.pdf');
    $tplIdx = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx, 0, 0, null, null, true);
    $pdf->SetFont('Arial', '', 12);

    $pdf->SetXY(40, 118);
    $pdf->Write(10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['nome_beneficiario']));
    $pdf->SetXY(40, 136);
    $pdf->Write(10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['estado_civil'] . '  --  ' . $formData['RG'] . '  --  ' . $formData['CPF']));
    $pdf->SetXY(40, 154);
    $pdf->Write(10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['endereco'] . '  --  ' . $formData['CEP']));
    $pdf->SetXY(40, 171);
    $pdf->Write(10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['bairro'] . '  --  ' . $formData['contato'] . '  --  ' . $formData['cidade']));
    $pdf->SetXY(40, 188);
    $pdf->Write(10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Salvador - BA   --   ' . date("d/m/Y")));

    $tempFileName = tempnam(sys_get_temp_dir(), 'contract');
    $pdf->Output($tempFileName, 'F');
    $pdf->Output('D', 'form_data.pdf');
    $base64Pdf = base64_encode(file_get_contents($tempFileName));
    unlink($tempFileName);

    return $base64Pdf;
}
?>
