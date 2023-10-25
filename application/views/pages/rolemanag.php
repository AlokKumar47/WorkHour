<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WHM | Registration Page</title>
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
        Role Management
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Role Management</a></li>
        <li class="active"></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
		
		<?php if(in_array("Add Role", $permission)){ ?>
		
		  <div class="col-md-5">
		  <!-- general form elements -->
			  <div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Role</h3>
				</div>
				<!-- /.box-header -->
				
				<!-- form start -->
				<form action="<?= base_url('RoleSubmit')?>" method="POST" id="roleForm" class="form">
				  <div class="box-body col-md-12">
				  <div class="text-success" style="text-align: left"><?php echo $this->session->flashdata('success'); ?></div>
					<div class="form-group">
					  <label for="proj">Role Name</label>
					  <input type="text" class="form-control" placeholder="Enter Role Name" name="roletxt" value="<?= set_value('roletxt')?>">
					  <?php echo form_error('roletxt');?>
					</div>
				  </div>
				  <div class="box-body col-md-12">
					<div class="form-group ">
					<label for="proj">Check Role</label><br>
						<div class="col-md-12">
						<?php for($i=0; $i<sizeof($permlist); $i++): ?>
						  <div class="checkbox">
							<label>
							  <input type="checkbox" name="chk[]" value="<?php echo $permlist[$i]; ?>">
							  <?php echo $permlist[$i]; ?>
							</label>
						  </div>
						<?php endfor; ?>
						</div>
						<div class="col-md-5">
						  <?php echo form_error('chk[]');?>
						</div>
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
		<?php } ?>
			
			<!-- /.box -->
			<div class="col-md-6">
			<div class="text-success" style="text-align: left"><?php echo $this->session->flashdata('successajax'); ?></div>
			<?php if(in_array("View Role", $permission)){ ?>
				<div class="box">
					<div class="box-header with-border">
					  <h3 class="box-title">Role Table</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					  <table class="table table-bordered"  style="text-align: center">
						<tr>
						  <th style="width: 10px">#</th>
						  <th style="text-align: center">Role</th>
						  <?php if(in_array("Delete Role", $permission)){ ?><th style="width: 80px">Delete</th><?php } ?>
						  <?php if(in_array("Update Role", $permission)){ ?><th style="width: 80px">Edit</th><?php } ?>
						</tr>
						
						<?php 
							$this->db->order_by('roles');
							$rolelist = $this->db->get('role');
						
						// $query = $this->db->get('workhour');
							$i = 1;
							foreach ($rolelist->result() as $row)
							{
								$roles = $row->roles;
								
								echo'<tr>
								<td>'.$i++.'</td>
								<td style="text-align: center">'.$roles.'</td>';
								if(in_array("Delete Role", $permission)){
									echo'<td id="'. $row->id.'"><span class="btn btn-danger remove" ><i class="fa fa-fw fa-trash-o"></i></span></td>';
								}
								if(in_array("Update Role", $permission)){
									echo '<td id="'. $row->id.'"><span class="btn btn-warning edit"><i class="fa fa-fw fa-edit"></i></span></td>';
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

	<!-- The Modal -->
	<div class="modal fade" id="myModal">
	  <div class="modal-dialog">
		<div class="modal-content">
		<form id="uprole_form" class="form" action="" method="POST" >
		  <!-- Modal Header -->
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Role Edit</h4>
		  </div>
		
		  <!-- Modal body -->
		  <div class="modal-body">
			<div class="form-group">
			  <label for="proj">Role Title</label>
			  <input type="text" class="form-control" id="updtroletxt" name="updtroletxt" value="<?= set_value('updtroletxt')?>">
				<?php echo form_error('updtroletxt');?>
				
				<br><label for="role">Check Role</label><br>
				<?php for($i=0; $i<sizeof($permlist); $i++): ?>
				  <div class="checkbox" id="test">
					<label>
					  <input type="checkbox" name="upchk[]" class="updatechk" value="<?php echo $permlist[$i];?>">
					  <?php echo $permlist[$i]; ?>
					</label>
				  </div>
				<?php endfor; ?>
				<?php echo form_error('upchk[]');?>
			</div>
		  </div>
		
		  <!-- Modal footer -->
		  <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left close" data-dismiss="modal">Close</button>
			<button type="submit" id="update" class="btn btn-primary update">Save changes</button>
		  </div>
		</form>
		</div>
	  </div>
	</div>
<!-- /.The Modal -->



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

<script>
$(document).ready(function() {
	$('.remove').click(function (){
		var id = $(this).closest('td').attr('id');
		
		$.ajax({
			url: "<?php echo base_url('countrole')?>",
			type: 'POST',
			dataType: "JSON",
			data: {id:id},
			success: function(data) 
			{
				if(data.session == false){
					alert(data.message);
				}else{
					if(data.count > 0){
						alert(data.count+' User are alloted this Role.');
					}else{
						var r = confirm('Are you sure to remove this Role?');
						if(r==true)
						{
							// alert('Role Deleted'); 
							window.location.href = "<?php echo site_url('delrole/');?>"+id;
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
		// $.session.set("updtid", key);
		$.ajax(
		{
			type: "POST",
			url: "<?php echo base_url('roleedit'); ?>",             
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
					$('#updtroletxt').val(data.role);
					
					$.each(data, function(i, val){
					   $("#test input[value='" + val + "']").prop('checked', true);
					});
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
		var roletxt = $('#updtroletxt').val();
		var upchk = [];
		$('.updatechk:checked').each(function(i){
          upchk[i] = $(this).val();
        });
		$.ajax(
		{
			type: "POST",
			url: "<?php echo base_url('updaterole'); ?>",             
			dataType: "JSON",   //expect JSON to be returned  
			data : 
			{
				roletxt : roletxt,
				upchk : upchk
			},
			success: function(data)
			{
				if(data.session == false){
					alert(data.message);
				}else{
					if (data.code == "200"){
						$('#myModal').modal('hide');
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
