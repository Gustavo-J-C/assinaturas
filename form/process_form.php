<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $formData = [
        "nome_completo" => $_POST['nome_completo'],
        "rg" => $_POST['rg'],
        "cpf" => $_POST['cpf'],
        "email_beneficiario" => $_POST['email_beneficiario'],
        "estado_civil" => $_POST['estado_civil'],
        "contato" => $_POST['contato'],
        "cep" => $_POST['cep'],
        "endereco" => $_POST['endereco'],
        "complemento" => $_POST['complemento'],
        "bairro" => $_POST['bairro'],
        "cidade" => $_POST['cidade'],
        "estado" => $_POST['estado'],
        "pastor_nome" => $_POST['pastor_nome'],
        "Registro CGADB" => $_POST['registro_cgadb'],
        "Registro CGADEB" => $_POST['registro_cgadeb'],
        "CPF do Pastor" => $_POST['cpf_pastor'],
        "pastor_contato" => $_POST['pastor_contato'],
        "pastor_email" => $_POST['pastor_email']
    ];

    // Define ZapSign API URL and API key
    $apiUrl = "https://sandbox.api.zapsign.com.br/api/v1/docs/";
    $apiKey = "b7588bd8-3721-4c44-99f7-42f2550590e8fb547421-d77b-4f82-b8c5-14c28d7f0ea6";


    $data = [
        "name" => "Contrato de teste",
        "url_pdf" => "https://zapsign.s3.amazonaws.com/2022/1/pdf/63d19807-cbfa-4b51-8571-215ad0f4eb98/ca42e7be-c932-482c-b70b-92ad7aea04be.pdf",
        "external_id" => null,
        "signers" => [
            [
                "name" => $formData['nome_completo'],
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
