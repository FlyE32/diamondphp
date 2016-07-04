<?php
/**
 * file: /app/code/core/system/factory.php
 * System initialization begins here
 *
 * We will use Pimple to create our services
 * and manage dependencies
 */
$app = new \Pimple\Container();

$app['router'] = function ($c) {
	return new \Hal\Core\Router('Home', $c['config']);
	// return $r->build( $rout_name, $url, $controller );
};

$app['config'] = function ($c) {
	return new \Hal\Config\Config;
};

$app['cron'] = function ($c) {
	return new \Hal\Core\Cron;
};

require_once BASE_PATH . 'app/code/core/system/paths.php';

$app['system_block'] = function ($c) {
	return new \Hal\Block\System_Block($c);
};

$app['parse'] = function ($c) {
	return new \Hal\Core\Parse($c);
};

$app['database'] = function ($c) {
	return new \Hal\Core\Database($c['config']);
};

$app['view'] = function ($c) {
	return new \Hal\Core\SystemView;
};

$app['cache'] = function ($c) {
	return new \Hal\Core\Cache;
};

$app['load'] = function ($c) {
	return new \Hal\Core\Loader($c);
};

$app['system_model'] = function ($c) {
	return new \Hal\Model\System_Model($c['database'], $c['toolbox'], $c['session'], $c['config']);
};

$app['template'] = function ($c) {
	return new \Hal\Core\Template($c, $data = NULL);
};

$app['log'] = function ($c) {
	return new \Hal\Core\Logger();
};

$app['base_controller'] = function ($c) {
	return new \Hal\Controller\Base_Controller($c);
};

/*********************
 *   Toolbox helpers
 *********************/
$app['breadcrumbs'] = function ($c) {
	$bc = new \Hal\Module\Breadcrumbs($c['router'], $c['config']);
	$bc->show();
	return $bc;
};

$app['cookie'] = function ($c) {
	return new \Hal\Core\Cookie;
};

$app['email'] = function ($c) {
	return new \Hal\Module\Email($c);
};

$app['formatter'] = function ($c) {
	return new \Hal\Module\Formatter;
};

$app['friends'] = function ($c) {
	return new \Hal\Module\Friends($c['database'], $c['toolbox'], $c['system_model']);
};

$app['geoip'] = function ($c) {
	return new \Hal\Module\Geoip($c['database']);
};

$app['hash'] = function ($c) {
	return new \Hal\Module\Hash;
};

$app['image'] = function ($c) {
	return new \Hal\Module\Image($c['config'], $c['toolbox']);
};

$app['input'] = function ($c) {
	return new \Hal\Module\Input($c['sanitize'], $c['validate']);
};

$app['memcached'] = function ($c) {
	return new Mcached;
	// return $_s->connect();
};

$app['messenger'] = function ($c) {
	return new \Hal\Module\Messenger($c['database'], $c['toolbox']);
};

$app['opcache'] = function ($c) {
	return new \Hal\Core\Opcache;
};

$app['pagination'] = function ($c) {
	return new \Hal\Module\Pagination($c);
};

$app['performance'] = function ($c) {
	return new \Hal\Module\Performance;
};

$app['sanitize'] = function ($c) {
 	return new \Hal\Module\Sanitize($c['toolbox']);
};

$app['search'] = function ($c) {
	return new \Hal\Module\Search($c['database']);
};

$app['session'] = function ($c) {
	return new \Hal\Core\Session();
};

$app['slider'] = function ($c) {
	return new \Hal\Module\Slider($c);
};

$app['title'] = function ($c) {

	$title = new \Hal\Module\Title($c['toolbox']);
	require_once MODULES_PATH . 'Titlesettings.php';
	# Pass the Titlesettings() function from the included file above to $title->set()
	$title->set(Titlesettings($c));
	return $title;
};

$app['validate'] = function ($c) {
	return new \Hal\Module\Validation;
};

$app['toolbox'] = function ($c) {
	// Used to pass the toolbox as a function parameter to other objects
	return $c;
};
