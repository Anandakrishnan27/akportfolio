<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/mypage', 'MypageController::index');
$routes->post('/mypageadd', 'MypageController::add');
// $routes->post('form-insert', [MypageController::class, 'insert']);
$routes->post('/form-insert', 'MypageController::insert');
$routes->get('/mypagecontact', 'MypageController::view');
$routes->post('/contact-list', 'MypageController::contactList');
$routes->get('get-contact/(:num)', 'MypageController::getContact/$1');
$routes->get('/webpage', 'WebsiteController::index');
$routes->get('/formadd', 'WebsiteController::formadd');

// $routes->post('/carousal/save', 'WebsiteController::save');
$routes->post('/insert-Carousal', 'WebsiteController::insertCarousal');
// $routes->get('/website', 'WebsiteController::display');