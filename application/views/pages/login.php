<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WHM | Log in</title>
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
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

  HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>"><b>WHM</b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?php echo form_open('LoginSubmit');?>
      <div class="form-group has-feedback">
        <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Email ID','name'=>'eid','value'=>set_value('eid')]); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span><?php echo form_error('eid');?>
      </div>
      <div class="form-group has-feedback">
        <?php echo form_password(['class'=>'form-control','placeholder'=>'Password','name'=>'pass','value'=>set_value('pass')]); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span><?php echo form_error('pass');?><?php echo form_error('validatepass');?>
      </div>
      <div class="row">
		<div class="col-xs-8">
			<?php echo form_reset(['type'=>'reset','class'=>'btn btn-danger btn-flat','value'=>'Reset']); ?>
		</div>
        <div class="col-xs-4">
          <?php echo form_submit(['type'=>'submit','class'=>'btn btn-primary btn-block btn-flat','value'=>'Submit']); ?>
        </div>
        <!-- /.col -->
      </div>
	<?php echo form_close();?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>style/js/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>style/js/jquery/bootstrap.min.js"></script>

</body>
</html>