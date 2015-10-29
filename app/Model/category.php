<?php
/**
 * Created by PhpStorm.
 * User: christiancannata
 * Date: 22/10/15
 * Time: 18:08
 */

namespace Model;

class Category extends \DB\Cortex
{

    protected $fieldConf = array(
        'name' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'timestamp' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),
        'last_update_timestamp' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),
        'pages' => array(
            'has-many' => array('\Model\Page', 'category'),
        ),

    );

    protected $db = 'DB';
    protected $table = 'category';
    protected $fluid = true;      // triggers the SQL Fluid Mode, default: false

}
