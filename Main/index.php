<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sistema de estoque</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
  </head>

  <body>
    <div class="container-scroller">
     <?php include_once('side.php'); ?>
      <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            <!-- chart row starts here -->
            <div class="row">
              <div class="col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="card-title"> Entradas / Saídas de produtos <small class="d-block text-muted">August 01 - August 31</small>
                      </div>
                    </div>
                    <h3 class="font-weight-bold mb-0"> 2,409 <span class="text-success h5">4,5%<i class="mdi mdi-arrow-up"></i></span>
                    </h3>
                    <div class="line-chart-wrapper">
                      <canvas id="linechart" height="80"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="card-title"> Entradas / Saídas de produtos <small class="d-block text-muted">August 01 - August 31</small>
                      </div>
                    </div>
                    <h3 class="font-weight-bold mb-0"> 0.40% <span class="text-success h5">0.20%<i class="mdi mdi-arrow-up"></i></span>
                    </h3>
                    <div class="bar-chart-wrapper">
                      <canvas id="barchart" height="80"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- last row starts here -->
            <div class="row">
              <div class="col-sm-6 col-xl-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h3 class="mb-3">Atividades recentes</h3>

                    <?php 
                    // Conexão com banco de dados
                    require_once('conexaobd.php');

                    // Buscando os valores na tabela de "logs_produtos"
                    $consult = mysqli_query($con, "SELECT * FROM logs_produtos ORDER BY idLog DESC LIMIT 5");

                    // Se existir valores, exibir, se não, exibir mensagem...
                    if(mysqli_num_rows($consult) > 0){
                  
                      while($row = mysqli_fetch_array($consult)){
                      ?>

                      <div class="d-flex border-bottom border-top py-3">
                        <div class="pl-2">
                          <span class="font-12 text-muted"><?=date('d/m/Y H:i:s', strtotime($row['dataHora']))?></span>
                          <p class="m-0 text-black"> <?=$row['acao']?> </p>
                        </div>
                      </div>

                      <?php }}else{
                        echo"
                        <div class='d-flex border-bottom border-top py-3'>
                            <div class='pl-2'>
                              <p class='m-0 text-black'>Não possuimos atividades recentes por enquanto...</p>
                            </div>
                        </div>
                        ";
                      } ?>
              
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-xl-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h3 class="mb-3">Notificações do estoque</h3>

                    <?php 
                    // Conexão com banco de dados
                    require_once('conexaobd.php');

                    // Buscando os valores na tabela de "logs_alertas"
                    $consult = mysqli_query($con, "SELECT * FROM logs_alertas ORDER BY idAlerta DESC LIMIT 5");

                    // Se existir valores, exibir, se não, exibir mensagem...
                    if(mysqli_num_rows($consult) > 0){

                      while($row = mysqli_fetch_array($consult)){
                      ?>

                      <div class="d-flex border-bottom border-top py-3">
                        <div class="pl-2">
                          <p class="m-0 text-black"> <?=$row['acao']?> </p>
                        </div>
                      </div>

                    <?php }}else{
                      echo"
                      <div class='d-flex border-bottom border-top py-3'>
                          <div class='pl-2'>
                            <p class='m-0 text-black'>Não possuimos notificações do estoque por enquanto...</p>
                          </div>
                      </div>
                      ";
                    } ?>
          
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- Rodapé --> 
          <?php include_once('sfooter.php'); ?>
          <!-- Rodapé/  --> 
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
    <script src="../assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.stack.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>