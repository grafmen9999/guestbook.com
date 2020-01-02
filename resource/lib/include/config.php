<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/Singleton.php");

class Config extends Singleton
{
    private $config = [];

    protected function __construct() {
        $this->setConfig('db', array(
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'dbname' => 'guestbook_db',
            'charset' => 'utf8',
        ));
    }

    public function setConfig($title, $obj)
    {
        $this->config[$title] = $obj;
    }

    public function getConfig($title)
    {
        return $this->config[$title];
    }
}