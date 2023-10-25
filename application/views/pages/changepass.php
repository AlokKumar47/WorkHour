<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo $_SESSION['id'];exit;
// var_dump($_SESSION);exit;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WHM | Change Password</title>
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
  
  <?php $this->load->view('include/sidebar.php', array('permission',$permission));?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password
        <small>User Profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> User Profile</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>
	
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-7">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?= base_url('updtpass')?>" method="POST" id="projForm" class="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="proj">Old Password</label>
                  <?php echo form_input(['class'=>'form-control','id'=>'oldpass','placeholder'=>'Enter Old Password','name'=>'oldpass']); ?>
				  <?php echo form_error('oldpass');?>
                </div>
				<div class="form-group">
                  <label for="proj">New Password</label>
                  <?php echo form_input(['class'=>'form-control','id'=>'newpass','placeholder'=>'Enter New Password','name'=>'newpass']); ?>
				  <?php echo form_error('newpass');?>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
				<button type="submit" class="btn btn-primary btn-block" value="Submit">Submit</button>
              </div>
			</form>
			<!-- Form Close -->
          </div>
          <!-- /.box -->
		</div>
		
		</div>
	</section>
<!-- /.Main content -->

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
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>style/js/jquery/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url()?>style/js/jquery/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>style/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>style/js/adminlte.min.js"></script>
</script>

</body>
</html>

