<p align="center" id="logo">
	<img src="https://laravel.com/assets/img/components/logo-laravel.svg" style="margin-bottom:-17px"> 
	<a id="swagger" href="http://userservice.staging.tangentmicroservices.com/api-explorer/" style="font-size: 1.5em;
    font-weight: bold;
    text-decoration: none;
    background: transparent url(http://projectservice.staging.tangentmicroservices.com/static/rest_framework_swagger/images/logo_small.png) no-repeat left center;
    padding: 20px 0 20px 40px;
    color: #2e2e2e;
	font-family: "Droid Sans", sans-serif;
	font-size: 2.2em;">Swagger</a> 
</p>
	

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


## Prerequisites

Following Dependancy Managers used to install application, you need all of them for development purpose

<ul>
	<li><a href="http://php.net/downloads.php">PHP version 5.6.28</a></li>
	<li><a href="https://getcomposer.org/download/">Composer version 1.2.1</a></li>
	<li><a href="https://laravel.com/docs/5.3">Laravel version 5.3</a></li>
	<li><a href="https://laravel.com/docs/5.3">NPM version 3.10.8</a></li>
</ul>

## Dependencies added

<ul>
	<li><a href="https://docs.npmjs.com/getting-started/installing-node">Node JS version 6.9.1</a></li>
	<li><a href="http://getbootstrap.com/getting-started/">Bootstrap version 4</a></li>
</ul>

## Fastrack Environment installation / configuration / update
<ul>
	<li><a href="https://github.com/PhillipOdendaal/Lara_v53/blob/master/_support/readme.md">Quick Guide</a></li>
</ul>

Remember, when you do composer updates, you need to run GULP - tasks again NB!
<ul>
	<li>composer update</li>
	<li>gulp watch</li>
</ul>

## Environment configuration

[1] Configure Env
<ul>
	<li>Update Config Variables</li>
	<li>../.env</li>
	<li>../config/database.php</li>
</ul>
	
[2] Run Migration to create tables
<ul>
	<li> Run Laravel Database Migrations
		<ul>
			<li>php artisan migrate</li>
		</ul>
	</li>
	<li> Optionaly seeds to the tables with content
		<ul>
			<li>php artisan db:seed</li>
		</ul>
	</li>
	<li> Other Migration Commands
		<ul>
			<li>php artisan make:migration create_users_table</li>
			<li>php artisan make:migration create_users_table --create=users</li>
			<li>php artisan migrate:rollback</li>
			<li>php artisan migrate:refresh --seed</li>
		</ul>
	</li>
</ul>

[3] Confirm Application routes and auth

<ul>
	<li> php artisan route:list	</li>
</ul>

[4] Start the Application

<ul>
	<li> php artisan serve --port:8080	</li>
</ul>

## Provisioning scripts
	Add
	
## Documentation Links

Update NPM & NODE for GULP - Elixer

<ul>
	<li><a href="https://github.com/PhillipOdendaal/Lara_v53/blob/master/_support/readme.md">Gulp for Laravel Elixer support</a></li>
	<li><a href="https://medium.com/@tadaspaplauskas/using-bootstrap-4-with-laravel-5-3-8d4efb8b82bf#.kcx61k29t">Bootstrap</a></li>
	<li><a href="http://getbootstrap.com/getting-started/">Get Bootstrap</a></li>
	<li><a href="http://bootstrapdocs.com/v2.0.2/docs/">Bootstrap Documentation</a></li>
</ul>

