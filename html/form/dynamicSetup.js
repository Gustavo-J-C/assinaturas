// dynamicSetup.js

document.addEventListener('DOMContentLoaded', function () {
    let userData = JSON.parse(localStorage.getItem('userData'));
  
    if (userData && userData.nome && userData.email && userData.cpf && userData.nascimento &&
      userData.estado && userData.cidade && userData.bairro && userData.endereco &&
      userData.numero && userData.cep) {
  
      const nameField = document.getElementById('name');
      const rgField = document.getElementById('rg');
      const cpfField = document.getElementById('cpf');
      const birthdayField = document.getElementById('birthday');
  
      document.getElementById('email').value = userData.email;
      document.getElementById('phone').value = userData.contato;
      document.getElementById('estate').value = userData.estado;
      document.getElementById('city').value = userData.cidade;
      document.getElementById('street').value = userData.endereco;
      document.getElementById('address').value = userData.endereco;
      document.getElementById('number').value = userData.numero;
      document.getElementById('code').value = userData.cep;
  
      nameField.setAttribute("disabled", true);
      nameField.value = userData.nome;
      rgField.setAttribute("disabled", true);
      rgField.value = userData.rg;
      cpfField.setAttribute("disabled", true);
      cpfField.value = userData.cpf;
      birthdayField.setAttribute("disabled", true);
      birthdayField.value = userData.nascimento;
    } else {
      console.error('userData is missing required fields.');
    }
  });
  