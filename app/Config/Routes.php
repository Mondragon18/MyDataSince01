<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

// LibrosController 
$routes->get('libros/listar', 'LibrosController::index');
$routes->get('libros/crear', 'LibrosController::crear');
$routes->post('libros/guardar', 'LibrosController::guardar');
$routes->get('libros/borrar/(:num)', 'LibrosController::borrar/$1');
$routes->get('libros/editar/(:num)', 'LibrosController::editar/$1');
$routes->post('libros/actualizar', 'LibrosController::actualizar');

// PaisController
$routes->get('mercadolibre/paises', 'PaisController::vue');
$routes->get('mercadolibre/paises/jquery', 'PaisController::jquerys');
$routes->get('mercadolibre/paises/listar', 'PaisController::getPaisesVue');
$routes->get('mercadolibre/paises/listar/jquery', 'PaisController::getPaisesJquery'); //Jquery

//CategoriaController vue 
$routes->get('mercadolibre/categoria/listar/(:alphanum)', 'CategoriaController::getCategorias/$1');
$routes->get('mercadolibre/categoria/detalle/listar/(:alphanum)', 'CategoriaController::getDetalleCategoria/$1');

//CategoriaController jquery 
$routes->post('mercadolibre/categoria/listar/jquery', 'CategoriaController::getCategoriasJquery');
$routes->post('mercadolibre/categoria/detalle/jquery', 'CategoriaController::getDetalleCategoriaJquery');

// ProductosController
$routes->get('mercadolibre/productos/categorias', 'ProductosController::productos');
$routes->get('mercadolibre/productos', 'ProductosController::index');
$routes->get('mercadolibre/productos/delete/(:alphanum)', 'ProductosController::deleteProducto/$1'); //elimina el producto de la base de datos y el mercado libre
$routes->get('mercadolibre/producto/listar', 'ProductosController::getListaProducto');


$routes->post('mercadolibre/productos/categorias/listar', 'ProductosController::getProductosCategorias');
$routes->get('mercadolibre/productos/categorias/atributos/(:alphanum)', 'ProductosController::getAtributosRequeridos/$1');

$routes->post('mercadolibre/productos/publicar', 'ProductosController::setProductos');

$routes->get('mercadolibre/productos/delete', 'ProductosController::deleteProducto');


$routes->get('mercadolibre/item/description/(:alphanum)', 'ProductosController::getDescription/$1');
$routes->post('mercadolibre/item/agg/(:alphanum)', 'ProductosController::setDescription/$1');
$routes->post('mercadolibre/item/update/(:alphanum)', 'ProductosController::updateDescription/$1');

