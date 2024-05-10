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
$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
 

$route['admin/dashboard'] = 'admin/Dashboard/index';
$route['admin/picture'] = 'admin/items/index';
$route['admin/item/create'] = 'admin/item/create';

$route['admin/Controller_AddSalesDocs'] = 'admin/Controller_AddSalesDocs/index';
$route['admin/Controller_AddSalesDocs/update/(:any)'] = 'admin/Controller_AddSalesDocs/ViewEdit';


$route['admin/salesdoc/create'] = 'admin/Controller_Salesdoc/create';
$route['admin/salesdoc/update'] = 'admin/Controller_Salesdoc/update';
$route['admin/salesdoc/delete'] = 'admin/Controller_Salesdoc/delete';

$route['dashboard'] = 'front/Dashboard_front/index';
$route['oem'] = 'front/Category_front/index';
$route['subcategory/(:any)'] = 'front/Category_front/SubCat';
$route['subcategorytwo/(:any)'] = 'front/Category_front/SubCatTwo';
$route['docfile/(:any)'] = 'front/Category_front/DocFile';



$route['category/categorylist'] = 'front/Categorylist_front/indexdata';

// $route['category'] = 'application/category/vbc.php';
// $route['category'] = 'application/category/oem';



