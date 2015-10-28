<?php
/**
 * Created by PhpStorm.
 * User: christiancannata
 * Date: 22/10/15
 * Time: 18:08
 */

namespace Controller;

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
