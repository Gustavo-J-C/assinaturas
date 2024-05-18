<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $rg = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $estado_civil = $_POST['estado_civil'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $nome_pastor = $_POST['nome_pastor'];
    $registro_conar = $_POST['registro_conar'];
    $registro_cread = $_POST['registro_cread'];
    $contato_whatsapp = $_POST['contato_whatsapp'];
    $email = $_POST['email'];

    $query = "INSERT INTO beneficiaries (nome, rg, cpf, estado_civil, cep, endereco, complemento, bairro, cidade, estado, nome_pastor, registro_conar, registro_cread, contato_whatsapp, email) 
              VALUES ('$nome', '$rg', '$cpf', '$estado_civil', '$cep', '$endereco', '$complemento', '$bairro', '$cidade', '$estado', '$nome_pastor', '$registro_conar', '$registro_cread', '$contato_whatsapp', '$email')";

    if (mysqli_query($conn, $query)) {
        echo "Dados salvos com sucesso!";
    } else {
        echo "Erro ao salvar dados: " . mysqli_error($conn);
    }
}
?>
