<?php

// Kickstart the framework
$f3 = require('lib/base.php');

$f3->config('config.ini');





$f3->set('DEBUG', 1);
if ((float)PCRE_VERSION < 7.9) {
    trigger_error('PCRE version is out of date');
}


// MySql settings
$f3->set(
    'DB',
    new DB\SQL(
        'mysql:host='.$f3->get('DB_HOST').';port='.$f3->get('DB_PORT').';dbname='.$f3->get('DB_NAME'),
        $f3->get('DB_USER'),
        $f3->get('DB_PASSWORD')
    )
);







$f3->set('userLogged', false);

$f3->set('pusher_app_id', '150225');
$f3->set('pusher_api_key', '088902d062daa269f399');
$f3->set('pusher_app_secret', 'f173a5638c6189c3ffd4');


if (!$f3->exists('user')) {
    if ($f3->exists('COOKIE.__minuteU')) {
        $f3->set('user', json_decode(base64_decode($f3->get('COOKIE.__minuteU')), true));
        $f3->set('userLogged', true);

    }
}






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
        if ($f3->get('userLogged')) {

            $f3->set('footer', 'footer.html');
            $f3->set('header', 'header.html');
            $f3->set('leftBar', 'left-bar.html');
            $f3->set('rightBar', 'right-bar.html');
            $f3->set('heder', 'header.html');
            $f3->set('bodyClass', 'leftbar-view');
            $f3->set('content', 'dashboard.html');

            if (!$f3->exists('SESSION.__loginSent')) {


                $pusher=$f3->get('pusher');

                $params = array(
                    "name" => $f3->get('user')->username,
                    "message" => json_encode($f3->get('user')),
                );

                $pusher->trigger('private-login', 'login-success', $params, null, true);
                $f3->set('SESSION.__loginSent', true);
            }

            echo Template::instance()->render('layout.html');

        } else {
            $f3->reroute('/login');
        }

    }
);


$f3->route(
    'GET /new-board',
    function ($f3) {
        if ($f3->get('userLogged')) {


            $f3->set('footer', 'footer.html');
            $f3->set('header', 'header.html');
            $f3->set('leftBar', 'left-bar.html');
            $f3->set('rightBar', 'right-bar.html');
            $f3->set('header', 'header.html');
            $f3->set('bodyClass', 'leftbar-view');
            $f3->set('content', 'new-board.html');

            echo Template::instance()->render('layout.html');
        } else {
            $f3->reroute('/login');
        }

    }
);


$f3->route(
    'POST /new-board',
    function ($f3) {

        $user = $f3->get('user');
        $params = $f3->get("POST");

        $page = new \Model\Page();

        $topicPage = [];

        $page->title = $params['title'];
        $page->project = $params['project'];
        $page->place = $params['place'];
        $page->description = $params['description'];
        $page->others = $params['others'];
        $page->author = $user['_id'];
        $page->minuteTaker = $params['minuteTaker'];

        $now = new \DateTime();
        $page->timestamp = $now->format("Y-m-d H:i:s");

        $page->save();

        if (!empty($params['topic'])) {
            foreach ($params['topic'] as $key => $topic) {
                $topic = new \Model\Topic();

                $topic->name = $params['topic'][$key];
                $topic->type = $params['type'][$key];
                $topic->due = $params['due'][$key];
                $topic->owner = $params['owner'][$key];
                $topic->note = $params['note'][$key];
                $topic->page = $page;

                $now = new \DateTime();
                $topic->timestamp = $now->format("Y-m-d H:i:s");

                $topic->save();
            }
        }


        $pusher=$f3->get('pusher');

        $user=$f3->get('user');
        $params = array(
            "name" => $user['email'],
            "message" => json_encode($page->cast()),
        );

        $pusher->trigger('private-activity', 'crate-board', $params, null, true);


        echo json_encode(["response"=>"ok"]);

    }
);


$f3->route(
    'HEAD /connection-test',
    function ($f3) {
    }
);








$f3->route(
    'POST /pusher/auth',
    function ($f3) {

        if ($f3->get('userLogged')) {
            $pusher = new Services\Pusher(
                $f3->get('pusher_api_key'),
                $f3->get('pusher_app_secret'),
                $f3->get('pusher_app_id')
            );
            echo $pusher->socket_auth($f3->get('POST.channel_name'), $f3->get('POST.socket_id'));
        } else {
            header('', true, 403);
            echo "Forbidden";
        }

    }
);
$f3->route(
    'POST /pusher/presence-channel',
    function ($f3) {

        if ($f3->get('userLogged')) {
            $pusher = new Services\Pusher(
                $f3->get('pusher_api_key'),
                $f3->get('pusher_app_secret'),
                $f3->get('pusher_app_id')
            );
            echo $pusher->socket_auth($f3->get('POST.channel_name'), $f3->get('POST.socket_id'));
        } else {
            header('', true, 403);
            echo "Forbidden";
        }

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
        $auth = new \Auth($user, array('id' => 'email', 'pw' => 'password'));

        $loginResult = $auth->login($username, $hashedPassword); // Cross-check with users with hashedPassword

        // Authenticated the user successfully
        if ($loginResult == true) {

            $user = new \Model\User();
            $user->load(array('email = ?', $username));


            //set unlimited cookie time
            $inTwoMonths = 60 * 60 * 24 * 60 + time();
            $f3->set('COOKIE.__minuteU', base64_encode(json_encode($user->cast())), $inTwoMonths);


            echo "<div class='success-message'>Login effettuato con successo!</div>";
            die();
        }
        echo "Errore login, controlla i dati inseriti e riprova.";

    }
);

if(!$f3->exists('pusher')){
    $pusher = new \Pusher(
        $f3->get('pusher_api_key'),
        $f3->get('pusher_app_secret'),
        $f3->get('pusher_app_id'),
        array('encrypted' => true)
    );

    $f3->set('pusher',$pusher);
}

$f3->map('/user/@user', 'User');


$routing=new Routing($f3);
$routing->buildRouting();
$f3->run();
