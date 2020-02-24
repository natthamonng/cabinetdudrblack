<?php
namespace McDoughnut\Clinic\Model;

require_once('BaseManager.php');

class AppointmentManager extends BaseManager {
    public function getAppointments(){
        $db = $this->dbConnect();
        $stmt = $db->query('SELECT appointments.id, appointments.dateHour AS dateHour, patients.lastname AS lastname FROM appointments JOIN patients ON appointments.idPatients = patients.id ORDER BY dateHour');
    
        $data = $stmt->fetchAll();
        $stmt->closeCursor();

        return $data;
    }
    
    public function getActivedAppointments(){
        $db = $this->dbConnect();
        $stmt = $db->query('SELECT appointments.id, appointments.dateHour AS dateHour, patients.lastname AS lastname FROM appointments JOIN patients ON appointments.idPatients = patients.id WHERE DATE(appointments.dateHour) >= CURDATE() ORDER BY dateHour');
    
        $data = $stmt->fetchAll();
        $stmt->closeCursor();

        return $data;
    }

    public function getAppointment($id) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT appointments.id AS appointment_id , appointments.dateHour AS dateHour, patients.lastname AS lastname, patients.firstname AS firstname FROM appointments JOIN patients ON appointments.idPatients = patients.id WHERE appointments.id = ?'); 
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $appointment = $stmt->fetch();
    
        return $appointment;
    }

    public function getTodayAppointments(){
        $db = $this->dbConnect();
        $stmt = $db->query('SELECT appointments.id, appointments.dateHour, patients.lastname AS lastname FROM appointments JOIN patients ON appointments.idPatients = patients.id WHERE DATE(appointments.dateHour) = CURDATE() ORDER BY dateHour');
    
        $data = $stmt->fetchAll();
        $stmt->closeCursor();

        return $data;
    }

    public function getPatientAppointments($id) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT appointments.id, dateHour FROM appointments JOIN patients ON appointments.idPatients = patients.id WHERE patients.id = ?'); 
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $data = $stmt->fetchAll();
        $stmt->closeCursor();

        return $data;
    }

    public function postAppointment($dateHour, $idPatients) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('INSERT INTO appointments (dateHour, idPatients) VALUES (:dateHour, :idPatients)');
        $stmt->bindParam(':dateHour', $dateHour);
        $stmt->bindParam(':idPatients', $idPatients);
        $affectedLines = $stmt->execute();

        return $affectedLines;
    }

    public function updateAppointment($dateHour, $id) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('UPDATE appointments SET dateHour = :dateHour WHERE id = :id'); 
        $stmt->bindParam(':dateHour', $dateHour);
        $stmt->bindParam(':id', $id);
        $updatedAppointment = $stmt->execute();

        return $updatedAppointment;
    }

    public function deleteAppointment($id) {
        $db = $this->dbConnect();
        $stmt = $db->prepare('DELETE FROM appointments WHERE id=?'); 
        $stmt->bindParam(1, $id);
        $deletedAppointment = $stmt->execute();

        return $deletedAppointment;
    }
}