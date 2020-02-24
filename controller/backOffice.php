<?php
require_once('./model/PatientManager.php');
require_once('./model/AppointmentManager.php');
require_once('./model/SearchManager.php');

function home() {
    $appointmentManager = new McDoughnut\Clinic\Model\AppointmentManager();

    $todayAppointments = $appointmentManager->getTodayAppointments();
    require('./view/backOffice/home.php');
}

function listPatients() {
    $patientManager = new McDoughnut\Clinic\Model\PatientManager();

    $patients = $patientManager->getPatients();

    require('./view/backOffice/listPatientsView.php');
}

function patient($id){
    $patientManager = new McDoughnut\Clinic\Model\PatientManager();
    $appointmentManager = new McDoughnut\Clinic\Model\AppointmentManager();

    $patient = $patientManager->getPatient($id);
    $appointments = $appointmentManager->getPatientAppointments($id);

    require('./view/backOffice/patientProfileView.php');
}

function addPatientPage() {
    require('./view/backOffice/addPatientView.php');
}

function addNewPatient($lastname, $firstname, $birthdate, $phone, $mail) {
    $patientManager = new Mcdoughnut\Clinic\Model\PatientManager();
    $newPatient = $patientManager->postPatient($lastname, $firstname, $birthdate, $phone, $mail);

    if ($newPatient === false) {
        throw new Exception('Impossible d\'ajouter le patient !');
    }
    else {
        header('Location: index.php?action=listPatients');
    }
}

function editPatient($lastname, $firstname, $birthdate, $phone, $mail, $id){
    $patientManager = new McDoughnut\Clinic\Model\PatientManager();

    $updatedPatient = $patientManager->updatePatient($lastname, $firstname, $birthdate, $phone, $mail, $id);

    if ($updatedPatient === false) {
        throw new Exception('Impossible de modifier les informations d\'un patient !');
    }
    else {
        header('Location: index.php?action=patient&id=' . $id);
    }
}

function deletePatient($id){
    $patientManager = new McDoughnut\Clinic\Model\PatientManager();
    $deletedPatient = $patientManager->deletePatient($id);

    if ($deletedPatient === false) {
        throw new Exception('Impossible de supprimer le profil d\'un patient !');
    }
    else {
        header('Location: index.php?action=listPatients');
    }
}

function listAppointments() {
    $appointmentManager = new McDoughnut\Clinic\Model\AppointmentManager();

    $appointments = $appointmentManager->getActivedAppointments();

    require('./view/backOffice/listAppointmentsView.php');
}

function appointment($id){
    $appointmentManager = new McDoughnut\Clinic\Model\AppointmentManager();

    $appointment = $appointmentManager->getAppointment($id);

    require('./view/backOffice/appointmentView.php');
}

function addAppointmentPage() {
    $patientManager = new McDoughnut\Clinic\Model\PatientManager();

    $patients = $patientManager->getPatients();

    require('./view/backOffice/addAppointmentView.php');
}

function addNewAppointment($dateHour, $idPatients) {
    $appointmentManager = new Mcdoughnut\Clinic\Model\AppointmentManager();
    $newAppointment = $appointmentManager->postAppointment($dateHour, $idPatients);

    if ($newAppointment === false) {
        throw new Exception('Impossible d\'ajouter le rendez-vous !');
    }
    else {
        header('Location: index.php?action=listAppointments');
    }
}

function editAppointment($dateHour, $id){
    $appointmentManager = new McDoughnut\Clinic\Model\AppointmentManager();

    $updatedAppointment = $appointmentManager->updateAppointment($dateHour, $id);

    if ($updatedAppointment === false) {
        throw new Exception('Impossible de modifier les informations d\'un rendez-vous !');
    }
    else {
        header('Location: index.php?action=appointment&id=' . $id);
    }
}

function deleteAppointment($id){
    $appointmentManager = new McDoughnut\Clinic\Model\AppointmentManager();
    $deletedAppointment = $appointmentManager->deleteAppointment($id);

    if ($deletedAppointment === false) {
        throw new Exception('Impossible de supprimer le rendez-vous !');
    }
    else {
        header('Location: index.php?action=listAppointments');
    }
}


function searchJSON($searchTerm){
    $searchManager = new McDoughnut\Clinic\Model\SearchManager();
    $patients = $searchManager->getPatients($searchTerm);

    header("Content-Type: application/json");
    echo json_encode($patients);
    exit;
}