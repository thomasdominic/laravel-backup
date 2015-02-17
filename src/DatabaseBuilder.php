<?php namespace Spatie\DatabaseBackup;

use Exception;

class DatabaseBuilder
{

    protected $database;
    protected $console;

    public function __construct()
    {
        $this->console = new Console();
    }

    public function getDatabase(array $realConfig)
    {
        try {
            $this->buildMySQL($realConfig);
        } catch (Exception $e) {
            throw new \Exception('Whoops, '.$e->getMessage());
        }

        return $this->database;
    }

    protected function buildMySQL(array $config)
    {
        $port = isset($config['port']) ? $config['port'] : 3306;

        $this->database = new Databases\MySQLDatabase(
            $this->console,
            $config['database'],
            $config['username'],
            $config['password'],
            $config['host'],
            $port
        );
    }
}
