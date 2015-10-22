<?php


// Kickstart the framework
$f3 = require('lib/base.php');


$f3->set('DEBUG', 1);
if ((float)PCRE_VERSION < 7.9) {
    trigger_error('PCRE version is out of date');
}


// MySql settings
$f3->set(
    'DB',
    new DB\SQL(
        'mysql:host=localhost;port=3306;dbname=test',
        'root',
        ''
    )
);


$f3->set('AUTOLOAD', 'autoload/');
// Load configuration
$f3->config('config.ini');

$f3->route(
    'GET /',
    function ($f3) {
        $classes = array(
            'Base' =>
                array(
                    'hash',
                    'json',
                    'session'
                ),
            'Cache' =>
                array(
                    'apc',
                    'memcache',
                    'wincache',
                    'xcache'
                ),
            'DB\SQL' =>
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
            'DB\Jig' =>
                array('json'),
            'DB\Mongo' =>
                array(
                    'json',
                    'mongo'
                ),
            'Auth' =>
                array('ldap', 'pdo'),
            'Bcrypt' =>
                array(
                    'mcrypt',
                    'openssl'
                ),
            'Image' =>
                array('gd'),
            'Lexicon' =>
                array('iconv'),
            'SMTP' =>
                array('openssl'),
            'Web' =>
                array('curl', 'openssl', 'simplexml'),
            'Web\Geo' =>
                array('geoip', 'json'),
            'Web\OpenID' =>
                array('json', 'simplexml'),
            'Web\Pingback' =>
                array('dom', 'xmlrpc')
        );
        $f3->set('classes', $classes);
        $f3->set('content', 'welcome.htm');
        echo View::instance()->render('layout.htm');
    }
);

$f3->route(
    'GET /userref',
    function ($f3) {
        $f3->set('content', 'userref.htm');
        echo View::instance()->render('layout.htm');
    }
);


$f3->route(
    'GET /dashboard',
    function ($f3) {

        $user = new \Model\User();
        $page = new \Model\Page();

        $oggi = new DateTime();
        $user->username = "prova";
        $user->username = sha1("prova");
        $user->timestamp = $oggi->format("Y-m-d H:i:s");
        $user->save();

        $page->title = "titolo";
        $page->timestamp = $oggi->format("Y-m-d H:i:s");
        $page->author = $user;
        $page->save();

        $f3->set('footer', 'footer.html');
        $f3->set('header', 'header.html');
        $f3->set('leftBar', 'left-bar.html');
        $f3->set('rightBar', 'right-bar.html');
        $f3->set('heder', 'header.html');
        $f3->set('bodyClass', 'leftbar-view');
        $f3->set('content', 'dashboard.html');
        echo View::instance()->render('layout.html');
    }
);


$f3->route(
    'GET /login',
    function ($f3) {

        $username = $f3->get('POST.email');
        $password = $f3->get('POST.password');
        $hashedPassword = sha1($password);
        $submit = $f3->get('POST.submit');

        if (isset($submit)) {
            global $db;
            $user = new \DB\SQL\Mapper($f3->get('DB'), 'user');

            // username is email, password is password in our case
            $auth = new \Auth($user, array('id' => 'username', 'pw' => 'password'));
            $loginResult = $auth->login($username, $hashedPassword); // Cross-check with users with hashedPassword

            // Authenticated the user successfully
            if ($loginResult == true) {

                $f3->set('COOKIE.userid');
                $f3->set('SESSION.login');

            }
        } else {
            $f3->set('message', 'Please enter valid username/password');

        }

        $f3->set('bodyClass', 'login social-login');

        echo View::instance()->render('login.html');
    }
);


$f3->route(
    'POST /login',
    function ($f3) {

        $username = $f3->get('POST.email');
        $password = $f3->get('POST.password');
        $hashedPassword = sha1($password);

        global $db;
        $user = new \DB\SQL\Mapper($f3->get('DB'), 'user');

        // username is email, password is password in our case
        $auth = new \Auth($user, array('id' => 'username', 'pw' => 'password'));
        $loginResult = $auth->login($username, $hashedPassword); // Cross-check with users with hashedPassword

        // Authenticated the user successfully
        if ($loginResult == true) {

            $f3->set('COOKIE.userid');
            $f3->set('SESSION.login');
            echo "success-message";
            die();
        }
        echo "Errore login, controlla i dati inseriti e riprova.";

    }
);


$f3->map('/user/@user', 'User');


$f3->run();
