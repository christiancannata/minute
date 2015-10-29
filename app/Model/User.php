<?php
/**
 * Created by PhpStorm.
 * User: christiancannata
 * Date: 22/10/15
 * Time: 18:08
 */

namespace Model;

class User extends \DB\Cortex
{

    protected $fieldConf = array(
        'name' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'surname' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'email' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'password' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256
        ),
        'shortname' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256
        ),
        'company' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256
        ),
        'timestamp' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),
        'last_login' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),
        'pages' => array(
            'has-many' => array('\Model\Page', 'author'),
        ),
        'part_pages' => array(
            'has-many' => array('\Model\Page', 'attendees', 'page_has_attendees'),
        )

    );

    protected $db = 'DB';
    protected $table = 'user';
    protected $fluid = true;      // triggers the SQL Fluid Mode, default: false

}
