<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Load the system's routing file first, so that the app and ENVIRONMENT can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Route halaman utama (peta sekolah)
// Halaman utama (peta sekolah)
$routes->get('/', 'HomeController::index');
$routes->post('assets/uploads', 'Assets::uploads');

// Detail sekolah (menampilkan informasi lengkap sekolah)
$routes->get('detail/(:num)', 'HomeController::detail/$1');
$routes->get('detail_rkb/(:num)', 'HomeController::detail_rkb/$1');


// Route untuk filter sekolah berdasarkan kategori (AJAX request)
$routes->get('filterSchools/(:segment)', 'HomeController::filterSchools/$1');

// Route login
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attemptLogin');

// Route logout
$routes->get('logout', 'AuthController::logout');

// Route registrasi pengguna
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::attemptRegister');

// Route admin dashboard
$routes->get('admin/dashboard', 'AdminController::dashboard', ['filter' => 'auth']);
$routes->post('admin/dashboard/changeSchool', 'AdminController::changeSchool');


// Profile
$routes->get('profile', 'ProfileController::profile');
$routes->get('school/detail/(:num)', 'SchoolController::detail/$1');
$routes->post('school/update/(:num)', 'SchoolController::update/$1');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    // Menampilkan daftar sekolah (select school)
    $routes->get('schools', 'UserController::selectSchool');

    // Menampilkan daftar user berdasarkan school_id
    $routes->get('users/index/(:num)', 'UserController::index/$1');

    // Membuat user baru (form + submit)
    $routes->get('users/create/(:num)', 'UserController::create/$1');
    $routes->post('users/store', 'UserController::store');  // Ini adalah rute POST untuk method store

    // Mengedit user (form + submit)
    $routes->get('users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('users/update/(:num)', 'UserController::update/$1');

    // Menghapus user
    $routes->get('users/delete/(:num)/(:num)', 'UserController::delete/$1/$2');
});


// $routes->get('/admin/datarkb', 'DataRKBController::index');
// $routes->get('/admin/datarkb/create', 'DataRKBController::create');
// $routes->post('/admin/datarkb/store', 'DataRKBController::store');
// $routes->get('/admin/datarkb/edit/(:num)', 'DataRKBController::edit/$1');
// $routes->post('/admin/datarkb/update/(:num)', 'DataRKBController::update/$1');

$routes->get('admin/approval', 'ApprovalController::index');
$routes->get('admin/approval/approval/(:num)', 'ApprovalController::approval/$1');
$routes->get('admin/approval/complete/(:num)', 'ApprovalController::complete/$1');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {

    // Kategori Aset Routes
    $routes->get('kategori-aset', 'DependencyController::indexKategoriAset');
    $routes->get('kategori-aset/create', 'DependencyController::createKategoriAset');
    $routes->post('kategori-aset/store', 'DependencyController::storeKategoriAset');
    $routes->get('kategori-aset/edit/(:num)', 'DependencyController::editKategoriAset/$1');
    $routes->post('kategori-aset/update/(:num)', 'DependencyController::updateKategoriAset/$1');
    $routes->get('kategori-aset/delete/(:num)', 'DependencyController::deleteKategoriAset/$1');

    // Kategori Data Routes
    $routes->get('kategori-data', 'DependencyController::indexKategoriData');
    $routes->get('kategori-data/create', 'DependencyController::createKategoriData');
    $routes->post('kategori-data/store', 'DependencyController::storeKategoriData');
    $routes->get('kategori-data/edit/(:num)', 'DependencyController::editKategoriData/$1');
    $routes->post('kategori-data/update/(:num)', 'DependencyController::updateKategoriData/$1');
    $routes->get('kategori-data/delete/(:num)', 'DependencyController::deleteKategoriData/$1');

    // Anggaran Routes
    $routes->get('anggaran', 'DependencyController::indexAnggaran');
    $routes->get('anggaran/create', 'DependencyController::createAnggaran');
    $routes->post('anggaran/store', 'DependencyController::storeAnggaran');
    $routes->get('anggaran/edit/(:num)', 'DependencyController::editAnggaran/$1');
    $routes->post('anggaran/update/(:num)', 'DependencyController::updateAnggaran/$1');
    $routes->get('anggaran/delete/(:num)', 'DependencyController::deleteAnggaran/$1');

    // Ruangan Routes
    $routes->get('ruangan', 'DependencyController::indexRuangan');
    $routes->get('ruangan/create', 'DependencyController::createRuangan');
    $routes->post('ruangan/store', 'DependencyController::storeRuangan');
    $routes->get('ruangan/edit/(:num)', 'DependencyController::editRuangan/$1');
    $routes->post('ruangan/update/(:num)', 'DependencyController::updateRuangan/$1');
    $routes->get('ruangan/delete/(:num)', 'DependencyController::deleteRuangan/$1');
});

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dataaset', 'DataAsetController::index'); // Menampilkan daftar aset
    $routes->get('dataaset/create', 'DataAsetController::create'); // Form untuk tambah data aset
    $routes->post('dataaset/store', 'DataAsetController::store'); // Menyimpan data aset baru
    $routes->get('dataaset/detail/(:num)', 'DataAsetController::detail/$1'); // Menampilkan detail data aset
    $routes->get('dataaset/edit/(:num)', 'DataAsetController::edit/$1'); // Form untuk edit aset
    $routes->post('dataaset/update/(:num)', 'DataAsetController::update/$1'); // Mengupdate kondisi aset
    $routes->post('dataaset/upload', 'DataAsetController::upload'); // Upload file aset
    $routes->get('admin/dataaset/requestRepair/(:segment)', 'DataAsetController::requestRepair/$1');
    $routes->get('admin/dataaset/requestDelete/(:segment)', 'DataAsetController::requestDelete/$1');
});

$routes->get('admin/approvals', 'ApprovalController::index');
$routes->get('admin/approvals/edit/(:num)', 'ApprovalController::edit/$1');
$routes->post('admin/approval/approve/(:num)', 'ApprovalController::approve/$1');
$routes->post('admin/approval/reject/(:num)', 'ApprovalController::reject/$1');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There may be times when you need additional routing, and you want to
 * include that here. You may modify the below to suit your needs.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
