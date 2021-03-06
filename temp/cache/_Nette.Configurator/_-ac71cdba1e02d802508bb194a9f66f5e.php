<?php //netteCache[01]000979a:2:{s:4:"time";s:21:"0.69359400 1454403147";s:9:"callbacks";a:6:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:51:"C:\wwwroot\koneahribata\shop\app\config\config.neon";i:2;i:1454401588;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:57:"C:\wwwroot\koneahribata\shop\app\config\config.local.neon";i:2;i:1454403140;}i:2;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:50:"C:\wwwroot\koneahribata\shop\libs\Nette\loader.php";i:2;i:1454401599;}i:3;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:53:"C:\wwwroot\koneahribata\shop\app\models\BaseModel.php";i:2;i:1454401588;}i:4;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:50:"C:\wwwroot\koneahribata\shop\app\models\Config.php";i:2;i:1454401588;}i:5;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:48:"C:\wwwroot\koneahribata\shop\app\models\Cart.php";i:2;i:1454401588;}}}?><?php
// source: C:\wwwroot\koneahribata\shop\app/config/config.neon development

/**
 * @property Nette\Application\Application $application
 * @property Nette\Caching\Storages\FileStorage $cacheStorage
 * @property Cart $cart
 * @property Config $config
 * @property Nette\DI\NestedAccessor $constants
 * @property Nette\DI\Container $container
 * @property Nette\Database\Connection $database
 * @property Nette\Http\Request $httpRequest
 * @property Nette\Http\Response $httpResponse
 * @property SystemContainer_nette $nette
 * @property Nette\DI\NestedAccessor $php
 * @property Nette\Application\Routers\RouteList $router
 * @property Nette\Http\Session $session
 * @property Nette\Security\User $user
 */
class SystemContainer extends Nette\DI\Container
{

	public $classes = array(
		'nette\\object' => FALSE, //: nette.cacheJournal, cacheStorage, nette.httpRequestFactory, httpRequest, httpResponse, nette.httpContext, session, nette.userStorage, user, application, router, nette.mailer, nette.database, config, cart, container,
		'nette\\caching\\storages\\ijournal' => 'nette.cacheJournal',
		'nette\\caching\\storages\\filejournal' => 'nette.cacheJournal',
		'nette\\caching\\istorage' => 'cacheStorage',
		'nette\\caching\\storages\\filestorage' => 'cacheStorage',
		'nette\\http\\requestfactory' => 'nette.httpRequestFactory',
		'nette\\http\\irequest' => 'httpRequest',
		'nette\\http\\request' => 'httpRequest',
		'nette\\http\\iresponse' => 'httpResponse',
		'nette\\http\\response' => 'httpResponse',
		'nette\\http\\context' => 'nette.httpContext',
		'nette\\http\\session' => 'session',
		'nette\\security\\iuserstorage' => 'nette.userStorage',
		'nette\\http\\userstorage' => 'nette.userStorage',
		'nette\\security\\user' => 'user',
		'nette\\application\\application' => 'application',
		'nette\\application\\ipresenterfactory' => 'nette.presenterFactory',
		'nette\\application\\presenterfactory' => 'nette.presenterFactory',
		'nette\\arraylist' => 'router',
		'traversable' => 'router',
		'iteratoraggregate' => 'router',
		'countable' => 'router',
		'arrayaccess' => 'router',
		'nette\\application\\irouter' => 'router',
		'nette\\application\\routers\\routelist' => 'router',
		'nette\\mail\\imailer' => 'nette.mailer',
		'nette\\mail\\sendmailmailer' => 'nette.mailer',
		'nette\\di\\nestedaccessor' => 'nette.database',
		'pdo' => 'nette.database.default',
		'nette\\database\\connection' => 'nette.database.default',
		'basemodel' => FALSE, //: config, cart,
		'config' => 'config',
		'cart' => 'cart',
		'nette\\freezableobject' => 'container',
		'nette\\ifreezable' => 'container',
		'nette\\di\\icontainer' => 'container',
		'nette\\di\\container' => 'container',
	);

	public $meta = array();


	public function __construct()
	{
		parent::__construct(array(
			'appDir' => 'C:\\wwwroot\\koneahribata\\shop\\app',
			'wwwDir' => 'C:/wwwroot/koneahribata/shop',
			'productionMode' => FALSE,
			'environment' => 'development',
			'consoleMode' => FALSE,
			'container' => array(
				'class' => 'SystemContainer',
				'parent' => 'Nette\\DI\\Container',
			),
			'tempDir' => 'C:\\wwwroot\\koneahribata\\shop\\app/../temp',
			'database' => array(
				'host' => 'localhost',
				'dbname' => 'shop',
				'user' => 'root',
				'password' => NULL,
				'driver' => 'mysql',
			),
		));
	}


	/**
	 * @return Nette\Application\Application
	 */
	protected function createServiceApplication()
	{
		$service = new Nette\Application\Application($this->{'nette.presenterFactory'}, $this->router, $this->httpRequest, $this->httpResponse);
		$service->catchExceptions = FALSE;
		$service->errorPresenter = NULL;
		Nette\Application\Diagnostics\RoutingPanel::initializePanel($service);
		Nette\Diagnostics\Debugger::$bar->addPanel(new Nette\Application\Diagnostics\RoutingPanel($this->router, $this->httpRequest));
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\FileStorage
	 */
	protected function createServiceCacheStorage()
	{
		$service = new Nette\Caching\Storages\FileStorage('C:\\wwwroot\\koneahribata\\shop\\app/../temp/cache', $this->{'nette.cacheJournal'});
		return $service;
	}


	/**
	 * @return Cart
	 */
	protected function createServiceCart()
	{
		$service = new Cart($this->database, $this->session);
		return $service;
	}


	/**
	 * @return Config
	 */
	protected function createServiceConfig()
	{
		$service = new Config($this->database);
		return $service;
	}


	/**
	 * @return Nette\DI\NestedAccessor
	 */
	protected function createServiceConstants()
	{
		$service = new Nette\DI\NestedAccessor($this, 'constants');
		return $service;
	}


	/**
	 * @return Nette\DI\Container
	 */
	protected function createServiceContainer()
	{
		return $this;
	}


	/**
	 * @return Nette\Database\Connection
	 */
	protected function createServiceDatabase()
	{
		$service = $this->{'nette.database.default'};
		return $service;
	}


	/**
	 * @return Nette\Http\Request
	 */
	protected function createServiceHttpRequest()
	{
		$service = $this->{'nette.httpRequestFactory'}->createHttpRequest();
		if (!$service instanceof Nette\Http\Request) {
			throw new Nette\UnexpectedValueException('Unable to create service \'httpRequest\', value returned by factory is not Nette\\Http\\Request type.');
		}
		return $service;
	}


	/**
	 * @return Nette\Http\Response
	 */
	protected function createServiceHttpResponse()
	{
		$service = new Nette\Http\Response;
		return $service;
	}


	/**
	 * @return Nette\DI\NestedAccessor
	 */
	protected function createServiceNette()
	{
		$service = new Nette\DI\NestedAccessor($this, 'nette');
		return $service;
	}


	/**
	 * @return Nette\Forms\Form
	 */
	public function createNette_basicForm()
	{
		$service = new Nette\Forms\Form;
		return $service;
	}


	/**
	 * @return Nette\Callback
	 */
	protected function createServiceNette_basicFormFactory()
	{
		$service = new Nette\Callback($this, 'createNette_basicForm');
		return $service;
	}


	/**
	 * @return Nette\Caching\Cache
	 */
	public function createNette_cache($namespace = NULL)
	{
		$service = new Nette\Caching\Cache($this->cacheStorage, $namespace);
		return $service;
	}


	/**
	 * @return Nette\Callback
	 */
	protected function createServiceNette_cacheFactory()
	{
		$service = new Nette\Callback($this, 'createNette_cache');
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\FileJournal
	 */
	protected function createServiceNette_cacheJournal()
	{
		$service = new Nette\Caching\Storages\FileJournal('C:\\wwwroot\\koneahribata\\shop\\app/../temp');
		return $service;
	}


	/**
	 * @return Nette\DI\NestedAccessor
	 */
	protected function createServiceNette_database()
	{
		$service = new Nette\DI\NestedAccessor($this, 'nette.database');
		return $service;
	}


	/**
	 * @return Nette\Database\Connection
	 */
	protected function createServiceNette_database_default()
	{
		$service = new Nette\Database\Connection('mysql:host=localhost;dbname=shop', 'root', NULL, NULL);
		$service->setCacheStorage($this->cacheStorage);
		Nette\Diagnostics\Debugger::$blueScreen->addPanel('Nette\\Database\\Diagnostics\\ConnectionPanel::renderException');
		$service->setDatabaseReflection(new Nette\Database\Reflection\DiscoveredReflection($this->cacheStorage));
		$service->onQuery[] = array(
			$this->{'nette.database.defaultConnectionPanel'},
			'logQuery',
		);
		return $service;
	}


	/**
	 * @return Nette\Database\Diagnostics\ConnectionPanel
	 */
	protected function createServiceNette_database_defaultConnectionPanel()
	{
		$service = new Nette\Database\Diagnostics\ConnectionPanel;
		$service->explain = TRUE;
		Nette\Diagnostics\Debugger::$bar->addPanel($service);
		return $service;
	}


	/**
	 * @return Nette\Http\Context
	 */
	protected function createServiceNette_httpContext()
	{
		$service = new Nette\Http\Context($this->httpRequest, $this->httpResponse);
		return $service;
	}


	/**
	 * @return Nette\Http\RequestFactory
	 */
	protected function createServiceNette_httpRequestFactory()
	{
		$service = new Nette\Http\RequestFactory;
		$service->setEncoding('UTF-8');
		return $service;
	}


	/**
	 * @return Nette\Latte\Engine
	 */
	public function createNette_latte()
	{
		$service = new Nette\Latte\Engine;
		return $service;
	}


	/**
	 * @return Nette\Callback
	 */
	protected function createServiceNette_latteFactory()
	{
		$service = new Nette\Callback($this, 'createNette_latte');
		return $service;
	}


	/**
	 * @return Nette\Mail\Message
	 */
	public function createNette_mail()
	{
		$service = new Nette\Mail\Message;
		$service->setMailer($this->{'nette.mailer'});
		return $service;
	}


	/**
	 * @return Nette\Callback
	 */
	protected function createServiceNette_mailFactory()
	{
		$service = new Nette\Callback($this, 'createNette_mail');
		return $service;
	}


	/**
	 * @return Nette\Mail\SendmailMailer
	 */
	protected function createServiceNette_mailer()
	{
		$service = new Nette\Mail\SendmailMailer;
		return $service;
	}


	/**
	 * @return Nette\Application\PresenterFactory
	 */
	protected function createServiceNette_presenterFactory()
	{
		$service = new Nette\Application\PresenterFactory('C:\\wwwroot\\koneahribata\\shop\\app', $this);
		return $service;
	}


	/**
	 * @return Nette\Templating\FileTemplate
	 */
	public function createNette_template()
	{
		$service = new Nette\Templating\FileTemplate;
		$service->registerFilter($this->createNette_latte());
		$service->registerHelperLoader('Nette\\Templating\\Helpers::loader');
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\PhpFileStorage
	 */
	protected function createServiceNette_templateCacheStorage()
	{
		$service = new Nette\Caching\Storages\PhpFileStorage('C:\\wwwroot\\koneahribata\\shop\\app/../temp/cache', $this->{'nette.cacheJournal'});
		return $service;
	}


	/**
	 * @return Nette\Callback
	 */
	protected function createServiceNette_templateFactory()
	{
		$service = new Nette\Callback($this, 'createNette_template');
		return $service;
	}


	/**
	 * @return Nette\Http\UserStorage
	 */
	protected function createServiceNette_userStorage()
	{
		$service = new Nette\Http\UserStorage($this->session);
		return $service;
	}


	/**
	 * @return Nette\DI\NestedAccessor
	 */
	protected function createServicePhp()
	{
		$service = new Nette\DI\NestedAccessor($this, 'php');
		return $service;
	}


	/**
	 * @return Nette\Application\Routers\RouteList
	 */
	protected function createServiceRouter()
	{
		$service = new Nette\Application\Routers\RouteList;
		return $service;
	}


	/**
	 * @return Nette\Http\Session
	 */
	protected function createServiceSession()
	{
		$service = new Nette\Http\Session($this->httpRequest, $this->httpResponse);
		$service->setExpiration('+ 14 days');
		return $service;
	}


	/**
	 * @return Nette\Security\User
	 */
	protected function createServiceUser()
	{
		$service = new Nette\Security\User($this->{'nette.userStorage'}, $this);
		Nette\Diagnostics\Debugger::$bar->addPanel(new Nette\Security\Diagnostics\UserPanel($service));
		return $service;
	}


	public function initialize()
	{
		date_default_timezone_set('Europe/Prague');
		Nette\Caching\Storages\FileStorage::$useDirectories = TRUE;

		$this->session->exists() && $this->session->start();
		header('X-Frame-Options: DENY');
	}

}



/**
 * @property Nette\Database\Connection $default
 * @property Nette\Database\Diagnostics\ConnectionPanel $defaultConnectionPanel
 */
class SystemContainer_nette_database
{



}



/**
 * @method Nette\Forms\Form createBasicForm()
 * @property Nette\Callback $basicFormFactory
 * @method Nette\Caching\Cache createCache()
 * @property Nette\Callback $cacheFactory
 * @property Nette\Caching\Storages\FileJournal $cacheJournal
 * @property SystemContainer_nette_database $database
 * @property Nette\Http\Context $httpContext
 * @property Nette\Http\RequestFactory $httpRequestFactory
 * @method Nette\Latte\Engine createLatte()
 * @property Nette\Callback $latteFactory
 * @method Nette\Mail\Message createMail()
 * @property Nette\Callback $mailFactory
 * @property Nette\Mail\SendmailMailer $mailer
 * @property Nette\Application\PresenterFactory $presenterFactory
 * @method Nette\Templating\FileTemplate createTemplate()
 * @property Nette\Caching\Storages\PhpFileStorage $templateCacheStorage
 * @property Nette\Callback $templateFactory
 * @property Nette\Http\UserStorage $userStorage
 */
class SystemContainer_nette
{



}
