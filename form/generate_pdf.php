<?php
require_once ('../modules/pdf/fpdf/fpdf.php');
require_once ('../modules/pdf/fpdi/src/autoload.php');

use setasign\Fpdi\Fpdi;

class PDF extends Fpdi
{
    function Header()
    {
        // No header needed as we use an existing PDF
    }

    function Footer()
    {
        // No footer needed as we use an existing PDF
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $formData = [
        "nome_beneficiario" => $_POST['nome_completo'],
        "email_beneficiario" => $_POST['email_beneficiario'],
        "RG" => $_POST['rg'],
        "CPF" => $_POST['cpf'],
        "contato" => $_POST['contato'],
        "estado_civil" => $_POST['estado_civil'],
        "CEP" => $_POST['cep'],
        "endereco" => $_POST['endereco'],
        "complemento" => $_POST['complemento'],
        "bairro" => $_POST['bairro'],
        "cidade" => $_POST['cidade'],
        "estado" => $_POST['estado'],
        "pastor_nome" => $_POST['nome_pastor'],
        "registro_cgadb" => $_POST['registro_cgadb'],
        "registro_cgadeb" => $_POST['registro_cgadeb'],
        "cpf_pastor" => $_POST['cpf_pastor'],
        "pastor_contato" => $_POST['contato_pastor'],
        "pastor_email" => $_POST['email_pastor'],
        "data" => date("d/m/Y")
    ];

    // Create instance of FPDI
    $pdf = new PDF();
    $pdf->AddPage();

    // Set the source PDF file
    $pageCount = $pdf->setSourceFile('./Declaração_ceadeb_Beneficiario.pdf');
    $tplIdx = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx, 0, 0, null, null, true);

    // Set font
    $pdf->SetFont('Arial', '', 12);

    // Set the position and write the data
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
    // $pdf->Output('D', 'form_data.pdf');

    // Read the temporary file as base64
    $base64Pdf = base64_encode(file_get_contents($tempFileName));
    unlink($tempFileName); // Delete the temporary file

    // Define ZapSign API URL and API key
    $apiUrl = "https://sandbox.api.zapsign.com.br/api/v1/docs/";
    $apiKey = "";

    $data = [
        "name" => "Contrato de " . $formData['nome_beneficiario'],
        "base64_pdf" => $base64Pdf,
        "external_id" => null,
        "signers" => [
            [
                "name" => $formData['nome_beneficiario'],
                "email" => $formData['email_beneficiario'],
                "auth_mode" => "assinaturaTela",
                "send_automatic_email" => true,
                "send_automatic_whatsapp" => true,
                "phone_country" => "55",
                "phone_number" => $formData['contato'],
                "require_selfie_photo" => true,
                "require_document_photo" => true,
                "selfie_validation_type" => "liveness-document-match"
            ],
            [
                "name" => $formData['pastor_nome'],
                "email" => $formData['pastor_email'],
                "auth_mode" => "assinaturaTela",
                "send_automatic_email" => true,
                "send_automatic_whatsapp" => true,
                "phone_country" => "55",
                "phone_number" => $formData['pastor_contato'],
                "require_selfie_photo" => true,
                "blank_email" => false,
                "require_document_photo" => true,
                "selfie_validation_type" => "liveness-document-match"
            ]
        ],
        "lang" => "pt-br",
        "created_by" => "gustavojsc9@gmail.com",
        "disable_signer_emails" => false,
        "brand_name" => "ChmHuster",
        "signature_order_active" => false,
        "observer" => ["gustavojsc9@gmail.com", "eronjr17.ej@gmail.com", "rodrigo.bessa@visionanalytics.tech"],
        "reminder_every_n_days" => 0,
        "allow_refuse_signature" => false,
        "disable_signers_get_original_file" => false
    ];

    // Initialize cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute cURL request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        echo "Failed to create document. Response: " . htmlspecialchars($response) . " HTTP Code: " . htmlspecialchars($httpCode);
    }
}
?>