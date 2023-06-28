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

| When you set this option to TRUE, it will replace ALL dashes with

| underscores in the controller and method URI segments.

|

| Examples:	my-controller/index	-> my_controller/index

|		my-controller/my-method	-> my_controller/my_method

*/

$route['default_controller'] = "index";

$route['404_override'] = 'my404';

$route['translate_uri_dashes'] = FALSE;





// Front 

$route['call_api']  = 'index/call_api';
$route['call_api_list']  = 'index/call_api_list';
$route['privacy-policy']  = 'privacy_policy';

$route['refund-policy'] = 'refund_policy';

$route['terms-of-use'] = 'terms_of_use';

$route['cookies-policy'] = 'cookies_policy';
$route['contact-us'] = 'contact';
$route['software-principles'] = 'softwareprinciples';

$route['driver-install'] = 'installation';

$route['driver_installation'] = 'driver_installation_instruction';
// for download and instruction (Both)
$route['driver-installation-instructions'] = 'driver_installation_instruction/downloadlink';
// this is only trial download
$route['trial-driver-download'] = 'driver_installation_instruction/downloadlink';
$route['try-now'] = 'driver_installation_instruction/trynow';

$route['after-install'] = 'after_install';

$route['after-uninstall'] = 'after_uninstall';

$route['uninstall/feedback'] = 'feedback';//'uninstallinstructions';    //'feedback';

$route['uninstall-instructions'] = 'uninstallinstructions';

$route['welcome'] = 'index/thanksforinstall';

$route['buy-now'] = 'cart';
$route['index-2'] = 'index/v1';
$route['hp-printer-driver'] = 'index/printerdriver';
$route['canon-printer-driver'] = 'index/canonprinterdriver';
$route['epson-printer-driver'] = 'index/epsonprinterdriver';
$route['brother-printer-driver'] = 'index/brotherprinterdriver';

$route['download-printer-driver'] = 'download/printerdriver';
$route['download-sound-driver'] = 'download/audiodriver';
$route['download-system-driver'] = 'download/systemdriver';
$route['download/(:any)'] = 'download/index/$1';
$route['customer-portal/(:any)'] = 'customerportal/index/$1';
$route['customer-login'] = 'login';

$route['download-hp-printer-driver'] = 'download/downloadhpdriver';
$route['download-canon-printer-driver'] = 'download/downloadcanondriver';
$route['download-epson-printer-driver'] = 'download/downloadepsondriver';
$route['download-brother-printer-driver'] = 'download/downloadbrotherdriver';



$route['download-printer-driver'] = 'eula/download_printer_driver';

$route['download-sound-driver'] = 'eula/download_sound_driver';

$route['download-system-driver'] = 'eula/download_system_driver';

$route['download-usb-driver'] = 'eula/download_usb_driver';

$route['download-hardware-driver'] = 'eula/download_hardware_driver';


$route['products/driver-pc-cleaner'] = 'products/driver_pc_cleaner';

$route['products/driver-updater'] = 'products/driver_updater';

$route['video/drivers'] = 'index';


// single page for landing page PPC
//$route['driver-updater/download-now'] = 'singlelandingpage';




//$route['front/login/resetPasswordConfirmUser/(:any)'] = 'front/login/resetPasswordConfirmUser/$1';

$route['admin'] = 'admin/dashboard';



// Service supp

$route['product/(:num)/(:num)'] = 'product_list/get_product_list/$1/$1';

$route['shop'] = 'product_list/get_product_list';



$route['time-closed'] = 'timeclosed';

