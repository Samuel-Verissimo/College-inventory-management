<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Visualizar estoque</title>
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
              <h3 class="page-title">Visualização do estoque de produtos atual</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Menu inicial</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Estoque de produtos </li>
                </ol>
              </nav>
            </div>
            <!-- Menu/ -->

            <!-- Tabela para visualizar o estoque atual -->
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
                      </div>

                      <!-- Tabela -->
                      <div id="live_data"></div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Tabela para visualizar o estoque atual/ -->
          </div>
          <!-- content-wrapper ends -->
        
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>


<script>
// Listando dados do banco de dados via AJAX
function fetch_data()  
{ 
    $.ajax({  
        url:"processings/view/listar_estoque.php",  
        method:"POST",  
        success:function(data){  
            $('#live_data').html(data);  
        }  
    });  
}  

// Chamando função listar
fetch_data();  
</script>