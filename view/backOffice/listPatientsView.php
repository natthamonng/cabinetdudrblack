<?php $title = 'Liste des patients';?>

<?php ob_start(); ?>
<div class="container">
<?php if (count($patients) > 0): ?>
    <h4>Liste des patients</h4>
    <div class="row">
        <div class="col-12 col d-flex justify-content-center mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Détails</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($patients as $data)
                    {
                ?>

                <tr>
                    <th scope="row"><?= $data['id'];?></th>
                    <td><?= htmlspecialchars($data['lastname']);?></td>
                    <td><?= htmlspecialchars($data['firstname']);?></td>
                    <td><a href="index.php?action=patient&id=<?= $data['id']; ?>"><i class="fas fa-book-dead"></i></a></td>
                    <td><a href="index.php?action=deletePatient&id=<?= $data['id']; ?>" title="Supprimer ce patient et ses rendez-vous !"><i class="fas fa-skull-crossbones"></i></a></td>
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
                <h5><a href="index.php?action=addPatient"><i class="far fa-calendar" title="Ajouter un patient?"></i></a> Aucun patient</h5>
            </div>
        </div>
    <?php endif ?>
    <small><a class="font-italic text-secondary" href="index.php?action=addPatient">Ajouter un patient</a></small>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>