<?php
class MySQLConectar {
    private static $instance;
    private $connection;

    private function __construct() {
        $this->connection = new mysqli('localhost', 'user', 'password', 'database');
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new MySQLConectar();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
