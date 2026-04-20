<?php
namespace Core;

abstract class EkaModel {
    protected \PDO $db;

    public function __construct() {
        $this->db = EkaDatabase::getConnection();
    }
}
