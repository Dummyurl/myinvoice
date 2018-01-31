<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = "content";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* CONTENT MODULE */
$route['login'] = 'content/login';
$route['logout'] = 'content/logout';
$route['reset_password'] = 'content/reset_password';
$route['profile'] = 'content/profile';
$route['forgotpassword'] = 'content/forgotpassword';
$route['reset_password_user'] = 'content/reset_password_user';
$route['reset_password_admin'] = 'content/reset_password_admin';
$route['reset_password_partner'] = 'content/reset_password_partner';

/* DASHBOARD MODULE */
$route['dashboard'] = 'dashboard/index';

/* USER MODULE */
$route['user'] = 'user/index';

/* CUSTOMER MODULE */
$route['customer'] = 'customer/index';