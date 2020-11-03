<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		'authFilter' => \App\Filters\AuthFilter::class,
	];

	// Always applied before every request
	public $globals = [
		'before' => [
			//'honeypot'
			// 'csrf',
			'authFilter' => ['except' =>['login','logout','login-staff','login-agent','login-developer','register','forgot-password','forgot-password/*','auth/*','/','ajax/*','browse','browse/*','property-detail/*','home/*','about','contact','careers','terms-and-conditions','testimonials','policy','report','safety','find-agent','public-profile','public-profile/*']]             
		],
		'after'  => [
			'toolbar',    
			//'honeypot' 
			//'authFilter' => ['except' =>['Account/*','Ajax/*','BaseController/*','Dashboard/*','Message/*','Property/*','SellProperty/*','browse/*']] 
		], 
	]; 

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [];
}
