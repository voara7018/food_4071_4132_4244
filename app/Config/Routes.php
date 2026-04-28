<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::showlogin');
$routes->post('/login', 'User::loginUser');
$routes->get('/register', 'User::showregister');
$routes->post('/register', 'User::insertUser');
$routes->get('/home', 'Home::showhome');
