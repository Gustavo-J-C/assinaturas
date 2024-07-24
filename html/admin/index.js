import { clientes, documentos } from "../api.js";

let clients = {};
let currentRowElement = null;
let currentCpf = null;

document.getElementById("buttonCadastro").addEventListener('click', function () {
    document.getElementById("cadastroModalLabel").innerText = `Cadastrar beneficiário`;
});

const tableBody = document.querySelector('#tableList tbody');
async function fetchClients() {
    try {
        // const response = await fetch('https://api.example.com/clients'); // Substitua pela URL do seu endpoint
        // const clients = await response.json();
        return clientes;
    } catch (error) {
        console.error('Erro ao buscar clientes:', error);
        return [];
    }
}

async function fetchClientDetails(clientId) {
    try {
        const client = clientes.find(cliente => cliente.cpf === clientId);
        // const response = await fetch(`https://api.example.com/clients/${clientId}`); // Substitua pela URL do seu endpoint
        // const clientDetails = await response.json();
        client.documents = documentos
        return client;
    } catch (error) {
        console.error('Erro ao buscar detalhes do cliente:', error);
        return null;
    }
}

async function populateTable() {
    clients = await fetchClients();
    tableBody.innerHTML = '';
    clients.forEach(client => {
        const row = createTableRow(client);
        tableBody.appendChild(row);
    });
}
// Função para criar uma linha na tabela
function createTableRow(data) {
    const tr = document.createElement('tr');
    tr.className = 'document-link';
    tr.innerHTML = `
                <td>${data.nome}</td>
                <td>${data.email}</td>
                <td>${data.rg}</td>
                <td>${data.cpf}</td>
                <td>${data.contato}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-btn" data-id="${data.cpf}">Editar</button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="${data.cpf}">Excluir</button>
                </td>
            `;

    tr.querySelector('.edit-btn').addEventListener('click', (event) => {
        event.stopPropagation(); // Evita que o evento de clique na linha seja acionado
        editClient(data.cpf);
    });

    tr.querySelector('.delete-btn').addEventListener('click', (event) => {
        event.stopPropagation();
        showConfirmationModal(data.cpf, tr);
    });

    tr.addEventListener('click', () => {
        openUserDetailsModal(data.cpf);
    });

    return tr;
}

async function openUserDetailsModal(clientId) {
    const user = await fetchClientDetails(clientId);
    if (!user) return;

    document.getElementById('userNome').textContent = user.nome;
    document.getElementById('userEmail').textContent = user.email;
    document.getElementById('userRg').textContent = user.rg;
    document.getElementById('userCpf').textContent = user.cpf;
    document.getElementById('userNascimento').textContent = user.nascimento;
    document.getElementById('userCelular').textContent = user.contato;
    document.getElementById('userEstadoCivil').textContent = user.estado_civil;
    document.getElementById('userCep').textContent = user.cep;
    document.getElementById('userPai').textContent = user.pai;
    document.getElementById('userMae').textContent = user.mae;
    document.getElementById('userNaturalidade').textContent = user.naturalidade;
    document.getElementById('userNacionalidade').textContent = user.nacionalidade;
    document.getElementById('userEndereco').textContent = user.endereco;
    document.getElementById('userNumero').textContent = user.numero;
    document.getElementById('userBairro').textContent = user.bairro;
    document.getElementById('userComplemento').textContent = user.complemento;
    document.getElementById('userCidade').textContent = user.cidade;
    document.getElementById('userEstado').textContent = user.estado;

    // Documentos assinados do cliente
    const os = user.documents; // Supondo que os documentos assinados estejam no campo `documents`

    const documentList = document.getElementById('documentList');
    documentList.innerHTML = ''; // Limpar a lista de documentos antes de popular
    os.forEach(doc => {
        const docElement = document.createElement('tr');
        docElement.href = doc.link;
        docElement.target = '_blank';
        docElement.innerHTML = `
                    <td>${doc.nome}</td>
                    <td>${doc.data}</td>
                    <td>Pendente</td>
                    <td><a href="${doc.link}" class="text-center" target="_blank">
                        <img src="../assets/images/pdf.png" alt="${doc.nome}" class="icon-adjust" onerror="this.onerror=null; this.src=''; this.alt='${doc.nome}'">
                    </a></td>
                `;
        documentList.appendChild(docElement);
    });

    // Exibir o modal
    const userDetailsModal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
    userDetailsModal.show();
}

function editClient(clientId) {
    const client = clients.find(client => client.cpf === clientId);
    if (!client) {
        console.error(`Cliente com CPF ${clientId} não encontrado.`);
        return;
    }

    // Preencher os campos do modal de cadastro com os dados do cliente
    document.getElementById("cadastroModalLabel").innerText = `Editar beneficiário ${client.nome}`;
    document.getElementById('form-cpf').value = client.cpf;
    document.getElementById('form-rg').value = client.rg;
    document.getElementById('form-cep').value = client.cep;
    document.getElementById('form-endereco').value = client.endereco;
    document.getElementById('form-numero').value = client.numero;
    document.getElementById('form-bairro').value = client.bairro;
    document.getElementById('form-cidade').value = client.cidade;
    document.getElementById('form-client').value = client.nome;
    document.getElementById('form-contato').value = client.contato;
    document.getElementById('form-nascimento').value = client.nascimento;
    document.getElementById('form-email').value = client.email;

    // Definir o ID do cliente no campo oculto (se necessário para lógica de atualização)
    document.getElementById('form-idclient').value = clientId;

    // Abrir o modal de cadastro para edição
    const cadastroModal = new bootstrap.Modal(document.getElementById('cadastroModal'));
    cadastroModal.show();

    // Adicionar lógica para salvar as alterações
    document.getElementById('btn_profile_save').onclick = function () {
        // Aqui você pode implementar a lógica para salvar as alterações do cliente
        const updatedClient = {
            cpf: document.getElementById('form-cpf').value,
            cep: document.getElementById('form-cep').value,
            logradouro: document.getElementById('form-endereco').value,
            numero: document.getElementById('form-numero').value,
            bairro: document.getElementById('form-bairro').value,
            cidade: document.getElementById('form-cidade').value,
            nomeContato: document.getElementById('form-client').value,
            celular: document.getElementById('form-celular').value,
            telefone: document.getElementById('form-telefone').value,
            email: document.getElementById('form-email').value,
        };

        // Aqui você pode enviar os dados atualizados para o servidor
        console.log('Dados atualizados do cliente:', updatedClient);

        // Fechar o modal após salvar
        cadastroModal.hide();
    };
}


// Função para mostrar o modal de confirmação
function showConfirmationModal(cpf, rowElement) {
    currentCpf = cpf;
    currentRowElement = rowElement;
    $('#confirmationModal').modal('show');
}

// Função para enviar a requisição DELETE e remover a linha da tabela
async function deleteClient() {
    try {
        // const response = await fetch(`https://api.exemplo.com/clientes/${currentCpf}`, {
        //     method: 'DELETE'
        // });

        if (1 == 1) {
            currentRowElement.remove();
            $('#confirmationModal').modal('hide');
        } else {
            console.error('Erro ao excluir o cliente:', response.statusText);
            alert(`Erro ao excluir o cliente: ${response.statusText}`);
        }
    } catch (error) {
        console.error('Erro ao enviar a requisição DELETE:', error);
        alert(`Erro ao enviar a requisição DELETE: ${error.message}`);
    }
}

document.getElementById('confirmDeleteButton').addEventListener('click', () => {
    deleteClient();
});

document.addEventListener('DOMContentLoaded', function () {
    populateTable();
});
