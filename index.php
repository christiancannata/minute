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


$f3->set('AUTOLOAD', 'app/');

$f3->set('SERIALIZER', 'json');


$f3->set('userLogged', false);

$f3->set('pusher_app_id', '150225');
$f3->set('pusher_api_key', '088902d062daa269f399');
$f3->set('pusher_app_secret', 'f173a5638c6189c3ffd4');


if (!$f3->exists('user')) {
    if ($f3->exists('COOKIE.__minuteU')) {
        $f3->set('user', json_decode(base64_decode($f3->get('COOKIE.__minuteU')), true));
        $f3->set('userLogged', true);

    }


    $category = new \Model\Category();

    $result = $category->afind(array('company = ?', $f3->get('user')['company']), array("order" => "id desc"));

    $f3->set('meetings', $result);

}



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


                $pusher = $f3->get('pusher');

                $params = array(
                    "name" => $f3->get('user')['email'],
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
    'GET /meeting/@id',
    function ($f3) {


        if ($f3->get('userLogged')) {

            $idCategory = intval($f3->get('PARAMS.id'));

            if (is_integer($idCategory)) {

                $f3->set('footer', 'footer.html');
                $f3->set('header', 'header.html');
                $f3->set('leftBar', 'left-bar.html');
                $f3->set('rightBar', 'right-bar.html');
                $f3->set('heder', 'header.html');
                $f3->set('bodyClass', 'leftbar-view');
                $f3->set('content', 'list-category.html');


                $pages = new \Model\Page();

                $result = $pages->afind(
                    array('category = ?', $idCategory),
                    array("order" => "last_update_timestamp desc")
                );

                $f3->set('pages', $result);

                $category = new \Model\Category();

                $result = $category->load(array('id = ?', $idCategory));

                $f3->set('category', $result->cast());

                echo Template::instance()->render('layout.html');

            }


        } else {
            $f3->reroute('/login');
        }
    }
);

$f3->route(
    'GET /page/@id',
    function ($f3) {

        if ($f3->get('userLogged')) {

            $idPage = intval($f3->get('PARAMS.id'));

            if (is_integer($idPage)) {

                $f3->set('footer', 'footer.html');
                $f3->set('header', 'header.html');
                $f3->set('leftBar', 'left-bar.html');
                $f3->set('rightBar', 'right-bar.html');
                $f3->set('heder', 'header.html');
                $f3->set('bodyClass', 'leftbar-view');
                $f3->set('content', 'modify-page.html');


                $pages = new \Model\Page();

                $result = $pages->load(array('id = ?', $idPage));

                $f3->set('page', $result->cast());


                echo Template::instance()->render('layout.html');

            }


        } else {
            $f3->reroute('/login');
        }
    }
);


$f3->route(
    'POST /page/@id',
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


        $attendees = explode(",", $params['attendees']);
        $arrayAttendee = array();
        if (!empty($attendees)) {

            foreach ($attendees as $attendee) {
                $userAttendee = new \Model\User();
                $userAttendee->load();

                $arrayAttendee[] = $userAttendee->_id;
            }


        }


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


        $pusher = $f3->get('pusher');

        $user = $f3->get('user');
        $params = array(
            "name" => $user['email'],
            "message" => json_encode($page->cast()),
        );

        $pusher->trigger('private-activity', 'crate-board', $params, null, true);


        echo json_encode(["response" => "ok"]);

    }
);


$f3->route(
    'GET /',
    function ($f3) {
        if ($f3->get('userLogged')) {

            $f3->reroute('/dashboard');
        } else {
            $f3->reroute('/login');
        }

    }
);

$f3->route(
    'GET /register',
    function ($f3) {


        $f3->set('bodyClass', 'login social-login');


        echo \View::instance()->render('register.html');
    }
);

$f3->route(
    'POST /register',
    function ($f3) {

        $params = $f3->get("POST");


        $user = new \Model\User();
        $user->load(array('email = ?', $params['email']));
        if ($user->_id) {
            echo "<div class='error-message'>Account già esistente!</div>";
            die();
        }

        $now = new \DateTime();
        $user->name = $params['name'];
        $user->surname = $params['surname'];
        $user->email = $params['email'];
        $user->password = sha1($params['password']);
        $user->company = $params['company'];
        $user->shortname = strtoupper(substr($params['name'], 0, 1)."".substr($params['surname'], 0, 1));
        $user->timestamp = $now->format("Y-m-d H:i");
        $user->last_login = $now->format("Y-m-d H:i");

        $user->save();

        if ($user->_id) {

            $f3->clear('COOKIE.__minuteU');
            $f3->clear('user');

            //set unlimited cookie time
            $inTwoMonths = 60 * 60 * 24 * 60 + time();
            $f3->set('COOKIE.__minuteU', base64_encode(json_encode($user->cast())), $inTwoMonths);


            if (!$f3->exists('SESSION.__loginSent')) {


                $pusher = $f3->get('pusher');

                $params = array(
                    "name" => $f3->get('user')->email,
                    "message" => json_encode($f3->get('user')),
                );

                $pusher->trigger('private-login', 'login-success', $params, null, true);
                $f3->set('SESSION.__loginSent', true);
            }


            echo "<div class='success-message'>Registrazione effettuata!</div>";
        } else {
            echo "<div class='error-message'>Errore nella registrazione!</div>";
        }

    }
);


$f3->route(
    'GET /ajax/users.json',
    function ($f3) {
        if ($f3->get('userLogged')) {

            $users = $f3->get("DB")->exec(
                'SELECT * FROM user where name like "%'.$f3->get('GET.term').'%" or email like "%'.$f3->get(
                    'GET.term'
                ).'%" or shortname like "%'.$f3->get('GET.term').'%" or surname like "%'.$f3->get('GET.term').'%"'
            );
            $jsonUsers = array();
            foreach ($users as $user) {
                $jsonUsers[] = $user['name']." ".$user['surname']." - ".$user['shortname']." (".$user['email'].")";
            }
            echo json_encode($jsonUsers);
            die();
        } else {

        }

    }
);

$f3->route(
    'GET /new-board',
    function ($f3) {
        if ($f3->get('userLogged')) {

            $date = new \DateTime();
            $stringDate = $date->format("l, d F Y, H:i");
            $f3->set('date', $stringDate);

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


        $attendees = explode(",", $params['attendees']);


        $idAttendees=array();

        if (!empty($attendees)) {

            foreach ($attendees as $attendee) {

                $pattern = '/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,4}\b/i';
                preg_match_all($pattern, $attendee, $matches);
                if (is_array($matches) && !empty($matches) && isset($matches[0][0])) {


                    $userAttendee = new \Model\User();
                    $userAttendee->load(array("email=?", $matches[0][0]));

                    $idAttendees[]=$userAttendee;


                    //Mando la notifica ad ogni utente taggato???

                }

            }


        }


        if (!$page->attendees)
            $page->attendees = $idAttendees;


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


        $pusher = $f3->get('pusher');

        $user = $f3->get('user');
        $params = array(
            "name" => $user['email'],
            "message" => json_encode($page->cast()),
        );

        $pusher->trigger('private-activity', 'crate-board', $params, null, true);


        echo json_encode(["response" => "ok"]);

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
    'GET /login',
    function ($f3) {

        if ($f3->get('userLogged')) {
            $f3->reroute('/dashboard');
        }


        $f3->set('bodyClass', 'login social-login');

        echo \View::instance()->render('login.html');

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

            $userCast = $user->cast();
            unset($userCast['pages']);

            $f3->set('COOKIE.__minuteU', base64_encode(json_encode($userCast)), $inTwoMonths);


            echo "<div class='success-message'>Login effettuato con successo!</div>";
            die();
        }
        echo "Errore login, controlla i dati inseriti e riprova.";

    }
);


if (!$f3->exists('pusher')) {
    $pusher = new \Services\Pusher(
        $f3->get('pusher_api_key'),
        $f3->get('pusher_app_secret'),
        $f3->get('pusher_app_id'),
        array('encrypted' => true)
    );

    $f3->set('pusher', $pusher);
}

$f3->map('/user/@user', 'User');


$f3->run();
