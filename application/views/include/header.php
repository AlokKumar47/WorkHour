<header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>WH</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>WorkHour</b>Management</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
			<?php if($this->session->userdata('id')): 
				$name = $this->session->userdata('uname');
			?>
			
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url()?>style/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $name?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url()?>style/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $name?>
                  <small></small>
                </p>
              </li>
              <!-- Menu Body 
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-6 text-center">
                    <a href="<?= base_url('Dashboard/projmanag')?>">Project Manag</a>
                  </div>
                  <div class="col-xs-6 text-center">
                    <a href="<?= base_url('Dashboard/workmanag')?>">Work Manag</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li>
               Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url('changepass')?>" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url('logout')?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
			<?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>