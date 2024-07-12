<?php
abstract class DAOFactory {
    abstract public function getVentaDAO();

    public static function getDAOFactory($type) {
        switch ($type) {
            case 'mysql':
                require_once 'MySQLDAOFactory.php';
                return new MySQLDAOFactory();
            case 'postgresql':
                require_once 'PostgreSQLDAOFactory.php';
                return new PostgreSQLDAOFactory();
            default:
                throw new Exception('No se encontró la fábrica adecuada.');
        }
    }
}
?>
