<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WHM | User Management</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>style/plugins/iCheck/blue.css">

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
        User Management
        <small>Work Assign</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> User Management</a></li>
        <li class="active">Work Assign</li>
      </ol>
    </section>
	<section class="content">
	  <div class="row">
	  
		<?php if(in_array("Add User", $permission)){ ?>
	  
	  <div class="col-md-7">
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Register a new member</h3>
			</div>
			
		  <div class="register-box-body">
		  <div class="text-success" style="text-align: left"><?php echo $this->session->flashdata('success'); ?></div>
			<form action="<?= base_url('adduser')?>" method="post">
			  <div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Full name" name="uname" value="<?= set_value('uname')?>">
				<span class="form-control-feedback"><i class="fa fa-fw fa-user"></i></span><?php echo form_error('uname');?>
			  </div>
			  <div class="form-group has-feedback">
				<input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email')?>">
				<span class="form-control-feedback"><i class="fa fa-fw fa-envelope-o"></i></span><?php echo form_error('email');?>
			  </div>
			  <div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" name="passs" value="<?= set_value('passs')?>">
				<span class="form-control-feedback"><i class="fa fa-fw fa-lock"></i></span><?php echo form_error('passs');?>
			  </div>
			  <div class="form-group has-feedback">
				
				<div class="form-group">
					<select name="selrole" id="selrole" class="form-control selrole">
						<option value="">Select Role to Assign</option>
						
					<?php 	for($i=0; $i<sizeof($rolelist); $i++): ?>
						<option value="<?php echo $rolelist[$i]['id']?>" <?php echo set_select('selrole',  $rolelist[$i]['id']); ?>><?php echo $rolelist[$i]['roles']?></option>';
					<?php endfor; ?>

					</select>
					
					<?php echo form_error('selrole');?>
					
				</div>
			  </div>
			  <div class="box-body col-md-12">
				<div class="form-group ">
				<label for="proj">Tick Projects to Assign</label><br>
					<div class="col-md-12">
					<?php for($i=0; $i<sizeof($projlist); $i++): ?>
					  <div class="checkbox">
						<label>
						  <input type="checkbox" name="plist[]" value="<?php echo $projlist[$i]['id']; ?>">
						  <?php echo $projlist[$i]['pname']; ?>
						</label>
					  </div>
					<?php endfor; ?>
					</div>
					  <?php echo form_error('plist[]');?>
				</div>
			  </div>
			  <div class="row">
				<div class="col-xs-8">
				  
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
				  <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
				</div>
				<!-- /.col -->
			  </div>
			</form>
		  </div>
		  <!-- /.form-box -->
		</div>
		<!-- /.register-box -->
	  </div>
		<?php } ?>
	  
	<!-- /.box -->
	<div class="col-md-8">
	<div class="text-success" style="text-align: left"><?php echo $this->session->flashdata('successajax'); ?></div>
	<?php if(in_array("View User", $permission)){ ?>
		<div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">User Table</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <table class="table table-bordered"  style="text-align: center">
				<tr>
				  <th style="width: 10px">#</th>
				  <th style="text-align: center">User</th>
				  <th style="text-align: center">Email</th>
				  <?php if(in_array("Delete User", $permission)){ ?><th style="width: 80px">Delete</th><?php } ?>
				  <?php if(in_array("Update User", $permission)){ ?><th style="width: 80px">Edit</th><?php } ?>
				</tr>
				
				<?php $sr = 1;
					for($i=0; $i<sizeof($userlist); $i++)
					{
						$id = $userlist[$i]['id'];
						$uname = $userlist[$i]['uname'];
						$email = $userlist[$i]['email'];
						
						echo'<tr>
						<td>'.$sr++.'</td>
						<td style="text-align: center">'.$uname.'</td>
						<td style="text-align: center">'.$email.'</td>';
						if(in_array("Delete User", $permission)){ 
							echo'<td id="'. $id.'"><span class="btn btn-danger remove" ><i class="fa fa-fw fa-trash-o"></i></span></td>';
						}
						if(in_array("Update User", $permission)){ 
							echo'<td id="'. $id.'"><span class="btn btn-warning edit"><i class="fa fa-fw fa-edit"></i></span></td>';
						}
						echo'</tr>';
					}
				?>
				
			  </table>
			</div>
			<!-- /.box-body -->
			
		</div>
	<?php } ?>
		  <!-- /.Workhour Table -->
		  <!-- /.box -->
	</div>
	</div>
	</section>
  </div>

</div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('include/footer.php');?>
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
  	<!-- The Modal -->
		<div class="modal fade" id="myModal">
		  <div class="modal-dialog">
			<div class="modal-content">
			<form id="upwrk_form" class="form" action="" method="POST" >
			  <!-- Modal Header -->
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">User Details Edit</h4>
			  </div>

			  <!-- Modal body -->
			  <div class="modal-body">
				<div class="form-group">
				  <label for="proj">Edit Name</label>
				  <input type="text" class="form-control" placeholder="Full name" name="updtuname" id="updtuname" value="<?= set_value('updtuname')?>">
				  <?php echo form_error('updtselproj');?>
				  <label for="proj">Edit Email</label>
				  <input type="email" class="form-control" placeholder="Email" name="updtemail" id="updtemail" value="<?= set_value('updtemail')?>">
				  <?php echo form_error('updtwname');?>
				  <!-- <label for="proj">Edit Password</label>
				  <input type="password" class="form-control" placeholder="Password" name="updtpasss" id="updtpasss" value="<?= set_value('updtpasss')?>">
					-->
					<label for="proj">Select Role to Edit</label>
					<select name="updtselrole" id="updtselrole" class="form-control selrole">
						<option value="">Select Option</option>
						<?php 	for($i=0; $i<sizeof($rolelist); $i++): ?>
							<option value="<?php echo $rolelist[$i]['id']?>"><?php echo $rolelist[$i]['roles']?></option>';
						<?php endfor; ?>
					</select>
					<?php echo form_error('updtselrole');?>
					
					<label for="proj">Tick Projects to Edit</label>
					  
						<div id="project_l"></div>
					  
					  <?php echo form_error('plist[]');?>
				</div>
			  </div>
			  <!-- Modal footer -->
			  <div class="modal-footer">
				<button type="button" class="btn btn-default pull-left close" data-dismiss="modal">Close</button>
				<span id="update" class="btn btn-primary update">Save changes</span>
			  </div>
			</form>
			</div>
		  </div>
		</div>
	<!-- /.The Modal -->

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
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>style/js/bootstrap3-wysihtml5.all.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>style/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>style/js/demo.js"></script>

<script>
$(document).ready(function() {
	$('.remove').click(function (){
		var id = $(this).closest('td').attr('id');
		
		$.ajax({
			url: "<?php echo base_url('countproj')?>",
			type: 'POST',
			dataType: "JSON",
			data: {tid:id},
			success: function(data) 
			{
				if(data.session == false){
					alert(data.message);
				}else{
					if(data.count > 0){
						alert(data.count+' Projects alloted to this user still Exist.'); 
					}else{ 
						var r = confirm('Are you sure to remove this User?');
						if(r==true)
						{
							// alert('User Deleted'); 
							window.location.href = "<?php echo site_url('deluser/');?>"+id;
						}
					}
				}
			},
			error: function(jqXHR,textStatus,errorThrown)
			{
				alert(jqXHR+'-'+textStatus+'-'+errorThrown);
			}
		});
	});
	$('.edit').click(function ()
	{	$('input:checkbox').prop('checked', false);
		var key = $(this).closest('td').attr('id');
		// alert(key);die;
		$.ajax(
		{
			type: "POST",
			url: "<?php echo base_url('useredit'); ?>",             
			dataType: "JSON",   //expect JSON to be returned  
			data : 
			{
				tid : key
			},
			success: function(data)
			{
				if(data.session == false){
					alert(data.message);
				}else{
					$('#myModal').modal('show');
					$('#updtuname').val(data.name);
					$('#updtemail').val(data.email);
					// $('#updtpasss').val(data.pass);
					$('#updtselrole').val(data.rid);
					$('#project_l').html(data.option);
				}
			},
			error: function(jqXHR,textStatus,errorThrown)
			{
				alert(jqXHR+'-'+textStatus+'-'+errorThrown);
			}

		});
	});
	$('#update').click(function (e){
		e.preventDefault();
		var updtuname = $('#updtuname').val();
		var updtemail = $('#updtemail').val();
		var updtselrole = $('#updtselrole').val();
		var plist = [];
		$('.updatechk:checked').each(function(i){
          plist[i] = $(this).val();
        });
		$.ajax(
		{
			type: "POST",
			url: "<?php echo base_url('userupdate'); ?>",             
			dataType: "JSON",   //expect JSON to be returned  
			data : 
			{
				updtuname : updtuname,
				updtemail : updtemail,
				updtselrole : updtselrole,
				plist : plist
			},
			success: function(data)
			{
				if(data.session == false){
					alert(data.message);
				}else{
					if(data.code == "200"){
						$('#myModal').modal('hide');
						// alert("Update Sucessfull");
						location.reload();
					}else if (data.code == "404"){
						alert("Updation Unsuccessfull");
					}
				}
			},
			error: function(jqXHR,textStatus,errorThrown)
			{
				alert(jqXHR+'-'+textStatus+'-'+errorThrown);
			}
		});
		// $('input:checkbox').prop('checked', false);
	});
	$('.close').click(function (){
		$('input:checkbox').prop('checked', false);
	});
});
</script>

</body>
</html>
