// formValidation.js

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
      return onStepChangingHandler(event, currentIndex, newIndex);
    },
    onFinishing: function (event, currentIndex) {
      return (form.validate().settings.ignore = ":disabled"), form.valid();
    },
    onFinished: function (event, currentIndex) {
      // lógica ao finalizar o formulário
    },
  });
  
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
  
  $('#submitButton').on('click', function () {
    var form = $(".validation-wizard");
    if (form.valid()) {
      form.steps("next");
      form.steps("finish");
    }
  });
  