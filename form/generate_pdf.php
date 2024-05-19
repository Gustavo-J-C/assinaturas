<?php
require ('../modules/pdf/fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Contrato de Concessão de Benefício'), 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
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
        "Estado Civil" => $_POST['estado_civil'],
        "Telefone" => $_POST['contato'],
        "CEP" => $_POST['cep'],
        "Endereço" => $_POST['endereco'],
        "Complemento" => $_POST['complemento'],
        "Bairro" => $_POST['bairro'],
        "Cidade" => $_POST['cidade'],
        "Estado" => $_POST['estado'],
        "pastor_nome" => $_POST['nome_pastor'],
        "Registro CGADB" => $_POST['registro_cgadb'],
        "Registro CGADEB" => $_POST['registro_cgadeb'],
        "CPF do Pastor" => $_POST['cpf_pastor'],
        "pastor_contato" => $_POST['contato_pastor'],
        "pastor_email" => $_POST['email_pastor'],
        "Data" => date("d/m/Y")
    ];

    // Create instance of FPDF
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    // Add contract content to PDF
    $pdf->Cell(0, 10, "Partes:", 0, 1);
    foreach ($formData as $key => $value) {
        $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "$key: $value"), 0, 1);
    }
    $pdf->Ln();
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Considerando que:"), 0, 1);
    $pdf->MultiCell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "A CEADEB concede benefícios aos seus membros de acordo com critérios estabelecidos;\n\nO Beneficiário atende aos critérios estabelecidos para a concessão do benefício;\n\nAmbas as partes concordam com os termos e condições deste contrato."));
    $pdf->Ln();
    $pdf->Cell(0, 10, "Acordo:", 0, 1);
    $pdf->MultiCell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Objeto:\n1.1 A CEADEB concorda em conceder o benefício ao Beneficiário de acordo com os critérios estabelecidos pela organização.\n\nObrigações da CEADEB:\n2.1 A CEADEB compromete-se a fornecer ao Beneficiário os benefícios acordados de forma oportuna e conforme descrito nos regulamentos internos.\n\nObrigações do Beneficiário:\n3.1 O Beneficiário concorda em cumprir os requisitos estabelecidos para a concessão do benefício e em fornecer informações precisas e atualizadas à CEADEB.\n\nAssinaturas Eletrônicas:\n4.1 O Beneficiário concorda em assinar eletronicamente este contrato através da plataforma Zap Sign, conforme instruções fornecidas pela CEADEB.\n\nVigência:\n5.1 Este contrato entra em vigor na data de assinatura eletrônica pelo Beneficiário e permanecerá em vigor até o término dos benefícios concedidos pela CEADEB."));
    $pdf->Ln();
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Assinaturas:"), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Por estar de acordo com os termos e condições deste contrato, as partes assinam eletronicamente:"), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "CEADEB"), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "[Assinatura Eletrônica da CEADEB]"), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Data: " . $formData['Data']), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Beneficiário"), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "[Assinatura Eletrônica do Beneficiário]"), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Data: " . $formData['Data']), 0, 1);
    $pdf->Ln();
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Testemunhas:"), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Nome: ___________________________________"), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Assinatura: _______________________________"), 0, 1);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Data: ____________________________________"), 0, 1);

    // Output the PDF to a temporary file
    $tempFileName = tempnam(sys_get_temp_dir(), 'contract');
    $pdf->Output($tempFileName, 'F');

    // Read the temporary file as base64
    $base64Pdf = base64_encode(file_get_contents($tempFileName));
    unlink($tempFileName); // Delete the temporary file

    // Define ZapSign API URL and API key
    $apiUrl = "https://sandbox.api.zapsign.com.br/api/v1/docs/";
    $apiKey = "";

    $data = [
        "name" => "Contrato de teste",
        "base64_pdf" => $base64Pdf,
        "external_id" => null,
        "signers" => [
            [
                "name" => $formData['nome_beneficiario'],
                "email" => $formData['email_beneficiario'],
                "auth_mode" => "assinaturaTela",
                "send_automatic_email" => true,
                "send_automatic_whatsapp" => false,
                "phone_country" => "55",
                "phone_number" => $formData['contato'],
                "require_selfie_photo" => false,
                "require_document_photo" => true,
                "selfie_validation_type" => "liveness-document-match"
            ],
            [
                "name" => $formData['pastor_nome'],
                "email" => $formData['pastor_email'],
                "auth_mode" => "assinaturaTela",
                "send_automatic_email" => true,
                "send_automatic_whatsapp" => false,
                "phone_country" => "55",
                "phone_number" => $formData['pastor_contato'],
                "require_selfie_photo" => false,
                "require_document_photo" => true,
                "selfie_validation_type" => "liveness-document-match"
            ]
        ],
        "lang" => "pt-br",
        "brand_name" => "ChmHuster"
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
        $result = json_decode($response, true);
        echo "Document created successfully. Document ID: ";
    } else {
        echo "Failed to create document. Response: " . $response, $httpCode;
    }
}
?>