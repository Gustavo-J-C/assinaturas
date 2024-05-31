<?php
require_once 'form_data.php';
require_once 'pdf_generator.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $formData = getFormData($_POST);

    $base64Pdf = generatePDF($formData);

    $zapSignResponse = sendToZapSign($formData, $base64Pdf);

    $mainServerResponse = sendToServer($zapSignResponse, $base64Pdf);

    header('Content-Type: application/json; charset=utf-8');
    if ($zapSignResponse['http_code'] == 200) {
        $responseBody = json_decode($response['body'], true);
        if (isset($responseBody['original_file'])) {
            $_SESSION['original_file'] = $responseBody['original_file'];

            header('Location: display_file.php');
            exit();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Original file not found in response.'
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    } else {
        echo "Failed to create document. Response: " . htmlspecialchars($response['body']) . " HTTP Code: " . htmlspecialchars($response['http_code']);
    }
}

function sendToServer($zapSignResponse, $base64Pdf)
{
    $apiUrl = "https://example.com/api/documento";
    $apiToken = $_SESSION['API_TOKEN']; 

    $docToken = $zapSignResponse['data']['document_id'];
    $beneficiario = $zapSignResponse['data']['beneficiario']; 
    $pdfB64 = $base64Pdf;

    $postData = json_encode([
        'doc_token' => $docToken,
        'beneficiario' => $beneficiario,
        'pdf_b64' => $pdfB64
    ]);

    $ch = curl_init($apiUrl);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Token ' . $apiToken
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return [
        'body' => $response,
        'http_code' => $httpCode
    ];
}

function sendToZapSign($formData, $base64Pdf) {
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
        "brand_name" => "ACADEB",
        "signature_order_active" => false,
        "observer" => ["gustavojsc9@gmail.com"],
        "reminder_every_n_days" => 0,
        "allow_refuse_signature" => false,
        "disable_signers_get_original_file" => false
    ];

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        'http_code' => $httpCode,
        'body' => $response
    ];
}

?>