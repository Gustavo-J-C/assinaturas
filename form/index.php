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
    <title>Formulário</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form class="form" id="myForm" action="generate_pdf.php" method="post" >
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
                    <label for="registro_cgadb">Registro CGADB</label>
                    <input type="text" id="registro_cgadb" name="registro_cgadb" required>
                </div>
                <div class="form-group">
                    <label for="registro_cgadeb">Registro CGADEB</label>
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
                    <input type="text" id="email_pastor" name="email_pastor" required>
                </div>
            </div>
            <button type="submit" class="btn-submit">Próximo</button>
        </form>
        <a href="logout.php">Logout</a>
    </div>
    <script>


        function formatarRG() {
            var rg = document.getElementById('rg');
            var rgValue = rg.value.replace(/\D/g, '');
            var formattedRg = rgValue.replace(/(\d{2})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            rg.value = formattedRg;
        }

        function formatarCPF(id) {
            var cpf = document.getElementById(id);
            var cpfValue = cpf.value.replace(/\D/g, '');
            var formattedCpf = cpfValue.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            cpf.value = formattedCpf;
        }

        function formatarCEP() {
            var cep = document.getElementById('cep');
            var cepValue = cep.value.replace(/\D/g, '');
            var formattedCep = cepValue.replace(/(\d{5})(\d{3})/, '$1-$2');
            cep.value = formattedCep;
        }

        function formatarContato(id) {
            var contato = document.getElementById(id);
            var contatoValue = contato.value.replace(/\D/g, '');
            var formattedContato = contatoValue.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            contato.value = formattedContato;
        }

        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf == '') return false;
            // Elimina CPFs invalidos conhecidos
            if (cpf.length != 11 ||
                cpf == "00000000000" ||
                cpf == "11111111111" ||
                cpf == "22222222222" ||
                cpf == "33333333333" ||
                cpf == "44444444444" ||
                cpf == "55555555555" ||
                cpf == "66666666666" ||
                cpf == "77777777777" ||
                cpf == "88888888888" ||
                cpf == "99999999999")
                return false;
            // Valida 1o digito
            add = 0;
            for (i = 0; i < 9; i++)
                add += parseInt(cpf.charAt(i)) * (10 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(9)))
                return false;
            // Valida 2o digito
            add = 0;
            for (i = 0; i < 10; i++)
                add += parseInt(cpf.charAt(i)) * (11 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(10)))
                return false;
            return true;
        }

        function validarEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validarTelefone(telefone) {
            var re = /^\d{10,11}$/;
            return re.test(telefone);
        }

        function validarFormulario(cepBeneficiario, emailBeneficiario, cpfBeneficiario, contatoBeneficiario, emailPastor, cpfPastor, contatoPastor) {

            if (!validarEmail(emailBeneficiario)) {
                alert('Email do beneficiário inválido.');
                return false;
            }

            if (!validarCPF(cpfBeneficiario)) {
                alert('CPF do beneficiário inválido.');
                return false;
            }

            if (!validarTelefone(contatoBeneficiario)) {
                alert('Contato do beneficiário inválido. Deve conter apenas números e ter 10 ou 11 dígitos.');
                return false;
            }

            if (!validarEmail(emailPastor)) {
                alert('Email do pastor inválido.');
                return false;
            }

            if (!validarCPF(cpfPastor)) {
                alert('CPF do pastor inválido.');
                return false;
            }

            if (!validarTelefone(contatoPastor)) {
                alert('Contato do pastor inválido. Deve conter apenas números e ter 10 ou 11 dígitos.');
                return false;
            }

            return true;
        }

        async function enviarFormulario(event) {
            event.preventDefault();

            var cepBeneficiario = document.getElementById('cep').value.replace(/[.-]/g, '');
            var emailBeneficiario = document.getElementById('email_beneficiario').value;
            var cpfBeneficiario = document.getElementById('cpf').value.replace(/[.-]/g, '');
            var contatoBeneficiario = document.getElementById('contato').value.replace(/[.-]/g, '');
            var emailPastor = document.getElementById('email_pastor').value;
            var cpfPastor = document.getElementById('cpf_pastor').value.replace(/[.-]/g, '');
            var contatoPastor = document.getElementById('contato_pastor').value.replace(/[.-]/g, '');

            validarFormulario(cepBeneficiario, emailBeneficiario, cpfBeneficiario, contatoBeneficiario, emailPastor, cpfPastor, contatoPastor);

            var formData = new FormData(document.getElementById('myForm'));

            var formData = new FormData();
            formData.append('nome_beneficiario', document.getElementById('nome_completo').value);
            formData.append('email_beneficiario', document.getElementById('email_beneficiario').value);
            formData.append('RG', document.getElementById('rg').value.replace(/[.-]/g, ''));
            formData.append('CPF', document.getElementById('cpf').value.replace(/[.-]/g, ''));
            formData.append('contato', document.getElementById('contato').value.replace(/[.-]/g, ''));
            formData.append('estado_civil', document.getElementById('estado_civil').value);
            formData.append('CEP', document.getElementById('cep').value.replace(/[.-]/g, ''));
            formData.append('endereco', document.getElementById('endereco').value);
            formData.append('complemento', document.getElementById('complemento').value);
            formData.append('bairro', document.getElementById('bairro').value);
            formData.append('cidade', document.getElementById('cidade').value);
            formData.append('estado', document.getElementById('estado').value);
            formData.append('pastor_nome', document.getElementById('nome_pastor').value);
            formData.append('registro_cgadb', document.getElementById('registro_cgadb').value);
            formData.append('registro_cgadeb', document.getElementById('registro_cgadeb').value);
            formData.append('cpf_pastor', document.getElementById('cpf_pastor').value.replace(/[.-]/g, ''));
            formData.append('pastor_contato', document.getElementById('contato_pastor').value.replace(/[.-]/g, ''));
            formData.append('pastor_email', document.getElementById('email_pastor').value);
            formData.append('data', new Date().toLocaleDateString('pt-BR'));

            try {
                const response = await fetch('generate_pdf.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error('Erro ao enviar o formulário.');
                }

                const data = await response.text();
                console.log(data); // Você pode tratar a resposta aqui
            } catch (error) {
                console.error(error.message);
            }
        }

        document.getElementById('rg').addEventListener('input', formatarRG);
        document.getElementById('cpf').addEventListener('input', () => formatarCPF('cpf'));
        document.getElementById('cpf_pastor').addEventListener('input', () => formatarCPF('cpf_pastor'));
        document.getElementById('contato').addEventListener('input', () => formatarContato('contato'));
        document.getElementById('contato_pastor').addEventListener('input', () => formatarContato('contato_pastor'));
        document.getElementById('cep').addEventListener('input', formatarCEP);
    </script>
</body>

</html>