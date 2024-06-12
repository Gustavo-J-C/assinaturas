<?php
require_once 'form_data.php';
require_once 'pdf_generator3.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (!$inputData) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid JSON input.'
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit();
    }

    $missingFields = validateFormData($inputData);


    if ($missingFields !== false) {
        // Se houver campos faltando, retornar erro 400
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing or invalid fields.',
            'missing_fields' => $missingFields
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit();
    } 

    $formData = getFormData($inputData);

    $base64Pdf = generatePDF($formData);

    $zapSignResponse = sendToZapSign($formData, $base64Pdf);

    header('Content-Type: application/json; charset=utf-8');
    if ($zapSignResponse['http_code'] == 200) {
        $responseBody = json_decode($zapSignResponse['body'], true);
        if (isset($responseBody['original_file'])) {
            $originalFileUrl = $responseBody['original_file'];
            http_response_code(201);
            echo json_encode([
                'status' => 'success',
                'original_file' => $originalFileUrl,
                'base64Pdf' => $base64Pdf
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Original file not found in response.'
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to create document.',
            'response' => htmlspecialchars($zapSignResponse['body']),
            'http_code' => htmlspecialchars($zapSignResponse['http_code'])
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

function validateFormData($inputData) {
    $requiredFields = ['nome', 'sobrenome', 'email', 'dt_nascimento', 'cpf', 'contato', 'cep', 'endereco', 'bairro', 'cidade', 'estado', 'numero'];
    $missingFields = [];

    foreach ($requiredFields as $field) {
        if (!isset($inputData[$field]) || empty($inputData[$field])) {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        return $missingFields;
    } else {
        return false; // Todos os campos estão presentes e válidos
    }
}

function sendToZapSign($formData, $base64Pdf)
{
    $apiUrl = "https://sandbox.api.zapsign.com.br/api/v1/docs/";
    $apiKey = "62b24669-88be-4727-850c-d41ad4c3f8b621f1ee55-7dc7-4f25-92f4-977fc0a74ec0";

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