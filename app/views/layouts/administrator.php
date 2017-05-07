<?php
    header('Content-type: text/html; charset=UTF-8');
    $view_title = "Administrateur";

    $mInfo = $_SESSION['Auth'];
    $mMessages = (isset($datas['messages']))? $datas['messages'] : null;
    $mNotifcations = (isset($datas['notifications']))? $datas['notifications'] : null;
?>

<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $view_title; ?> | Syntone | Haiti Event</title>
    <link href="<?php echo SITE;?>public/images/e1.jpg" rel="shortcut icon" type="favicon" />

    <link href="<?php echo SITE;?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SITE;?>public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo SITE;?>public/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo SITE;?>public/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo SITE;?>public/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="<?php echo SITE;?>public/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo SITE;?>public/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?php echo SITE;?>public/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?php echo SITE;?>public/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo SITE;?>public/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="<?php echo SITE;?>public/css/animate.css" rel="stylesheet">
    <link href="<?php echo SITE;?>public/css/style.css" rel="stylesheet">

     <!-- Mainly scripts -->
        <!-- jQuery UI -->
    <script src="<?php echo SITE;?>public/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/jquery-ui/jquery-ui.min.js"></script>


</head>

<body>
    <div id="wrapper" >
       <!-- Menu -->
       <?php  require_once 'app/views/includes/menu/administrator.php';    ?>

       <!-- Page Body -->
       <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#">
                        <i class="fa fa-bars"></i> </a>

                    </div>

                    <!-- Top bar messages and menu -->
                    <?php  require_once 'app/views/includes/navbar/administrator.php';    ?>


                </nav>
            </div>


            <div class="row  border-bottom">
                <div class="col-lg-12"><?php   require_once 'app/views/' .$view. '.php'; ?></div>
            </div>

            <!-- Footer -->
            <?php  require_once 'app/views/includes/footer/administrator.php';?>
        </div>

    </div>


    <script src="<?php echo SITE;?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo SITE;?>public/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?php echo SITE;?>public/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo SITE;?>public/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo SITE;?>public/js/inspinia.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/pace/pace.min.js"></script>

    <!-- GITTER -->
    <script src="<?php echo SITE;?>public/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo SITE;?>public/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Select2 -->
    <script src="<?php echo SITE;?>public/js/plugins/select2/select2.full.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo SITE;?>public/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo SITE;?>public/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="<?php echo SITE;?>public/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/toastr/toastr.min.js"></script>

     <script src="<?php echo SITE;?>public/js/moment.js"></script>



   <!-- Date range picker -->
   <script src="<?php echo SITE;?>public/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo SITE;?>public/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <script src="<?php echo SITE;?>public/js/utescripts.js"></script>
    <!-- Clock picker -->
    <script src="<?php echo SITE;?>public/js/plugins/clockpicker/clockpicker.js"></script>

</body>
</html>
