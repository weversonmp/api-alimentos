<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Foods REST
$routes->get('foods', 'Foods::list');
$routes->post('foods/create', 'Foods::create');
