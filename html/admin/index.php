<!DOCTYPE html>
<html dir="ltr" lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords"
    content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, nice admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, " />
  <meta name="robots" content="noindex,nofollow" />
  <title>ACEADEB</title>
  <link rel="canonical" href="https://www.wrappixel.com/templates/niceadmin/" />
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png" />
  <link href="../../dist/css/style.min.css" rel="stylesheet" />
  <link href="./styles.css" rel="stylesheet" />
</head>


<body>
  <div class="page-wrapper">
    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-5 align-self-center">
          <h4 class="page-title">
          </h4>
        </div>
        <div class="col-7 align-self-center">
          <div class="d-flex align-items-center justify-content-end">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="/template2/html/">Sair</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">

                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

     <!-- Modal de Confirmação -->
     <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir este beneficiário?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary font-weight-medium rounded-pill px-4" data-bs-dismiss="modal" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger font-weight-medium rounded-pill px-4" id="confirmDeleteButton">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="cadastroModalLabel">Cadastro</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" placeholder="Nome" id="form-client" />
                          <label for="form-client">Nome</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="form-cpf" placeholder="CPF" />
                          <label for="form-cpf">CPF</label>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="form-rg" placeholder="RG" />
                          <label for="form-cpf">RG</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="form-cep" placeholder="CEP" />
                          <label for="form-cep">CEP</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="form-endereco" placeholder="Logradouro" />
                          <label for="form-endereco">Logradouro</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="form-numero" placeholder="Número" />
                          <label for="form-numero">Número</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="form-bairro" placeholder="Bairro" />
                          <label for="form-bairro">Bairro</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="form-cidade" placeholder="Cidade" />
                          <label for="form-cidade">Cidade</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="tel" class="form-control" id="form-contato" placeholder="Contato" />
                          <label for="form-contato">Contato</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="form-email" placeholder="E-mail" />
                          <label for="form-email">E-mail</label>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="date" class="form-control" id="form-nascimento" placeholder="Nascimento" />
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="d-md-flex align-items-center mt-3">
                          <div class="form-check"></div>
                          <div class="ms-auto mt-3 mt-md-0">
                            <button type="button" class="btn btn-info font-weight-medium rounded-pill px-4"
                              onclick="setclient()" id="btn_profile_save">
                              <div class="d-flex align-items-center">
                                <i data-feather="save" class="feather-sm fill-white me-2"></i>
                                Salvar
                              </div>
                            </button>
                            <input type="hidden" id="form-idclient" value="">
                            <div id="result"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="card">

            <div class="border-bottom title-part-padding d-flex justify-content-between align-items-center p-3">
              <h4 class="card-title mb-0">Lista</h4>
              <button type="button" class="btn btn-info font-weight-medium rounded-pill px-4" id="buttonCadastro" data-bs-toggle="modal"
                data-bs-target="#cadastroModal">
                <div class="d-flex align-items-center">
                  <i data-feather="save" class="feather-sm fill-white me-2"></i>
                  <span id="buttonText">Cadastrar beneficiário</span>
                </div>
              </button>
            </div>

            <div class="card-body ">
              <h6 class="card-subtitle mb-3">              </h6>
              <div class="table-responsive">
                <table id="tableList" class="table table-striped table-bordered display table-hover w-100" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>RG</th>
                      <th>CPF</th>
                      <th>Contato</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal para Detalhes do Usuário -->
      <div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="userDetailsModalLabel">Detalhes do Usuário</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Campos para exibir detalhes do usuário -->
              <div class="row">
                <div class="col-md-6">
                  <strong>Nome:</strong> <span id="userNome"></span>
                </div>
                <div class="col-md-6">
                  <strong>Email:</strong> <span id="userEmail"></span>
                </div>
                <div class="col-md-6">
                  <strong>RG:</strong> <span id="userRg"></span>
                </div>
                <div class="col-md-6">
                  <strong>CPF:</strong> <span id="userCpf"></span>
                </div>
                <div class="col-md-6">
                  <strong>Nascimento:</strong> <span id="userNascimento"></span>
                </div>
                <div class="col-md-6">
                  <strong>Celular:</strong> <span id="userCelular"></span>
                </div>
                <div class="col-md-6">
                  <strong>Estado Civil:</strong> <span id="userEstadoCivil"></span>
                </div>
                <div class="col-md-6">
                  <strong>CEP:</strong> <span id="userCep"></span>
                </div>
                <div class="col-md-6">
                  <strong>Pai:</strong> <span id="userPai"></span>
                </div>
                <div class="col-md-6">
                  <strong>Mãe:</strong> <span id="userMae"></span>
                </div>
                <div class="col-md-6">
                  <strong>Naturalidade:</strong> <span id="userNaturalidade"></span>
                </div>
                <div class="col-md-6">
                  <strong>Nacionalidade:</strong> <span id="userNacionalidade"></span>
                </div>
                <div class="col-md-6">
                  <strong>Endereço:</strong> <span id="userEndereco"></span>
                </div>
                <div class="col-md-6">
                  <strong>Número:</strong> <span id="userNumero"></span>
                </div>
                <div class="col-md-6">
                  <strong>Bairro:</strong> <span id="userBairro"></span>
                </div>
                <div class="col-md-6">
                  <strong>Complemento:</strong> <span id="userComplemento"></span>
                </div>
                <div class="col-md-6">
                  <strong>Cidade:</strong> <span id="userCidade"></span>
                </div>
                <div class="col-md-6">
                  <strong>Estado:</strong> <span id="userEstado"></span>
                </div>
              </div>
              <hr />
              <h5>Documentos Assinados</h5>
              <table id="tableList" class="table table-striped table-bordered table-wrapper display table-hover"
                style="width: 100%">
                <thead>
                  <tr>
                    <th>Nome documento</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Arquivo</th>
                  </tr>
                </thead>
                <tbody id="documentList">
                  <!-- Lista de documentos assinados -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap tether Core JavaScript -->
      <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- apps -->
      <script src="../../dist/js/app.min.js"></script>
      <script src="../../dist/js/app.init.horizontal.js"></script>
      <script src="../../dist/js/app-style-switcher.horizontal.js"></script>
      <!-- slimscrollbar scrollbar JavaScript -->
      <script src="../../dist/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.js"></script>
      <script src="../../dist/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
      <script src="../../dist/js/feather.min.js"></script>
      <script src="../../dist/js/custom.min.js"></script>

      <script type="module" src="index.js"></script>

</body>

</html>