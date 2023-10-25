<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WHM | Work Management</title>
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
  <link rel="stylesheet" href="<?=base_url()?>style/css/_all-skins.min.css"
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
        Work Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Work Management</li>
      </ol>
    </section>

<!-- Main content -->
    <section class="content">
      <div class="row">
	  
		<?php if(in_array("Add Work", $permission)){ ?>
	  
        <!-- left column -->
        <div class="col-md-7">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Work</h3>
            </div>
            <!-- /.box-header -->
			
            <!-- form start -->
            <form action="<?= base_url('AddWork')?>" id="wrkform" class="form" method="POST">
			
			  <div class="box-body">
			  <div class="text-success" style="text-align: left"><?php echo $this->session->flashdata('success'); ?></div>
                <div class="form-group">
                  <label for="proj">Select Project</label>
                  <?php echo form_dropdown('selproj', $pname, set_value('selproj'), 'class="form-control"'); ?>
				  <?php echo form_error('selproj');?>
                </div>
                <div class="form-group">
                  <label for="proj">Work Title</label>
                  <?php echo form_input(['class'=>'form-control','id'=>'wrk','placeholder'=>'Enter Work Title','name'=>'wname','value'=>set_value('wname')]); ?>
				  <?php echo form_error('wname');?>
                </div>
				<div class="form-group">
                  <label for="proj">Work Description</label>
                  <?php echo form_textarea(['class'=>'form-control','id'=>'wrkdesc','placeholder'=>'Enter Work Description','name'=>'wdesc','value'=>set_value('wdesc'),'rows'=>'3']); ?>
				  <?php echo form_error('wdesc');?>
                </div>
				<div class="form-group">
                  <label for="duration">Select Duration:</label>
					<select style="margin-left:5px" name="hrs" id="hrs">
					<?php
						foreach(range(0, 12) as $i) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					?>
					</select>&nbsp Hrs
					<select style="margin-left:5px" name="mns" id="mns">
					<?php
						foreach(range(0, 59) as $i) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					?>
					</select>&nbsp Mns<br><?php echo form_error('hrs');?>
                </div>
              </div>
              <div class="box-footer">
				<button type="submit" class="btn btn-primary btn-block" value="Submit">Submit</button>
              </div>
			  </form>
			  <!-- Form Close -->
          </div>
          <!-- /.box -->
		  <!-- Workhour Table -->
		</div>
		<?php } ?>
		
		<div class="col-md-12">
		<div class="text-success" style="text-align: left"><?php echo $this->session->flashdata('successajax'); ?></div>
		
		<?php if(in_array("View Work", $permission)){ ?>
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Workhour Table</h3>
					<a href="<?=base_url('createEXL')?>"/>
						<button class="btn btn-success">Excel 
							<span class="badge badge-light"><div><i class="fa fa-save"></i></div></span>
						</button>
					</a>
					<a href="<?=base_url('pdf')?>"/>
						<button class="btn btn-danger exportPDF">PDF
							<span class="badge badge-light"><div><i class="fa fa-save"></i></div></span>
						</button>
					</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <table class="table table-bordered"  style="text-align: center">
					<tr>
					  <th style="width: 10px">#</th>
					  <th style="text-align: center">Project</th>
					  <th style="text-align: center">Work Title</th>
					  <th style="text-align: center">Work Description</th>
					  <th style="text-align: center">Duration</th>
					<?php if(in_array("Update Work", $permission)){ ?><th style="width: 80px">Edit</th><?php } ?>
					<?php if(in_array("Delete Work", $permission)){ ?><th style="width: 80px">Delete</th><?php } ?>
					</tr>
					
					<?php $i = 1;
						// var_dump($assignwork);exit;
						foreach ($workview as $row)
						{
							echo'<tr>
							<td>'.$i++.'</td>
							<td style="text-align: center">'.$row['pname'].'</td>
							<td style="text-align: center">'.$row['work'].'</td>
							<td style="text-align: center">'.$row['description'].'</td>
							<td style="text-align: center">'.$row['duration'].'</td>';
							if(in_array("Update Work", $permission)){
								echo'<td id="'. $row['id'].'"><span class="btn btn-warning edit"><i class="fa fa-fw fa-edit"></i></span></td>';
							}
							if(in_array("Delete Work", $permission)){
								echo'<td id="'. $row['id'].'"><span class="btn btn-danger remove" ><i class="fa fa-fw fa-trash-o"></i></span></td>';
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
		</div>
		<!-- /.box -->
	  </div>
	</section>
<!-- /.Main content -->

  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('include/footer.php');?>
  
	<!-- The Modal -->
		<div class="modal fade" id="myModal">
		  <div class="modal-dialog">
			<div class="modal-content">
			<form id="upwrk_form" class="form" action="" method="POST" >
			  <!-- Modal Header -->
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Workhour Edit</h4>
			  </div>

			  <!-- Modal body -->
			  <div class="modal-body">
				<div class="form-group">
				  <label for="proj">Select Project</label>
				  <?php echo form_dropdown('updtselproj', $pname, set_value('updtselproj'), 'class="form-control" id="updtselproj"'); ?>
				  <?php echo form_error('updtselproj');?>
				</div>
				<div class="form-group">
				  <label for="proj">Work Title</label>
				  <?php echo form_input(['class'=>'form-control','id'=>'updtwname','placeholder'=>'Enter Work Title','name'=>'updtwname','value'=>set_value('updtwname')]); ?>
				  <?php echo form_error('updtwname');?>
				</div>
				<div class="form-group">
				  <label for="proj">Work Description</label>
				  <?php echo form_textarea(['class'=>'form-control','id'=>'updtwdesc','placeholder'=>'Enter Work Description','name'=>'updtwdesc','value'=>set_value('updtwdesc'),'rows'=>'3']); ?>
				  <?php echo form_error('updtwdesc');?>
				</div>
				<div class="form-group">
				  <label for="proj">Select Duration:</label>
					<select style="margin-left:5px" name="updthrs" id="updthrs">
						<option value="0">Select</option>
					<?php
						foreach(range(1, 12) as $i) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					?>
					</select>&nbsp Hrs
					<select style="margin-left:5px" name="updtmns" id="updtmns">
					<?php
						foreach(range(0, 60) as $i) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					?>
					</select>&nbsp Mns<br><?php echo form_error('updtmns');?>
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

<script >
$(document).ready(function() {
	$('.remove').click(function (){
		var id = $(this).closest('td').attr('id');
		// alert('Removing Workhour id='+id);die;
		
		var r = confirm('Are you sure to remove this record');
		if(r==true)
		{
			$.ajax(
			{
				type: "POST",
				url: "<?php echo base_url('delwork'); ?>",             
				dataType: "JSON",   //expect JSON to be returned  
				data : 
				{
					tid : id
				},
				success: function(data)
				{
					if(data.session == false){
						alert(data.message);
					}else{
						// alert(data.session);
						location.reload();
					}
				}
			});
		}
	});
	$('.close').click(function (){
		window.location.href = "<?php echo site_url('closework');?>";
	});
	$('.edit').click(function ()
	{
		var key = $(this).closest('td').attr('id');
		$(".display-error").css("display", "none");
		$.ajax(
		{
			type: "POST",
			url: "<?php echo base_url('workedit'); ?>",             
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
					$('#updtselproj').val(data.pid);
					$('#updtwname').val(data.wname);
					$('#updtwdesc').val(data.wdesc);
					$('#updthrs').val(data.hrs);
					$('#updtmns').val(data.mns);
					oldproj = $("#updt").val();
				}
			},
			error: function(jqXHR,textStatus,errorThrown)
			{
				alert(jqXHR+'-'+textStatus+'-'+errorThrown);
			}

		});
		
	}); 
	$('#update').click(function ()
	{
		var updtselproj = $("#updtselproj").val();
		var updtwname = $("#updtwname").val();
		var updtwdesc = $("#updtwdesc").val();
		var updthrs = $("#updthrs").val();
		var updtmns = $("#updtmns").val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('validwork'); ?>",
			dataType: "JSON",
			data: 
			{
				selproj : updtselproj,
				wname : updtwname,
				wdesc : updtwdesc,
				hrs : updthrs,
				mns : updtmns
			},
			success : function(data)
			{
				if(data.session == false){
					alert(data.message);
				}else{
					if (data.code == "200"){
						window.location.href = "<?php echo site_url('updatework');?>";
						// alert (data.message);
						location.reload();
					} 
					else {
						alert("Validation Unsuccessfull"+data.msg);
						$(".display-error").html("<p>"+data.msg+"</p>");
						$(".display-error").css("display","block");
					}
				}
			}
		});
	}); 
}); 
</script>
</body>
</html>
