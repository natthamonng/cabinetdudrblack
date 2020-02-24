<?php
// MODEL
namespace McDoughnut\Clinic\Model;

class BaseManager {
    protected function dbConnect(){
        $db = new \PDO('mysql:host=localhost:3308;dbname=hospitalE2N;charset=utf8', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}