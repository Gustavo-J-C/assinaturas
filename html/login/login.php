<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados de login do cliente
    $data = json_decode(file_get_contents('php://input'), true);

    $login = $data['login'];
    $password = $data['password'];

    // Dados para a API externa
    $apiData = array(
        "action" => "login",
        "login" => $login,
        "password" => $password,
        "api_key" => "ceadeb@yJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJ0ZXNvdXJhcmlhIiwibmFtZSI6IkNFQURFQiIsInJvbGUiOiJqdWJpbGFkb3MifQ.CnYDRqvicg4vUmwhgQ3FSA_bZkPBXuHDU_4P5gpD8M4"
    );

    $apiUrl = "https://www.in9.net.br/acessosistem/api/ceadeb/";

    // Fazer a requisição para a API externa
    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($apiData)
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($apiUrl, false, $context);

    if ($result === FALSE) {
        http_response_code(500);
        echo json_encode(array("error" => "Falha no servidor"));
    } else {
        echo $result;
    }
}
?>
