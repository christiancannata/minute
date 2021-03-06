<?php
/**
 * Created by PhpStorm.
 * User: christiancannata
 * Date: 22/10/15
 * Time: 18:08
 */

namespace Model;

class Type extends \DB\Cortex
{

    protected $fieldConf = array(
        'name' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'timestamp' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),
        'company' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256
        )
    );

    protected $db = 'DB';
    protected $table = 'type';
    protected $fluid = true;      // triggers the SQL Fluid Mode, default: false

}
