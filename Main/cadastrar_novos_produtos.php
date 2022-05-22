<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Cadastrar novos produtos</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/css/demo_1/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  </head>

  <body>

    <div class="container-scroller">
     <?php include_once('side.php'); ?>
        <div class="main-panel">

          <!-- Menu -->
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Cadastrar novos produtos</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Menu inicial</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Cadastrar novos produtos </li>
                </ol>
              </nav>
            </div>
            <!-- Menu/ -->

            <!-- Tabela para visualizar novos produtos e realizar cadastros -->
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <div class="page-header flex-wrap">
                        <div class="header-left">
                          <button class="btn btn-primary mb-2 mb-md-0 mr-2"> PDF </button>
                          <button class="btn btn-outline-primary bg-white mb-2 mb-md-0"> EXCEL </button>
                        </div>
                        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                          <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal" data-target="#ModalNovoProduto">
                            <i class="mdi mdi-plus-circle"></i> Cadastrar produto </button>
                        </div>
                      </div>

                      <!-- Tabela -->
                      <div id="live_data"></div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Tabela para visualizar entradas de produtos e realizar cadastros/ -->
          </div>
          <!-- content-wrapper ends -->

          <!-- Modal cadastro -->
          <div class="modal fade" id="ModalNovoProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Abaixo você pode cadastrar um novo <b>produto</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" enctype="multipart/form-data" id="form-new" role="form">
                      <div class="form-group">
                        <label for="exampleInputName1">Nome <code> *</code></label>
                        <input type="text" class="form-control" id="novo_produto" placeholder="Digite o nome do produto..." />
                      </div>
                      <div class="form-group">
                      <label for="exampleInputName1">Selecione a imagem <code> *</code></label>
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type="file" id="files" name="files[]" accept=".png, .jpg, .jpeg"/>
                                <label for="indexImage1Upload"></label>
                            </div>
                        </div>
                      </div>
                    </form>
                </div>

                <!-- Alert quando houver um cadastro -->
                <div class="alert alert-success alert-dismissible fade show" id="msg_success" role="alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Alert quando der um erro -->
                <div class="alert alert-danger alert-dismissible fade show" id="msg_error" role="alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Alert quando houver duplicação -->
                <div class="alert alert-warning alert-dismissible fade show" id="msg_duplicate" role="alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <button type="button" id="btn-cadastrar-novo-produto" class="btn btn-primary">Realizar Cadastro</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal cadastro/ -->

        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>

    <!-- Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>

<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->

<script>
// Listando dados do banco de dados via AJAX
function fetch_data()  
{ 
    $.ajax({  
        url:"processings/view/listar_produtos.php",  
        method:"POST",  
        success:function(data){  
            $('#live_data').html(data);  
        }  
    });  
}  

// Chamando função listar
fetch_data();  

// Ao clicar no botão com o ID abaixo, chamar essa função, que faz a inserção no banco de dados via AJAX...
$(document).ready(function() {
    $('#btn-cadastrar-novo-produto').on('click', function() {

      // Declarando variaveis e puxando valores dos inputs
      var produto = $('#novo_produto').val();
      var imagem = $('#files').val();

        // Condição para caso for insert do produto e da imagem
        if(produto != '' && imagem != ''){

          // Upload multiple files
          var form_data = new FormData();
          var totalfiles = document.getElementById('files').files.length;

          // Colocando todos os arquivos no form_data
          for (var index = 0; index < totalfiles; index++) {
              form_data.append("files[]", document.getElementById('files').files[index]);
          }

          // Adicionando nome do produto no form_data
          form_data.append('novo_produto', produto);   

          $.ajax({
              "url" :"processings/insert/novos_produtos.php",
              type: "POST",
              data: form_data,
              dataType: 'json',
              contentType: false,
              processData: false,

              // Caso der certo...
              success: function(response){
                  
                  // Mensagens de sucesso/erro
                  if(response == 1){
                      $("#msg_success").show();
                      $('#msg_success').html('<b>Parabéns!</b> Um novo produto foi cadastrado.'); 
                      $('#msg_success').show(0).delay(2500).hide(0);	

                      // Chamando função listar
                      fetch_data();  
                  }
                  if(response == 2){
                      $("#msg_error").show();
                      $('#msg_error').html('<b>Ops!</b> Algo deu errado, tente novamente!'); 
                      $('#msg_error').show(0).delay(2500).hide(0);	
                  }
                  if(response == 3){
                    $("#msg_duplicate").show();
                    $('#msg_duplicate').html('<b>Atenção!</b> Já temos esse produto cadastrado!'); 
                    $('#msg_duplicate').show(0).delay(2500).hide(0);	
                  }
                  $('#form-new')[0].reset();
              }
          });

      // Se só for fazer a inserção nome do produto
      }else if(produto != '' && imagem == ''){

        $.ajax({
              "url" :"processings/insert/novos_produtos_img.php",
              type: "POST",
              data: {produto: produto},
              dataType: 'json',
              cache: false,

              // Caso der certo...
              success: function(response){
                  
                  // Mensagens de sucesso/erro
                  if(response == 1){
                      $("#msg_success").show();
                      $('#msg_success').html('<b>Parabéns!</b> Um novo produto foi cadastrado.'); 
                      $('#msg_success').show(0).delay(2500).hide(0);	

                      // Chamando função listar
                      fetch_data();  
                  }
                  if(response == 2){
                      $("#msg_error").show();
                      $('#msg_error').html('<b>Ops!</b> Algo deu errado, tente novamente!'); 
                      $('#msg_error').show(0).delay(2500).hide(0);	
                  }
                  if(response == 3){
                    $("#msg_duplicate").show();
                    $('#msg_duplicate').html('<b>Atenção!</b> Já temos esse produto cadastrado!'); 
                    $('#msg_duplicate').show(0).delay(2500).hide(0);	
                  }
                  $('#form-new')[0].reset();
              }
          });

      // Se estiver ambos sem valor, não fazer a inserção!
      }else{
        $("#msg_error").show();
        $('#msg_error').html('<b>Ops!</b> Algo deu errado, tente novamente!'); 
        $('#msg_error').show(0).delay(2500).hide(0);	
      }
    });
});

</script>
