<?php
require_once 'DAOFactory.php';
require_once 'clases/dao/postgresql/PostgreSQLVentaDAO.php';

class PostgreSQLDAOFactory extends DAOFactory {
    public function getVentaDAO() {
        return new PostgreSQLVentaDAO();
    }
}
?>
