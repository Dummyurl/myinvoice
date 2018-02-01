<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$site_url = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https' : 'http';
$site_url .= '://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
$site_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
if ($site_url == ADMIN_PATH) {
    $route['default_controller'] = "admin_content";
} else {
    $route['default_controller'] = "root";
}
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
$route['profile'] = 'root/profile';
$route['profile_action'] = 'root/profile_action';
$route['browser_logout'] = 'root/browser_logout';
/*
 *  Frontend Routes
 */
$route['dashboard'] = 'content/dashboard';
$route['content_management'] = 'content/content_management';
$route['add_content'] = 'content/add_content';
$route['update_content'] = 'content/update_content';
$route['content_update_action'] = 'content/content_update_action';
$route['content_add_action'] = 'content/content_add_action';

//User
$route['user_details'] = 'users/userDetails';

//Invoice
$route['invoice'] = 'invoice/invoice';
$route['add_invoice'] = 'invoice/add_invoice';

//customer
$route['customer'] = 'customer/customer';
$route['add_customer'] = 'customer/add_customer';
$route['edit_customer'] = 'customer/edit_customer';

/**/
/**/
/* ADMIN MODULES */
/**/
/**/


/* ADMIN CONTENT MODULE */
$route['admin-login'] = 'admin_content/login';
$route['admin-login-action'] = 'admin_content/login_action';
$route['admin-logout'] = 'admin_content/logout';
$route['admin-profile'] = 'admin_content/profile';
$route['admin-profile-action'] = 'admin_content/profile_action';
$route['admin-forgotpassword'] = 'admin_content/forgotpassword';
$route['admin-forgotpassword-action'] = 'admin_content/forgotpassword_action';
$route['admin-reset-password-admin'] = 'admin_content/reset_password_admin';
$route['admin-reset-admin-action'] = 'admin_content/reset_admin_action';

/* ADMIN DASHBOARD MODULE */
$route['admin-dashboard'] = 'admin_dashboard/index';

/* ADMIN USER MODULE */
$route['admin-user'] = 'admin_user/index';

/* ADMIN CUSTOMER MODULE */
$route['admin-customer'] = 'admin_customer/index';

