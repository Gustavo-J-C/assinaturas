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
        <form class="form" action="generate_pdf.php" method="post">
            <h2>Dados do Beneficiário(a)</h2>
            <div class="form-group">
                <label for="nome_completo">Nome Completo</label>
                <input type="text" id="nome_completo" name="nome_completo" required>
            </div>
            <div class="form-group">
                <label for="email_beneficiario">Email</label>
                <input type="text" id="email_beneficiario" name="email_beneficiario" required>
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
                <label for="contato">Contato</label>
                <input type="text" id="contato" name="contato" required>
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
                    <label for="registro_conar">Registro CGADB</label>
                    <input type="text" id="registro_cgadb" name="registro_cgadb" required>
                </div>
                <div class="form-group">
                    <label for="registro_cread">Registro CGADEB</label>
                    <input type="text" id="registro_cgadeb" name="registro_cgadeb" required>
                </div>
                <div class="form-group">
                    <label for="cpf_pastor">CPF</label>
                    <input type="text" id="cpf_pastor" name="cpf_pastor" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="contato_pastor">Contato "Whatsapp"</label>
                    <input type="text" id="contato_pastor" name="contato_pastor" required>
                </div>
                <div class="form-group">
                    <label for="email_pastor">E-mail</label>
                    <input type="email_pastor" id="email_pastor" name="email_pastor" required>
                </div>
            </div>
            <button type="submit" class="btn-submit">Próximo</button>
        </form>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
