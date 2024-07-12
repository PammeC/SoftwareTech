<?php
require_once 'DAOFactory.php';
require_once 'clases/dao/mysql/MySQLVentaDAO.php';

class MySQLDAOFactory extends DAOFactory {
    public function getVentaDAO() {
        return new MySQLVentaDAO();
    }
}
?>
