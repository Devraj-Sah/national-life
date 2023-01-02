<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "premium";

$route['404_override'] = '';



$route['premium-calculator'] = 'premium/index';
$route['policy-detail'] = 'premium/selectPolicyById';
$route['calculate'] = 'premium/calculatePremium';


$route['admin-reg.html'] = 'admin_authenticate/registerAdmin';
$route['admin-login.html'] = 'admin_authenticate/adminLogin';
$route['admin-logout.html'] = 'admin_authenticate/adminLogout';
$route['change-password'] = 'admin_authenticate/changePassword';
$route['change-email'] = 'admin_authenticate/changeEmail';
$route['recover-password'] = 'admin_authenticate/recoverPass';

$route['admin.html'] = 'admin/index';
$route['create-policy'] = 'admin/createPolicy';
$route['view/(:any)'] = 'admin/viewPolicyById';
$route['edit/(:any)'] = 'admin/editPolicyById';
$route['total-perm-dis-rate/(:any)'] = 'admin/setTotalPermDis';
$route['wop/(:any)'] = 'admin/setWOP';
$route['adb/(:any)'] = 'admin/setADB';
$route['rebate/(:any)'] = 'admin/setRebate';
$route['payment-interval-rate/(:any)'] = 'admin/setPaymentIntervalRate';
$route['payment-interval-option/(:any)'] = 'admin/setPaymentIntervalOption';
$route['set-age-other/(:any)'] = 'admin/setAgeOther';
$route['set-policy-term/(:any)'] = 'admin/setPolicyTerm';
$route['upload-rate/(:any)'] = 'admin/uploadRate';
$route['upload-policy-rider-rate/(:any)'] = 'admin/uploadPolicyRiderRate';
$route['upload-policy-rate-term-life-additional/(:any)'] = 'admin/uploadPolicyRateTermLifeAdditional';
$route['activate-policy/(:any)'] = 'admin/activatePolicy';
$route['deactivate-policy/(:any)'] = 'admin/activatePolicy';
$route['delete-policy/(:any)'] = 'admin/deletePolicy';



//$route['premium-calculate.html'] = 'premium/index';
//$route['reg.html'] = 'admin_authenticate/registerAdmin';

//$route['p.html'] = 'premium/abc';


/* End of file routes.php */
/* Location: ./application/config/routes.php */