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
  <title>WHM | Project Management</title>
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
        Project Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Project Management</li>
      </ol>
    </section>
	
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
		
		<?php if(in_array("Add Project", $permission)){ ?>
		
        <div class="col-md-7">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Project</h3>
            </div>
            <!-- /.box-header -->
				
            <!-- form start -->
            <form action="<?= base_url('AddProject')?>" method="POST" id="projForm" class="form">
              <div class="box-body">
			  <div class="text-success" style="text-align: left"><?php echo $this->session->flashdata('success'); ?></div>
                <div class="form-group">
                  <label for="proj">Project Name</label>
                  <?php echo form_input(['class'=>'form-control','id'=>'proj','placeholder'=>'Enter Project Name','name'=>'pname']); ?>
				  <?php echo form_error('pname');?>
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
		
		  <!-- Project Table -->
		<?php if(in_array("View Project", $permission)){ ?>
		<div class="col-md-7">
		
		<div class="text-success" style="text-align: left"><?php echo $this->session->flashdata('successajax'); ?></div>
		  
		  <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Project Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<table class="table table-bordered"  style="text-align: center">
					<tr>
					  <th style="width: 10px">#</th>
					  <th style="text-align: center">Project</th>
					  <?php if(!empty($assignproj) && in_array("Delete Project", $permission)){ ?><th style="width: 80px">Delete</th><?php } ?>
					  <?php if(!empty($assignproj) && in_array("Update Project", $permission)){ ?><th style="width: 80px">Edit</th><?php } ?>
					</tr>
					
				<?php // $projview = $this->db->get('project');
					$i = 1;// 
					// var_dump($assignproj);
					// var_dump($permission);exit;
					foreach ($projview as $row)
					{
						echo'<tr>
						<td>'.$i++.'</td>
						<td style="text-align: center">'.$row['pname'].'</td>';
					if(!empty($assignproj) && in_array("Delete Project", $permission)){ 
						if(in_array($row['id'], $assignproj) && in_array("Delete Project", $permission)){
							echo'<td id="'. $row['id'].'"><span class="btn btn-danger remove" ><i class="fa fa-fw fa-trash-o"></i></span></td>';
						}else{echo"<td></td>";}
					}
					if(!empty($assignproj) && in_array("Update Project", $permission)){
						if(in_array($row['id'], $assignproj) && in_array("Update Project", $permission)){
							echo'<td id="'. $row['id'].'"><span class="btn btn-warning edit"><i class="fa fa-fw fa-edit"></i></span></td>';
						}else{echo"<td></td>";}
					}
						echo'</tr>';
					}
				?>
					
				</table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
		<?php } ?>
          <!-- /.Project Table -->
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
<!-- The Modal -->
<div class="modal modal-default fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	<form action="" id="up_form" class="form-horizontal" method="POST">
	  <!-- Modal Header -->
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Project Edit</h4>
	  </div>
	  <!-- Modal body -->
	  <div class="modal-body">
		<label for="proj">Project Name</label>
		<?php echo form_input(['class'=>'form-control', 'id'=>'updt','placeholder'=>'Enter Project Name','name'=>'updt','value'=>set_value('updt')]); ?>
		<p class="alert alert-danger display-error" style="display: none"></p>
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
<!-- Delete JS -->
<script >
$(document).ready(function() {
   var oldproj;
	$('.remove').click(function (){
		var id = $(this).closest('td').attr('id');
		
		$.ajax(
		{
			url: '<?php echo base_url('countwork'); ?>',
			type: 'POST',
			dataType: "JSON",
			data: {id:id},
			success: function(data) 
			{
				if(data.session == false){
					alert(data.message);
				}else{
					if(data.count > 0){
						alert('Workhour related to this Project still Exist.'); 
					}else{
						var r = confirm('Are you sure to remove this Project?');
						if(r==true)
						{
							// alert('Project deleted');
							window.location.href = "<?php echo site_url('delproj/');?>"+id;
						}
					}
				}
			},
			error: function(jqXHR,textStatus,errorThrown)
			{
				alert(jqXHR+'-'+textStatus+'-'+errorThrown);
				die;
			}
		});
		
	});
	$('.close').click(function (){
		window.location.href = "<?php echo site_url('closeproj');?>";
	});
	$('.edit').click(function ()
	{
		var key = $(this).closest('td').attr('id');
		$(".display-error").css("display", "none");
		$.ajax(
		{
			type: "POST",
			url: "<?php echo base_url('projedit'); ?>",             
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
					$('#updt').val(data.name);
					oldproj = $("#updt").val();
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
		
		var name = $("#updt").val();
		var oldname = oldproj;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('validproj'); ?>",
			dataType: "JSON",
			data: 
			{
				name : name,
				oldname : oldname
			},
			success : function(data)
			{
				if(data.session == false){
					alert(data.message);
				}else{
					if (data.code == "200"){
						// alert(data.msg);
						$('#myModal').modal('hide');
						location.reload();
					} else {
						alert(data.msg);
					}
				}
			}
		});
	}); 
}); 
</script>
</body>
</html>
