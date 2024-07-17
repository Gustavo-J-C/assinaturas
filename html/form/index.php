<!DOCTYPE html>
<html dir="ltr" lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords"
    content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, nice admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, " />
  <meta name="robots" content="noindex,nofollow" />
  <title>ACEADEB</title>
  <link rel="canonical" href="https://www.wrappixel.com/templates/niceadmin/" />
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png" />
  <link href="../../dist/css/style.min.css" rel="stylesheet" />
</head>

<body>
  <div id="main-wrapper">
    <header class="topbar">
      <nav class="navbar top-navbar navbar-expand-lg navbar-dark">
        <div class="navbar-header">
          <div class="navbar-brand">
            <a href="index.html" class="logo">
              <b class="logo-icon">
                <img src="../../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                <img src="../../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
              </b>
              <span class="logo-text">
                <img src="../../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                <!-- Light Logo text -->
                <img src="../../assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
              </span>
            </a>
          </div>


        </div>

      </nav>
    </header>

    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Prova de vida</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">CEADEB</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Prova de Vida
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-body wizard-content">
                <form action="#" class="validation-wizard wizard-circle mt-5">
                  <!-- Step 1 -->
                  <h6>Formulário</h6>
                  <section>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="name">
                            Nome : <span class="danger">*</span>
                          </label>
                          <input type="text" class="form-control required" id="name" name="nome" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="lastName">
                            RG: <span class="danger">*</span>
                          </label>
                          <input type="text" class="form-control required" id="rg" name="rg" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="email">
                            Email : <span class="danger">*</span>
                          </label>
                          <input type="email" class="form-control required" id="email" name="email" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="phone">Telefone :</label>
                          <input type="tel" class="form-control" name="phone" id="phone" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="cpf">
                            CPF : <span class="danger">*</span>
                          </label>
                          <input type="cpf" class="form-control required" id="cpf" name="cpf" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="birthday">Data de Nascimento :</label>
                          <input type="date" class="form-control" name="birthday" id="birthday" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="estate">
                            Estado : <span class="danger">*</span>
                          </label>
                          <input class="form-control required" id="estate" name="estate" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="city">
                            Cidade : <span class="danger">*</span>
                          </label>
                          <input class="form-control required" id="city" name="city" />

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="address">
                            Bairro : <span class="danger">*</span>
                          </label>
                          <input type="text" class="form-control required" id="address" name="address" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="street">
                            Rua : <span class="danger">*</span>
                          </label>
                          <input type="text" class="form-control required" id="street" name="street" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="number">
                            Numero : <span class="danger">*</span>
                          </label>
                          <input type="text" class="form-control required" id="number" name="number" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="code">
                            CEP : <span class="danger">*</span>
                          </label>
                          <input type="text" class="form-control required" id="code" name="code" />
                        </div>
                      </div>
                    </div>
                  </section>
                  <!-- Step 2 -->
                  <h6>Documento</h6>
                  <section>
                    <div id="loadingIndicator" class="row">
                      <div class="col-md-12 text-center">
                        <div class="spinner-border text-primary" role="status">
                          <span class="visually-hidden">Gerando documento...</span>
                        </div>
                        <p class="mt-3">Gerando documento, por favor aguarde...</p>
                      </div>
                    </div>
                    <div id="documentGenerated" class="row" style="display: none;">
                      <div class="col-md-12">
                        <div class="alert alert-success" role="alert">
                          <h4 class="alert-heading">Documento Gerado com Sucesso!</h4>
                          <p>Você receberá uma notificação via WhatsApp com o link para assinar o documento.</p>
                          <hr>
                          <p class="mb-0">Clique no link abaixo para visualizar o documento:</p>
                          <a id="viewDocumentLink" href="#" target="_blank" class="alert-link">Visualizar Documento</a>
                        </div>
                      </div>
                      <div class="col-md-12 text-center mt-4">
                        <a id="downloadDocumentLink" href="#" target="_blank" class="btn btn-info" download>Baixar
                          Documento</a>
                      </div>
                    </div>
                  </section>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer text-center">
        Todos os direitos reservador po CEADEB.
      </footer>

    </div>

  </div>

  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
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
  <!--Wave Effects -->
  <script src="../../dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="../../dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="../../dist/js/feather.min.js"></script>
  <script src="../../dist/js/custom.min.js"></script>
  <script src="../../dist/libs/jquery-steps/build/jquery.steps.min.js"></script>
  <script src="../../dist/libs/jquery-validation/dist/jquery.validate.min.js"></script>
  <!-- <script src="./index.js" ></script> -->
  <script src="./dynamicSetup.js"></script>
  <script src="./formValidation.js"></script>
  <script src="./ajaxRequests.js"></script>
</body>

</html>