<?php
/**
 * My Application bootstrap file.
 */
use Nette\Application\Routers\Route,
		Nette\Application\Routers\SimpleRouter,
		Nette\Application\Routers\RouteList;


// Load Nette Framework
require LIBS_DIR . '/Nette/loader.php';

// Configure application
$configurator = new Nette\Config\Configurator;

// Enable Nette Debugger for error visualisation & logging
//$configurator->setProductionMode(false);
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->addDirectory(LIBS_DIR)
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config/config.neon');
$container = $configurator->createContainer();

if ($container->session->exists()) {
    $session = $container->session->start();
}

// Setup router
$container->router[] = new Route('index.php', 'Front:Homepage:default', Route::ONE_WAY);

$container->router[] = $adminRouter = new RouteList("Admin");
$adminRouter[] = new Route('admin/<presenter>/<action>', "Homepage:default");

$container->router[] = $frontRouter = new RouteList("Front");
$frontRouter[] = new Route('', 'Homepage:default');
$frontRouter[] = new Route('<presenter cart|order|product|search|article|sms>[/<action>][/<id>]', 'Homepage:default');
$frontRouter[] = new Route("<id .*>", array(
    "presenter" => "Category",
    "action" => "default",
    "id" => array(
        Route::FILTER_OUT => NULL,
    ),
));


// Configure and run the application!
$container->application->run();
