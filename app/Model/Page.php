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
        'project' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'date' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'place' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'others' => array(
            'type' => \DB\SQL\Schema::DT_TEXT,
            'nullable' => false,
        ),
        'description' => array(
            'type' => \DB\SQL\Schema::DT_TEXT,
            'nullable' => false,
        ),
        'minuteTaker' => array(
            'type' => \DB\SQL\Schema::DT_VARCHAR256,
            'nullable' => false,
        ),
        'timestamp' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),
        'last_update_timestamp' => array(
            'type' => \DB\SQL\Schema::DT_DATETIME
        ),
        'author' => array(
            'belongs-to-one' => '\Model\User'
        ),
        'topics' => array(
            'has-many' => array('\Model\Topic', 'page'),
        ),
        'category' => array(
            'belongs-to-one' => '\Model\Category'
        ),
        'attendees' => array(
            'has-many' => array('\Model\User', 'part_pages', 'page_has_attendees'),
        )

    );

    protected $db = 'DB';
    protected $table = 'page';
    protected $fluid = true;      // triggers the SQL Fluid Mode, default: false





}
