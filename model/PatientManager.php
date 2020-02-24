<?php
namespace McDoughnut\Clinic\Model;

require_once('BaseManager.php');

class PatientManager extends BaseManager {
    public function getPatients(){
        $db = $this->dbConnect();
        $stmt = $db->query('SELECT id, lastname, firstname FROM patients');
    
        $data = $stmt->fetchAll();
        $stmt->closeCursor();

        return $data;
    }

    public function getPatient($id) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT * FROM patients WHERE id = ?'); 
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $patient = $stmt->fetch();
    
        return $patient;
    }

    public function postPatient($lastname, $firstname, $birthdate, $phone, $mail) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)');
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':mail', $mail);
        $newPatient = $stmt->execute();

        return $newPatient;
    }

    public function updatePatient($lastname, $firstname, $birthdate, $phone, $mail, $id) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('UPDATE patients SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, phone = :phone, mail = :mail WHERE id = :id'); 
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':id', $id);
        $updatedPatient = $stmt->execute();

        return $updatedPatient;
    }

    public function deletePatient($id) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('DELETE patients FROM patients INNER JOIN appointments ON patients.id = appointments.idPatients WHERE appointments.idPatients = ?'); 
        $stmt->bindParam(1, $id);
        $deletedPatient = $stmt->execute();

        return $deletedPatient;
    }

    public function patientsRowCount() {
        $db = $this->dbConnect();
        $patientsRowCount = $db->query('SELECT COUNT(*) FROM patients');
    
        return $patientsRowCount;
    }

    public function paginatePatients($page) {
        $rowPerPage = 5;
        $rowCount = $this->patientsRowCount();
        $pageCount = ceil($rowCount / $rowPerPage);

        $startItem = ($page - 1) * $rowPerPage;

        $limit = ' LIMIT ' . ',' . $rowPerPage;

        $db = $this->dbConnect();
        $sql = 'SELECT * FROM patients';
        $query = $sql.$limit;
        $stmt = $db->prepare($query);
        $stmt->execute();
        $paginatedPatients = $stmt->fetchAll();
        
        return $paginatedPatients;
    }
}