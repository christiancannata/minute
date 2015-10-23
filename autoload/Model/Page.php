<?php
/**
 * Created by PhpStorm.
 * User: christiancannata
 * Date: 22/10/15
 * Time: 18:08
 */

namespace Model;

class Page extends \DB\Cortex
{

    protected $fieldConf = array(
        'title' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'timestamp' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),
        'author' => array(
            'belongs-to-one' => '\Model\User'
        ),
    );

    protected $db = 'DB';
    protected $table = 'page';
    protected $fluid = true;      // triggers the SQL Fluid Mode, default: false



}