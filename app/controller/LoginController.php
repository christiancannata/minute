<?php
/**
 * Created by PhpStorm.
 * User: christiancannata
 * Date: 22/10/15
 * Time: 18:08
 */

namespace Controller;

use View;

class LoginController
{

    static function getLoginAction($f3,$args)
    {
        if ($f3->get('userLogged')) {
            $f3->reroute('/dashboard');
        }


        $f3->set('bodyClass', 'login social-login');

        echo View::instance()->render('login.html');


    }


    static function getLogoutAction($f3,$args)
    {
        $f3->clear('COOKIE.__minuteU');
        $f3->clear('user');


        $f3->set('bodyClass', 'login social-login');

        $f3->reroute('/login');


    }


    /**
     *
     * @Route(method="GET", name = "/checkUserVa")
     */

    static function checkUserEmailAction($f3,$args)
    {
        if ($f3->get('userLogged')) {
            $f3->reroute('/dashboard');
        }


        $f3->set('bodyClass', 'login social-login');

        echo View::instance()->render('login.html');


    }
}
