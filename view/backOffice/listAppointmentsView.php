<?php $title = 'Liste des rendez-vous';?>

<?php ob_start(); ?>
<div class="container">
    <?php if (count($appointments) > 0): ?>
    <h4>Liste des rendez-vous</h4>
    <div class="row">
        <div class="col-12 col d-flex justify-content-center mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Heure</th>
                        <th scope="col">Patient</th>
                        <th scope="col">Détails</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($appointments as $data)
                    {
                ?>

                <tr>
                    <th scope="row"><?= $data['id'];?></th>
                    <td><?= date("d-m-Y", strtotime($data['dateHour']));?></td>
                    <td><?= date("g:i A", strtotime($data['dateHour']));?></td>
                    <td><?= htmlspecialchars($data['lastname']);?></td>
                    <td><a href="index.php?action=appointment&id=<?= $data['id']; ?>"><i class="fas fa-book-dead"></i></a></td>
                    <td><a href="index.php?action=deleteAppointment&id=<?= $data['id']; ?>" title="Supprimer ce rendez-vous !"><i class="fas fa-trash"></i></a></td>
                </tr>

                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
        <div class="row">
            <div class="col-12 col d-flex justify-content-center mt-5">
                <h5><a href="index.php?action=addAppointment"><i class="far fa-calendar" title="Ajouter un rendez-vous?"></i></a> Aucun rendez-vous</h5>
            </div>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="col-12 col d-flex justify-content-center mt-5">
            <small><a class="font-italic text-secondary float-right" href="index.php?action=addAppointment">Ajouter un rendez-vous</a></small>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>