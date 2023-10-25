<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
		<?php $target = array('View Role', 'Add Role', 'Update Role', 'Delete Role');
			if(count(array_intersect($permission, $target)) > 0){ ?>
		<li>
			<a href="<?= base_url('RoleManagement')?>">
            <i class="fa fa-edit"></i> <span>Role Management</span>
          </a>
        <!--  <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i>Add</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Update</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Delete</a></li>
          </ul>-->
		</li>
		<?php } ?>
		<?php $target = array('View User', 'Add User', 'Update User', 'Delete User');
			if(count(array_intersect($permission, $target)) > 0){ ?>
		<li>
			<a href="<?= base_url('UserManagement')?>">
            <i class="fa fa-laptop"></i> <span>User Management</span>
          </a>
        <!--  <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i>Add</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Update</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Delete</a></li>
          </ul>-->
		</li>
		<?php } ?>
		<?php $target = array('View Project', 'Add Project', 'Update Project', 'Delete Project');
			if(count(array_intersect($permission, $target)) > 0){ ?>
        <li>
          <a href="<?= base_url('ProjectManagement')?>">
            <i class="fa fa-folder-open"></i> <span>Project Management</span>
          </a>
        <!--  <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i>Add</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Update</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Delete</a></li>
          </ul>-->
        </li>
		<?php } ?>
		<?php $target = array('View Work', 'Add Work', 'Update Work', 'Delete Work');
			if(count(array_intersect($permission, $target)) > 0){ ?>
        <li>
          <a href="<?= base_url('WorkManagement')?>">
            <i class="fa fa-book"></i> <span>Work Management</span>
          </a>
        <!--  <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> Add</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Update</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Delete</a></li>
          </ul>-->
        </li>
		<?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>