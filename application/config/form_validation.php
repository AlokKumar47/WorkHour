<?php

$config=array(
		'login'=>array(
			array('field' => 'eid',
				'label' => 'Email ID',
				'rules' => 'required|valid_email'
			),
			array('field' => 'pass',
				'label' => 'Password',
				'rules' => 'required|min_length[8]|callback_validatepass'
			)
		),'changepass'=>array(
			array('field' => 'oldpass',
				'label' => 'Old Password',
				'rules' => 'required|min_length[8]'
			),
			array('field' => 'newpass',
				'label' => 'Password',
				'rules' => 'required|min_length[8]'
			)
		),
		'work'=>array(
			array('field' => 'selproj',
				'label' => 'Select Project',
				'rules' => 'required'
			),
			array('field' => 'wname',
				'label' => 'Work Name',
				'rules' => 'required'
			),
			array('field' => 'wdesc',
				'label' => 'Work Description',
				'rules' => 'required'
			),
			array('field' => 'hrs',
				'label' => 'Duration',
				'rules' => 'callback_checkdur'
			)
		),
		'rolename'=>array(
			array('field' => 'roletxt',
				'label' => 'Role Name',
				'rules' => 'required|callback_uniquerole'
			),
			array('field' => 'chk[]',
				'label' => 'Role Checkbox',
				'rules' => 'required'
			)
		),
		'updtrole'=>array(
			array('field' => 'roletxt',
				'label' => 'Role Title',
				'rules' => 'required'
			)
		),
		'register'=>array(
			array('field' => 'uname',
				'label' => 'User Name',
				'rules' => 'required|is_unique[login.uname]'
			),
			array('field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email|is_unique[login.email]'
			),
			array('field' => 'passs',
				'label' => 'Password',
				'rules' => 'required|min_length[8]'
			),
			array('field' => 'selrole',
				'label' => 'Role Checkbox',
				'rules' => 'required'
			),
			array('field' => 'plist[]',
				'label' => 'Project Checkbox',
				'rules' => 'required'
			)
		),
		'updtuser'=>array(
			array('field' => 'updtuname',
				'label' => 'User Name',
				'rules' => 'required'
			),
			array('field' => 'updtemail',
				'label' => 'User Email ID',
				'rules' => 'required'
			),
			array('field' => 'updtselrole',
				'label' => 'User Role',
				'rules' => 'required'
			),
		)
);
// echo "config validation";exit;
// $this->form_validation->set_rules($config);
?>