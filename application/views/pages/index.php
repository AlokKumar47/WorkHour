<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WHM | Home Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>style/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>style/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>style/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>style/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>style/css/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url()?>style/css/morris.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url()?>style/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url()?>style/css/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view('include/header.php');?>
  
  <?php $this->load->view('include/sidebar.php');?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home Page
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> WHM</a></li>
        <li class="active">Home Page</li>
      </ol>
    </section>



  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('include/footer.php');?>
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>style/js/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url()?>style/js/jquery/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>style/js/jquery/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?=base_url()?>style/js/raphael.min.js"></script>
<script src="<?=base_url()?>style/js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url()?>style/js/jquery/jquery.sparkline.min.js"></script>

<!-- jQuery Knob Chart -->
<script src="<?=base_url()?>style/js/jquery/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url()?>style/js/moment.min.js"></script>
<script src="<?=base_url()?>style/js/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=base_url()?>style/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>style/js/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url()?>style/js/jquery/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>style/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>style/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url()?>style/js/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>style/js/demo.js"></script>
</body>
</html>
