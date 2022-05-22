<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Entradas de produtos</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
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
              <h3 class="page-title">Visualização das entradas de produtos</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Menu inicial</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Entradas de produtos </li>
                </ol>
              </nav>
            </div>
            <!-- Menu/ -->

            <!-- Tabela para visualizar entradas de produtos e realizar cadastros -->
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
                          <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal" data-target="#ModalEntrada">
                            <i class="mdi mdi-plus-circle"></i> Cadastrar entradas </button>
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
          <div class="modal fade" id="ModalEntrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Entrada em um produto em nosso <b>estoque</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form method="POST" id="form-new">

                  <div class="form-group row">
                      <div class="col">
                      <label for="exampleSelectGender">Selecione o produto que está entrando</label>
                        <select class="form-control" id="produto_entrada" required>
                          <?php 
                            require_once('conexaobd.php');
                            $listar_produtos = mysqli_query($con, "SELECT * FROM aux_produtos ORDER BY nomeProduto");
                            while($row = mysqli_fetch_array($listar_produtos)){
                              echo" <option value='".$row['idProduto']."'>".$row['nomeProduto']."</option> ";
                            }
                          ?>
                        </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col">
                        <label>Quantidade</label>
                        <div id="the-basics">
                          <input class="typeahead" id="quantidade_entrada" type="number" placeholder="Minímo 0" required/>
                        </div>
                      </div>
                      <div class="col">
                        <label>Data da entrada</label>
                        <div id="bloodhound">
                          <input class="typeahead" id="data_entrada" type="date" required/>
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

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <button type="button" id="btn-cadastrar-entrada-produto" class="btn btn-primary">Cadastrar entrada</button>
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
    <!-- endinject -->

    <!-- Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
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
        url:"processings/view/listar_entradas_produtos.php",  
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
    $('#btn-cadastrar-entrada-produto').on('click', function() {

      // Declarando variaveis e puxando valores dos inputs
      var produto = $('#produto_entrada').val();
      var quantidade = $('#quantidade_entrada').val();
      var data = $('#data_entrada').val();

      // Verificando se algum campo está sem valores...
      if(produto != "" && quantidade != ""){

        $.ajax({
            "url" : "processings/insert/entradas_produtos.php",
            type: "POST",
            data: {
              produto: produto,
              quantidade: quantidade,
              data: data
            },
            cache: false,

            // Caso der certo...
            success: function(response){
                
                // Mensagens de sucesso/erro
                if(response == 1){
                    $("#msg_success").show();
                    $('#msg_success').html('<b>Parabéns!</b> registrado a entrada desse produto...'); 
                    $('#msg_success').show(0).delay(2500).hide(0);	

                    // Chamando função listar
                    fetch_data();  
                }
                if(response == 2){
                    $("#msg_error").show();
                    $('#msg_error').html('<b>Ops!</b> Algo deu errado, tente novamente!'); 
                    $('#msg_error').show(0).delay(2500).hide(0);	
                }

                $('#form-new')[0].reset();
            }
        });

    }
      // Se estiver sem valor, não fazer a inserção!
      else{
        $("#msg_error").show();
        $('#msg_error').html('<b>Atenção!</b> Preencha todos os campos!'); 
        $('#msg_error').show(0).delay(2500).hide(0);	
      }
    });
});

</script>
