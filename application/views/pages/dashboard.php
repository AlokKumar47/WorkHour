<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WHM | Dashboard</title>
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
  
  <?php $this->load->view('include/sidebar.php', array('permission',$permission));?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
	
<!-- Main content -->
<section class="content">
	<div class="row">
        <!-- left column -->
        <div class="col-md-7">
		
		
		
		</div>
	</div>
	<!-- Small boxes (Stat box) -->
      <div class="row">
		<?php $target = array('View Role', 'Add Role', 'Update Role', 'Delete Role');
			if(count(array_intersect($permission, $target)) > 0){ ?>
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-aqua">
				<div class="inner">
				  <h3><?php echo $count['role'] ?></h3><small>Records</small>

				  <p>Role Management</p>
				</div>
				<div class="icon">
				  <i class="fa fa-edit"></i>
				</div>
				<a href="<?= base_url('RoleManagement')?>" class="small-box-footer">
				  More info <i class="fa fa-arrow-circle-right"></i>
				</a>
			  </div>
			</div>
		<?php } ?>
        <!-- ./col -->
		<?php $target = array('View User', 'Add User', 'Update User', 'Delete User');
			if(count(array_intersect($permission, $target)) > 0){ ?>
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-green">
				<div class="inner">
				  <h3><?php echo $count['user'] ?></h3><small>Records</small>

				  <p>User Management</p>
				</div>
				<div class="icon">
				  <i class="fa fa-laptop"></i>
				</div>
				<a href="<?= base_url('UserManagement')?>" class="small-box-footer">
				  More info <i class="fa fa-arrow-circle-right"></i>
				</a>
			  </div>
			</div>
		<?php } ?>
        <!-- ./col -->
		<?php $target = array('View Project', 'Add Project', 'Update Project', 'Delete Project');
			if(count(array_intersect($permission, $target)) > 0){ ?>
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <h3><?php echo $count['project'] ?></h3><small>Records</small>

				  <p>Project Management</p>
				</div>
				<div class="icon">
				  <i class="fa fa-folder-open"></i>
				</div>
				<a href="<?= base_url('ProjectManagement')?>" class="small-box-footer">
				  More info <i class="fa fa-arrow-circle-right"></i>
				</a>
			  </div>
			</div>
		<?php } ?>
        <!-- ./col -->
		<?php $target = array('View Work', 'Add Work', 'Update Work', 'Delete Work');
			if(count(array_intersect($permission, $target)) > 0){ ?>
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-red">
				<div class="inner">
				  <h3><?php echo $count['work'] ?></h3><small>Records</small>

				  <p>Work Management</p>
				</div>
				<div class="icon">
				  <i class="fa fa-book"></i>
				</div>
				<a href="<?= base_url('WorkManagement')?>" class="small-box-footer">
				  More info <i class="fa fa-arrow-circle-right"></i>
				</a>
			  </div>
			</div>
		<?php } ?>
        <!-- ./col -->
      </div>
      <!-- /.row -->
	  
		  <!-- Project Table -->
		<?php if(in_array("View Project Summery", $permission)){ ?>
		<div class="col-md-7">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Project Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<table class="table table-bordered"  style="text-align: center">
					<tr>
					  <th style="width: 10px">#</th>
					  <th style="text-align: center">Project</th>
					  <th style="text-align: center">Created On</th>
					  <th style="text-align: center">Elapsed Time</th>
					</tr>
					
				<?php $i = 1;
					// var_dump($projectDetail);
					// var_dump($projectDetail);exit;
					foreach ($projectDetail as $row)
					{
						echo'<tr>
						<td>'.$i++.'</td>
						<td style="text-align: center">'.$row['pname'].'</td>
						<td style="text-align: center">'.$row['date'].'</td>
						<td style="text-align: center">'.$row['duration'].'</td>';
					}
						echo'</tr>';	
				?>
					
				</table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
		<?php } ?>
          <!-- /.Project Table -->
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
<!-- AdminLTE App -->
<script src="<?=base_url()?>style/js/adminlte.min.js"></script>
</body>
</html>
