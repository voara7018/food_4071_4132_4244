<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::showlogin');
$routes->get('/register', 'User::showregister');
$routes->get('/home', 'Home::showhome');
