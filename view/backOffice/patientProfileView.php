<?php $title = 'Profil d\'un patient';?>

<?php ob_start(); ?>
<div class="container">
    <h4><a class="text-white" href="index.php?action=listPatients"><i class="fas fa-chevron-left"></i></a> Profil d'unpatient</h4>
    <div class="row">
        <div class="col-12 col d-flex justify-content-center">
            <form action="index.php?action=editPatient&amp;id=<?= $patient['id'] ?>" method="POST" class="mt-3 mb-5 p-3 border rounded">
                <div class="form-row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="lastname">Nom</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                value="<?= htmlspecialchars($patient['lastname']); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                value="<?= htmlspecialchars($patient['firstname']); ?>">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="birthdate">Date de naissance</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate"
                                value="<?= $patient['birthdate']; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="phone">Numéro de téléphone</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                value="<?= $patient['phone']; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="mail">Email</label>
                            <input type="email" class="form-control" id="mail" aria-describedby="emailHelp" name="mail"
                                value="<?= htmlspecialchars($patient['mail']); ?>">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="patient-id" value="<?= $patient['id'] ?>">
                <button type="submit" class="btn btn-outline-light btn-sm float-right" name="modifier">Modifier</button>
                <a class="btn btn-outline-light btn-sm float-right mr-2" href="index.php?action=patient&amp;id=<?= $patient['id']; ?>">Annuler</a>
            </form>
        </div>
    </div>

    <?php if (count($appointments) > 0): ?>
    <div class="row border-top pt-5">
        <div class="col-12 col-md-6 offset-md-3">
        <h5>Liste des rendez-vous: </h5>
        </div>
        <div class="col-12 col-md-6 offset-md-3 d-flex justify-content-center">
            <table class="table" class="mt-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">DATE</th>
                        <th scope="col">HEURE</th>
                    </tr>
                </thead>
                <tbody>

            <?php 
                foreach($appointments as $data) 
                { 
            ?>
                    <tr>
                        <th scope="row"><?= $data['id']; ?></th>
                        <td><?= date("d-m-Y", strtotime($data['dateHour'])); ?></td>
                        <td><?= date("g:i A", strtotime($data['dateHour'])); ?></td>
                    </tr>
            <?php
                }
            ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-12 col d-flex justify-content-center mt-5">
                
                <h5><a href="index.php?action=addAppointment"><i class="far fa-calendar" title="Ajouter un rendez-vous?"></i></a> Aucun rendez-vous</h5>
            </div>
        </div>
    <?php endif ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>