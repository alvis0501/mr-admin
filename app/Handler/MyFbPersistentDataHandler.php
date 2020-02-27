<?php
namespace App\Handler;

/**
 * Created by PhpStorm.
 * User: rwunhyok-note
 * Date: 7/14/2017
 * Time: 8:14 PM
 */

use Facebook\PersistentData\PersistentDataInterface;

class MyFbPersistentDataHandler implements PersistentDataInterface
{
    private $_session = null;

    public function __construct($session)
    {
        $this->_session = $session;
    }


    public function get($key)
    {
        return $this->_session->get($key);
    }

    public function set($key, $value)
    {
        $this->_session->put($key, $value);
    }
}