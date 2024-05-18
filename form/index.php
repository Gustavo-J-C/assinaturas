<?php
session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header("Location: index.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Formulário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form class="form" action="submit_form.php" method="post">
            <h2>Dados do Beneficiário(a)</h2>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="rg">RG</label>
                    <input type="text" id="rg" name="rg" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>
                <div class="form-group">
                    <label for="estado_civil">Estado Civil</label>
                    <select id="estado_civil" name="estado_civil">
                        <option value="solteiro">Solteiro(a)</option>
                        <option value="casado">Casado(a)</option>
                        <!-- Outras opções -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" id="complemento" name="complemento">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" name="bairro" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" name="estado" required>
                </div>
            </div>
            
            <h2>Dados do Congregacionais</h2>
            <div class="form-group">
                <label for="nome_pastor">Nome Completo do Pastor Presidente</label>
                <input type="text" id="nome_pastor" name="nome_pastor" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="registro_conar">Registro CONAR</label>
                    <input type="text" id="registro_conar" name="registro_conar" required>
                </div>
                <div class="form-group">
                    <label for="registro_cread">Registro CREAD</label>
                    <input type="text" id="registro_cread" name="registro_cread" required>
                </div>
                <div class="form-group">
                    <label for="cpf_pastor">CPF</label>
                    <input type="text" id="cpf_pastor" name="cpf_pastor" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="contato_whatsapp">Contato "Whatsapp"</label>
                    <input type="text" id="contato_whatsapp" name="contato_whatsapp" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <button type="submit" class="btn-submit">Próximo</button>
        </form>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
