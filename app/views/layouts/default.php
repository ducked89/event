<?php
$view_title = "Login";
header('Content-type: text/html; charset=utf-8');


	// var_dump($_SESSION);
	// die();
	if(isset($datas['user']) && method_exists($datas['user'], "isConnected"))
	{
		if($datas['user']->level == "2") header("Location:".SITE."members/");
		else header("Location:".SITE."admin/");
	}
?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo $view_title; ?> | Syntone | Haiti Event</title>

	
	<link href="<?php echo SITE;?>public/images/e1.jpg" rel="shortcut icon" type="favicon" />

	<!-- Bootstrap core CSS -->
	<link href="<?php echo SITE;?>public/css/bootstrap.min.css" rel="stylesheet">

	<!-- Animation CSS -->
	<link href="<?php echo SITE;?>public/css/animate.css" rel="stylesheet">
	<link href="<?php echo SITE;?>public/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?php echo SITE;?>public/css/style.css" rel="stylesheet">
    <link href="<?php echo SITE;?>public/css/plugins/dataTables/datatables.min.css" rel="stylesheet">


</head>
<body id="page-top" class="landing-page no-skin-config gray-bg" onload="window.open('', '_self', '');">

	<?php   require_once 'app/views/includes/header/default.php'; ?>
	<?php   require_once 'app/views/' .$view. '.php'; ?>
	<?php   require_once 'app/views/includes/footer/default.php'; ?>

	
	<!-- Mainly scripts -->
	<script src="<?php echo SITE;?>public/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo SITE;?>public/js/bootstrap.min.js"></script>
	<script src="<?php echo SITE;?>public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="<?php echo SITE;?>public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<script src="<?php echo SITE;?>public/js/plugins/dataTables/datatables.min.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="<?php echo SITE;?>public/js/utescripts.js"></script>
	<script src="<?php echo SITE;?>public/js/inspinia.js"></script>
	<script src="<?php echo SITE;?>public/js/plugins/pace/pace.min.js"></script>
</body>
</html>


