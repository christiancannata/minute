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
$f3->set('SERIALIZER', 'json');

$f3->set('userLogged', false);


if (!$f3->exists('user')) {
    if ($f3->exists('COOKIE.__minuteU')) {
        $f3->set('user', json_decode(base64_decode($f3->get('COOKIE.__minuteU')), true));
        $f3->set('userLogged', true);

    }
}


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
        if($f3->get('userLogged')){
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
        }else{
            $f3->reroute('/login');
        }

    }
);



$f3->route(
    'GET /new-board',
    function ($f3) {
        if($f3->get('userLogged')){

            $f3->set('footer', 'footer.html');
            $f3->set('header', 'header.html');
            $f3->set('leftBar', 'left-bar.html');
            $f3->set('rightBar', 'right-bar.html');
            $f3->set('heder', 'header.html');
            $f3->set('bodyClass', 'leftbar-view');
            $f3->set('content', 'new-board.html');
            echo View::instance()->render('layout.html');
        }else{
            $f3->reroute('/login');
        }

    }
);




$f3->route(
    'GET /logout',
    function ($f3) {


        $f3->clear('COOKIE.__minuteU');
        $f3->clear('user');


        $f3->set('bodyClass', 'login social-login');

        $f3->reroute('/login');
    }
);

$f3->route(
    'HEAD /connection-test',
    function ($f3) {
    }
);

$f3->route(
    'GET /login',
    function ($f3) {

        $f3->set('bodyClass', 'login social-login');

        echo View::instance()->render('login.html');
    }
);


$f3->route(
    'POST /login',
    function ($f3) {

        $username = $f3->get('POST.username');
        $password = $f3->get('POST.password');
        $hashedPassword = sha1($password);

        $user = new \DB\SQL\Mapper($f3->get('DB'), 'user');

        // username is email, password is password in our case
        $auth = new \Auth($user, array('id' => 'username', 'pw' => 'password'));

        $loginResult = $auth->login($username, $hashedPassword); // Cross-check with users with hashedPassword

        // Authenticated the user successfully
        if ($loginResult == true) {

            $user = new \Model\User();
            $user->load(array('username = ?', $username));


            //set unlimited cookie time
            $inTwoMonths = 60 * 60 * 24 * 60 + time();
            $f3->set('COOKIE.__minuteU', base64_encode(json_encode($user->cast())), $inTwoMonths);

            echo "<div class='success-message'>Login effettuato con successo!</div>";
            die();
        }
        echo "Errore login, controlla i dati inseriti e riprova.";

    }
);


$f3->map('/user/@user', 'User');


$f3->run();
