<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = "root";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Root Controller
$route['home'] = 'root/index';

$route['register'] = 'root/register';
$route['register_action'] = 'root/register_action';

$route['login'] = 'root/login';
$route['logout'] = 'root/logout';
$route['forgotpassword'] = 'root/forgotpassword';

$route['reset_password_user'] = 'root/reset_password_user';
/*
 *  Frontend Routes
 */
//$route['password'] = 'password/reset_password';
//$route['login'] = 'content/login';
//$route['logout'] = 'content/logout';
//$route['reset_password'] = 'content/reset_password';
//$route['profile'] = 'content/profile';
//$route['dashboard'] = 'content/dashboard';
//$route['forgotpassword'] = 'content/forgotpassword';
//$route['reset_password_user'] = 'content/reset_password_user';
//$route['reset_password_admin'] = 'content/reset_password_admin';
//$route['reset_password_partner'] = 'content/reset_password_partner';
//$route['content_management'] = 'content/content_management';
//$route['add_content'] = 'content/add_content';
//$route['update_content'] = 'content/update_content';
//$route['content_update_action'] = 'content/content_update_action';
//$route['content_add_action'] = 'content/content_add_action';

//User
$route['user_details'] = 'users/userDetails';


//Invoice
$route['invoice'] = 'invoice/invoice';
$route['add_invoice'] = 'invoice/add_invoice';



//customer
$route['customer'] = 'customer/customer';
$route['add_customer'] = 'customer/add_customer';
$route['edit_customer'] = 'customer/edit_customer';



