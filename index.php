<?php

class Item {
	function get() {}
	function post() {}
	function put() {}
	function delete() {}
}


// Kickstart the framework
$f3=require('lib/base.php');

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');


// MySql settings
$f3->set('DB', new DB\SQL(
	'mysql:host=localhost;port=3306;dbname=test',
	'root',
	''
));



// Load configuration
$f3->config('config.ini');

$f3->route('GET /',
	function($f3) {
		$classes=array(
			'Base'=>
				array(
					'hash',
					'json',
					'session'
				),
			'Cache'=>
				array(
					'apc',
					'memcache',
					'wincache',
					'xcache'
				),
			'DB\SQL'=>
				array(
					'pdo',
					'pdo_dblib',
					'pdo_mssql',
					'pdo_mysql',
					'pdo_odbc',
					'pdo_pgsql',
					'pdo_sqlite',
					'pdo_sqlsrv'
				),
			'DB\Jig'=>
				array('json'),
			'DB\Mongo'=>
				array(
					'json',
					'mongo'
				),
			'Auth'=>
				array('ldap','pdo'),
			'Bcrypt'=>
				array(
					'mcrypt',
					'openssl'
				),
			'Image'=>
				array('gd'),
			'Lexicon'=>
				array('iconv'),
			'SMTP'=>
				array('openssl'),
			'Web'=>
				array('curl','openssl','simplexml'),
			'Web\Geo'=>
				array('geoip','json'),
			'Web\OpenID'=>
				array('json','simplexml'),
			'Web\Pingback'=>
				array('dom','xmlrpc')
		);
		$f3->set('classes',$classes);
		$f3->set('content','welcome.htm');
		echo View::instance()->render('layout.htm');
	}
);

$f3->route('GET /userref',
	function($f3) {
		$f3->set('content','userref.htm');
		echo View::instance()->render('layout.htm');
	}
);


$f3->route('GET /login',
	function($f3) {


		$db_mapper = new \DB\SQL\Mapper($f3->get('DB'), 'users');
		$auth = new \Auth($db_mapper, array('id' => 'username', 'pw' => 'password'));

		$login_result = $auth->login('admin','secret_pwd'); // returns true on successful login
		var_dump($login_result);

		$f3->set('content','login.htm');
		echo View::instance()->render('layout.htm');
	}
);

$f3->map('/cart/@item','Item');


$f3->run();
