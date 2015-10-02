<?php

/**
 * Class Config
 */
class Config
{
    /**
     * @var array
     */
    private $config;

    function __construct()
    {
        $this->config = array();

        $this->config['db_hostname'] = 'localhost';
        $this->config['db_database'] = 'destinia';
        $this->config['db_username'] = 'root';
        $this->config['db_password'] = 'destinia';
    }

    public function getParameter($key)
    {
        return $this->config[$key];
    }
}