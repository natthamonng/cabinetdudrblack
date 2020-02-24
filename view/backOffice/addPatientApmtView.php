<?php $title = 'Ajouter nouveau patient et son RDV';?>

<?php ob_start(); ?>
<div class="container">
    <h4>Ajouter un patient et son rendez-vous</h4>
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 mt-3">
            <form action="index.php?action=addNewPatient" method="POST" class="mb-2">
                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom">
                </div>
                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
                </div>

                <div class="form-group">
                    <label for="birthdate">Date de naissance</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate">
                </div>

                <div class="form-group">
                    <label for="phone">Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="0000000000">
                </div>

                <div class="form-group">
                    <label for="mail">Email</label>
                    <input type="email" class="form-control" id="mail" aria-describedby="emailHelp" name="mail" placeholder="email@exemple.fr">
                </div>

                <button type="submit" class="btn btn-outline-light btn-sm float-right">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>