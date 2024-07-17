// Dynamic Manipulation
let documentCreated = false;
let documentLink;

var form = $(".validation-wizard").show();

document.addEventListener('DOMContentLoaded', function () {
  // Retrieve data from localStorage
  let userData = JSON.parse(localStorage.getItem('userData'));

  // Check if userData exists and contains necessary fields
  if (userData && userData.nome && userData.email && userData.cpf && userData.nascimento &&
    userData.estado && userData.cidade && userData.bairro && userData.endereco &&
    userData.numero && userData.cep) {

    nameField = document.getElementById('name');
    rgField = document.getElementById('rg')
    cpfField = document.getElementById('cpf')
    birthdayField = document.getElementById('birthday')
    document.getElementById('email').value = userData.email;
    document.getElementById('phone').value = userData.contato;
    document.getElementById('estate').value = userData.estado;
    document.getElementById('city').value = userData.cidade;
    document.getElementById('street').value = userData.endereco;
    document.getElementById('address').value = userData.endereco;
    document.getElementById('number').value = userData.numero;
    document.getElementById('code').value = userData.cep;

    nameField.setAttribute("disabled", true)
    nameField.value = userData.nome
    // rgField.setAttribute("disabled", false)
    rgField.value = userData.rg;
    // cpfField.setAttribute("disabled", false)
    cpfField.value = userData.cpf;
    birthdayField.setAttribute("disabled", false)
    birthdayField.value = userData.nascimento;

  } else {
    console.error('userData is missing required fields.');
  }
});

$(".validation-wizard").steps({
  headerTag: "h6",
  bodyTag: "section",
  transitionEffect: "fade",
  titleTemplate: '<span class="step">#index#</span> #title#',
  labels: {
    finish: "Finalizar",
    next: "enviar",
    previous: "voltar"
  },
  onStepChanging: function (event, currentIndex, newIndex) {
    var returnControler = true;
    if (currentIndex === 0 && newIndex === 1) {
      if (form.valid() && !documentCreated) {
        // Dados do formulário

        var formData = {
          nome: $('#name').val(),
          sobrenome: $('#lastName').val(),
          email: $('#email').val(),
          cpf: $('#cpf').val(),
          contato: $('#phone').val(),
          cep: $('#code').val(),
          endereco: $('#street').val(),
          bairro: $('#address').val(),
          dt_nascimento: $('#birthday').val(),
          cidade: $('#city').val(),
          estado: $('#estate').val(),
          numero: $('#number').val(),
          data: Date.now()
        };

        // Mostrar o indicador de carregamento
        $('#loadingIndicator1').show();

        // Desabilitar botões de navegação
        $('.actions').hide();
        $.ajax({
          url: '../../src/form/generate_pdf.php',
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify(formData),
          success: function (response, textStatus, jqXHR) {
            if (jqXHR.status === 201) {
              documentCreated = true;
              documentLink = response.original_file;

              var loginData = JSON.parse(localStorage.getItem('userData'));
              var tokenData = localStorage.getItem('jwtToken');

              if (loginData && tokenData) {
                var cpf = loginData.cpf;
                var api_key = "ceadeb@yJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJ0ZXNvdXJhcmlhIi" +
                  "wibmFtZSI6IkNFQURFQiIsInJvbGUiOiJqdWJpbGFkb3MifQ.CnYDRqvicg4vUmwh" +
                  "gQ3FSA_bZkPBXuHDU_4P5gpD8M4";

                var requestData = {
                  action: "upload_doc",
                  token: tokenData,
                  doc_token: response.response_api.token,
                  cpf: cpf,
                  pdf_b64: response.base64Pdf,
                  api_key: api_key
                };

                console.log(requestData);
                $.ajax({
                  url: 'https://www.in9.net.br/acessosistem/api/ceadeb/',
                  type: 'POST',
                  contentType: 'application/json',
                  data: JSON.stringify(requestData),
                  success: function (uploadResponse) {
                    if (uploadResponse.status === 200) {
                      alert('Arquivo armazenado com sucesso');
                    } else {
                      alert('Erro ao armazenar o arquivo: ' + uploadResponse.mensage);
                    }
                  },
                  error: function (uploadError) {
                    alert('Erro ao armazenar o arquivo. Por favor, tente novamente.');
                  }
                });
              } else {
                alert('Erro ao recuperar dados de login.');
              }
              $('#loadingIndicator').hide();
              $('#documentGenerated').show();

              $('#viewDocumentLink').attr('href', documentLink);
              $('#downloadDocumentLink').attr('href', documentLink);
              return true;
            } else {
              alert('Erro ao enviar os dados. Por favor, tente novamente.');
              returnControler = false;
            }
          },
          error: function (xhr, status, error) {
            // Lógica de tratamento para erro na requisição
            alert('Erro ao enviar os dados. Por favor, tente novamente.');
            return
          },
          complete: function () {
            $('.actions').show();
          }
        });
      } else if (!form.valid()) {
        return false;
      }
    }
    return returnControler;
  },
  onFinishing: function (event, currentIndex) {
    return (form.validate().settings.ignore = ":disabled"), form.valid();
  },
  onFinished: function (event, currentIndex) {

  },
}),
  $(".validation-wizard").validate({
    ignore: "input[type=hidden]",
    errorClass: "text-danger",
    successClass: "text-success",
    highlight: function (element, errorClass) {
      $(element).removeClass(errorClass);
    },
    unhighlight: function (element, errorClass) {
      $(element).removeClass(errorClass);
    },
    errorPlacement: function (error, element) {
      error.insertAfter(element);
    },
    rules: {
      email: {
        email: true,
        required: true
      },
      nome: {
        required: true
      },
      sobrenome: {
        required: true
      },
      birthday: {
        required: true,
        date: true
      },
      cpf: {
        required: true,
      },
      contato: {
        required: true
      },
      code: {
        required: true,
      },
      street: {
        required: true
      },
      address: {
        required: true
      },
      city: {
        required: true
      },
      estate: {
        required: true
      },
      phone: {
        required: true
      }
    },
    messages: {
      email: {
        email: "Por favor, insira um endereço de e-mail válido.",
        required: "O campo de e-mail é obrigatório."
      },
      nome: {
        required: "O campo de nome é obrigatório."
      },
      sobrenome: {
        required: "O campo de sobrenome é obrigatório."
      },
      cpf: {
        required: "O campo de CPF é obrigatório.",
        cpfBR: "Por favor, insira um CPF válido."
      },
      phone: {
        required: "O campo de contato é obrigatório."
      },
      code: {
        required: "O campo de CEP é obrigatório.",
        postalcodeBR: "Por favor, insira um CEP válido."
      },
      street: {
        required: "O campo de rua é obrigatório."
      },
      address: {
        required: "O campo de bairro é obrigatório."
      },
      city: {
        required: "O campo de cidade é obrigatório."
      },
      estate: {
        required: "O campo de estado é obrigatório."
      },
      number: {
        required: "O campo de número é obrigatório."
      },
      birthday: {
        required: "O campo de data de nascimento é obrigatório.",
        date: "Por favor, insira uma data válida no formato dd-mm-yyyy."
      }
    }
  });

// Trigger finish process when "Enviar" button is clicked
$('#submitButton').on('click', function () {
  var form = $(".validation-wizard");
  if (form.valid()) {
    form.steps("next");
    form.steps("finish");
  }
});