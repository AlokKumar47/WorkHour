<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Login

$route['Login'] = 'Login/index';
$route['LoginSubmit'] = 'Login/validation';
$route['Dashboard'] = 'Dashboard/index';
// $route['updtpass'] = 'Login/updtpass';

// Profile Management

$route['logout'] = 'Login/logout';
$route['changepass'] = 'Login/changepass';
$route['updtpass'] = 'Login/updtpass';


// User Management

$route['UserManagement'] = 'UserManagement/index';
$route['adduser'] = 'UserManagement/adduser';
$route['countproj'] = 'UserManagement/countproj';
$route['useredit'] = 'UserManagement/useredit';
$route['userupdate'] = 'UserManagement/updtuser';
$route['deluser/(:num)'] = 'UserManagement/deluser/$1';

// Role Management

$route['RoleManagement'] = 'Rolemanag/index';
$route['RoleSubmit'] = 'Rolemanag/addrole';
$route['countrole'] = 'Rolemanag/countrole';
$route['roleedit'] = 'Rolemanag/roleedit';
$route['updaterole'] = 'Rolemanag/updaterole';
$route['delrole/(:num)'] = 'Rolemanag/delrole/$1';

// Project Management

$route['ProjectManagement'] = 'Dashboard/projmanag';
$route['projmanag'] = 'Dashboard/projmanag';
$route['AddProject'] = 'Dashboard/projadd';
$route['countwork'] = 'Dashboard/countwork';
$route['projedit'] = 'Dashboard/projedit';
$route['validproj'] = 'Dashboard/validproj';
$route['closeproj'] = 'Dashboard/close';
$route['delproj/(:num)'] = 'Dashboard/delproj/$1';

// Work Management

$route['WorkManagement'] = 'Dashboard/workmanag';
$route['AddWork'] = 'Dashboard/workadd';
$route['workedit'] = 'Dashboard/workedit';
$route['validwork'] = 'Dashboard/validwork';
$route['updatework'] = 'Dashboard/updatework';
$route['delwork'] = 'Dashboard/delwork';
$route['closework'] = 'Dashboard/close';

// Export Management

$route['createEXL'] = 'Export/createEXL';
$route['pdf'] = 'Export/pdf';
