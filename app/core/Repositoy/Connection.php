<?php
namespace core;
use Pixie\QueryBuilder\QueryBuilderHandler;

class Connection
{
    private $config = array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'zpg',
        'username'  => 'root',
        'password'  => '',
    );

    private $adapter;
    private $connection;

    public function __construct()
    {
        $this->adapter = new \Pixie\Connection('mysql', $this->config, 'Connection');
    }

    public function getConnection()
    {
        try {
            $this->connection = new QueryBuilderHandler($this->adapter);
        } catch (\Exception $exception) {
            $this->connection = false;
        }

        return $this->connection;
    }
}