<?php
class PostgreSQLConectar {
    private static $instance;
    private $connection;

    private function __construct() {
        $this->connection = pg_connect("host=localhost dbname=database user=user password=password");
        if (!$this->connection) {
            die("Connection failed: " . pg_last_error());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new PostgreSQLConectar();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>

