// ajaxRequests.js

let documentCreated = false;
let documentLink;

var form = $(".validation-wizard").show();

const onStepChangingHandler = (event, currentIndex, newIndex) => {
  var returnControler = true;
  if (currentIndex === 0 && newIndex === 1) {
    if (form.valid() && !documentCreated) {
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

      $('#loadingIndicator1').show();
      $('.actions').hide();

      $.ajax({
        url: '../../src/generate_pdf.php',
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
            $('#loadingIndicator1').hide();
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
          alert('Erro ao enviar os dados. Por favor, tente novamente.');
          returnControler = false;
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
};
