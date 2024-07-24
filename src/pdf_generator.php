<?php
require_once ('../../modules/pdf/fpdf/fpdf.php');
require_once ('../../modules/pdf/fpdi/src/autoload.php');

use setasign\Fpdi\Fpdi;

class PDF extends Fpdi
{
    function Header() {}
    function Footer() {}
}

function generatePDF($formData) {
    try {
        if (!isset($formData['nome_beneficiario'], $formData['CPF'], $formData['endereco'], $formData['numero'], $formData['bairro'], $formData['cidade'], $formData['estado'], $formData['CEP'], $formData['dt_nascimento'], $formData['contato'])) {
            throw new Exception('Dados incompletos fornecidos.');
        }

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->setSourceFile('../../docs/Declaração_ceadeb_Beneficiario.pdf');
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0, null, null, true);
        $pdf->SetFont('Arial', '', 12);

        $pdf->SetXY(28, 112);
        $pdf->Write(8, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['nome_beneficiario']));
        $pdf->SetXY(65, 123);
        $pdf->Write(8, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['CPF']));
        $pdf->SetXY(22, 133);
        $pdf->Write(8, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['endereco'] . ', ' . $formData['numero'] . ',  ' . $formData['bairro'] . ', ' . $formData['cidade'] . ', ' . $formData['estado'] . ', ' . $formData['CEP']));
        $pdf->SetXY(60, 143);
        $pdf->Write(8, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['dt_nascimento']));
        $pdf->SetXY(145, 143);
        $pdf->Write(8, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['contato']));
        $pdf->SetXY(22, 220);
        $pdf->Write(8, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $formData['cidade'] . '  ' . date("d/m/Y")));

        $tempFileName = sys_get_temp_dir() . '/contract_' . uniqid() . '.pdf';
        $pdf->Output('F', $tempFileName);
        $base64Pdf = base64_encode(file_get_contents($tempFileName));
        unlink($tempFileName);

        return [$base64Pdf, $tempFileName];

    } catch (Exception $e) {
        // Log the error
        error_log('Error generating PDF: ' . $e->getMessage());

        // Return the error message
        return ['error' => $e->getMessage()];
    }
}
?>
