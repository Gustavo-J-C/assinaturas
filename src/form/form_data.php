<?php
function getFormData($postData) {

    $dtNascimento = DateTime::createFromFormat('Y-m-d', $postData['dt_nascimento']);
    if ($dtNascimento) {
        $dtNascimentoFormatted = $dtNascimento->format('d-m-Y');
    } else {
        $dtNascimentoFormatted = $postData['dt_nascimento'];  // If date is not valid, keep original
    }

    return [
        "nome_beneficiario" => $postData['nome'] . ' ' . $postData["sobrenome"],
        "email_beneficiario" => $postData['email'],
        "CPF" => $postData['cpf'],
        "contato" => $postData['contato'],
        "CEP" => $postData['cep'],
        "endereco" => $postData['endereco'],
        "bairro" => $postData['bairro'],
        "cidade" => $postData['cidade'],
        "estado" => $postData['estado'],
        "numero" => $postData['numero'],
        "dt_nascimento" => $dtNascimentoFormatted,
        "data" => date("d/m/Y")
    ];
}
?>
