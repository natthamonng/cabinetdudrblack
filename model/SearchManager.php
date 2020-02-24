<?php
namespace McDoughnut\Clinic\Model;

require_once('BaseManager.php');

class SearchManager extends BaseManager {
    public function getPatients($keyword){
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT id, lastname, firstname FROM patients WHERE lastname LIKE :search OR firstname LIKE :search');
        $stmt->execute(array('search' => $keyword.'%'));
        
        $patients = [];

        while($data = $stmt->fetch()) {
            $patient = [
                'id' => $data['id'],
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname']
            ];

            $patients [] = $patient;
        }
        $stmt->closeCursor();

        return $patients;
    }
}