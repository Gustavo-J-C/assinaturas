<?php
function getFormData($postData) {
    return [
        "nome_beneficiario" => $postData['nome_completo'],
        "email_beneficiario" => $postData['email_beneficiario'],
        "RG" => $postData['rg'],
        "CPF" => $postData['cpf'],
        "contato" => $postData['contato'],
        "estado_civil" => $postData['estado_civil'],
        "CEP" => $postData['cep'],
        "endereco" => $postData['endereco'],
        "complemento" => $postData['complemento'],
        "bairro" => $postData['bairro'],
        "cidade" => $postData['cidade'],
        "estado" => $postData['estado'],
        "pastor_nome" => $postData['nome_pastor'],
        "registro_cgadb" => $postData['registro_cgadb'],
        "registro_cgadeb" => $postData['registro_cgadeb'],
        "cpf_pastor" => $postData['cpf_pastor'],
        "pastor_contato" => $postData['contato_pastor'],
        "pastor_email" => $postData['email_pastor'],
        "data" => date("d/m/Y")
    ];
}
?>
