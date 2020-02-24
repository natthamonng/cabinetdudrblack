<?php
// ROUTER
session_start();
require('./controller/backOffice.php');

// App constants
putenv("BASE_URL=http://localhost/cabinetdudrblack/");


try {
    if(isset($_GET['action'])){
    
        switch($_GET['action']){
            case 'home':
                home();
            break;

            case 'listPatients':
                listPatients();
            break;

            case  'patient':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    patient($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de patient envoyé');
                }
            break;

            case 'addPatient':
                addPatientPage();
            break;

            case 'addNewPatient':
                if (!empty($_POST['lastname']) || !empty($_POST['firstname']) || !empty($_POST['birthdate']) || !empty($_POST['phone'])|| !empty($_POST['mail'])) {
                    addNewPatient($_POST['lastname'], $_POST['firstname'], $_POST['birthdate'], $_POST['phone'], $_POST['mail']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }    
            break;

            case 'editPatient':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['birthdate']) && !empty($_POST['phone']) && !empty($_POST['mail'])) {
                        editPatient($_POST['lastname'], $_POST['firstname'], $_POST['birthdate'], $_POST['phone'], $_POST['mail'], $_GET['id']);
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                else {
                    throw new Exception('Aucun identifiant de patient envoyé');
                }
            break;

            case 'deletePatient':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deletePatient($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de patient envoyé');
                }
            break;

            case 'listAppointments':
                listAppointments();
            break;

            case 'appointment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    appointment($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de rendez-vous envoyé');
                }
            break;    

            case 'addAppointment':
                addAppointmentPage();
            break;

            case 'addNewAppointment':
                if (!empty($_POST['date']) || !empty($_POST['hour']) || !empty($_POST['idPatients'])) {
                    addNewAppointment($_POST['date'] . ' ' . $_POST['hour'], $_POST['idPatients']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                } 
            break;

            case 'editAppointment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['date']) && !empty($_POST['hour'])) {
                        editAppointment($_POST['date'] . ' ' . $_POST['hour'], $_GET['id']);
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                else {
                    throw new Exception('Aucun identifiant de rendez-vous envoyé');
                }
            break;

            case 'deleteAppointment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deleteAppointment($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de rendez-vous envoyé');
                }
            break;


            // BEGIN API
            case 'search':
                $searchTerm = "";
                if(!empty($_GET["q"])){
                    $searchTerm = $_GET["q"];
                }
                searchJSON($searchTerm);
                break;

            default:
                home();
        }
    } else {
        home();
    }

}
catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('view/backOffice/errorView.php');
}
