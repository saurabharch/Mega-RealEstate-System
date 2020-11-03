<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//HOME Controller
$routes->get('/', 'Home::index');
$routes->get('buy/', 'Home::buy');
$routes->get('sell/', 'Home::sell');
$routes->get('rent/', 'Home::rent');    
$routes->get('browse/', 'Home::browse');  


//Sell Property Controller
$routes->get('sellproperty/', 'SellProperty::index');


//Auth Property Controller
$routes->get('login/', 'Auth::login');
$routes->post('login/', 'Auth::login');
$routes->get('login-agent/', 'Auth::login_agent'); 
$routes->post('login-agent/', 'Auth::login_agent'); 
$routes->get('login-developer/', 'Auth::login_developer'); 
$routes->post('login-developer/', 'Auth::login_developer'); 
$routes->get('login-staff/', 'Auth::login_staff'); 
$routes->post('login-staff/', 'Auth::login_staff'); 
$routes->get('register/', 'Auth::register');  
$routes->post('register/', 'Auth::register'); 
$routes->get('forgot-password/', 'Auth::forgot_password'); 
$routes->post('forgot-password/', 'Auth::forgot_password');   
$routes->get('logout/', 'Auth::logout');


//Account Property Controller
$routes->get('profile/', 'Account::profile');
$routes->post('profile/', 'Account::profile');
 
$routes->get('messages/', 'Account::messages');
$routes->get('notifications/', 'Account::notifications');
$routes->get('properties/', 'Account::my_properties'); 
$routes->get('favourites/', 'Account::favourites');
$routes->get('favourites/(:any)', 'Account::favourites'); 
$routes->get('messages/(:any)', 'Account::messages'); 



//Property Controller
$routes->get('add-property/(:any)', 'Property::addProperty');
$routes->post('add-property/(:any)', 'Property::addProperty');
$routes->get('add-property/', 'Property::addProperty'); 
$routes->post('add-property/', 'Property::addProperty');  
$routes->get('add-property-images/', 'Property::addPropertyImages'); 
$routes->post('add-property-images/', 'Property::addPropertyImages');
$routes->get('add-property-images/(:any)', 'Property::addPropertyImages'); 
$routes->post('add-property-images/(:any)', 'Property::addPropertyImages'); 

$routes->get('property-detail/(:any)', 'Property::index');
$routes->post('property-detail/(:any)', 'Property::index');


//Home Controller
$routes->get('about/', 'Home::about');
$routes->get('contact/', 'Home::contact');
$routes->post('contact/', 'Home::contact'); 
$routes->get('careers/', 'Home::careers');
$routes->get('terms-and-conditions/', 'Home::terms');
$routes->get('testimonials/', 'Home::testimonials');
$routes->get('policy/', 'Home::policy');
$routes->get('report/', 'Home::report'); 
$routes->get('safety/', 'Home::safety');  
$routes->get('find-agent/', 'Home::findAgent');    
$routes->get('public-profile/(:any)', 'Home::publicProfile');  
$routes->post('public-profile/(:any)', 'Home::publicProfile');  


//Dashboard Controller 
$routes->get('dashboard/', 'Dashboard::index');  


//Staff Route
$routes->group('backend', function($routes)   
{
        $routes->add('dashboard', 'Backend\Dashboard::list');
        $routes->add('properties', 'Backend\Properties::list');
        $routes->add('listing-type', 'Backend\ListingType::list');
        $routes->add('amenities', 'Backend\Amenities::list');
        $routes->add('leads', 'Backend\Leads::list');   
        $routes->add('agents', 'Backend\Agents::list'); 
        $routes->add('developers', 'Backend\Developers::list');
        $routes->add('members', 'Backend\Members::list');
        $routes->add('tickets', 'Backend\Tickets::list'); 
        $routes->add('reviews', 'Backend\Reviews::list'); 
        $routes->add('locations', 'Backend\Locations::list');
        $routes->add('country_city_state', 'Backend\Country_city_state::list');
        
        $routes->add('templates', 'Backend\Templates::index'); 
        $routes->add('templates/(:any)', 'Backend\Templates::index'); 
        
        $routes->add('statistics', 'Backend\Statistics::list');

        $routes->add('settings', 'Backend\Settings::index');    
        $routes->add('settings/index', 'Backend\Settings::index');          
}); 




/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
