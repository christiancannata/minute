<?php
/**
 * Created by PhpStorm.
 * User: christiancannata
 * Date: 22/10/15
 * Time: 18:08
 */

namespace Model;

class Topic extends \DB\Cortex
{

    protected $fieldConf = array(
        'name' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'timestamp' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),
        'owner' => array(
            'belongs-to-one' => '\Model\User'
        ),
        'page' => array(
            'belongs-to-one' => '\Model\Page'
        ),
        'type' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'note' => array(
            'type' => \DB\SQL\Schema::DT_TEXT,
            'nullable' => true,
        ),
        'due' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),

    );

    protected $db = 'DB';
    protected $table = 'topic';
    protected $fluid = true;      // triggers the SQL Fluid Mode, default: false


}
