<?php $title = 'Erreur';?>

<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1><?= $errorMessage ?></h1>
            <p><a class="badge badge-light" href="index.php">Retour à la page d'accueil</a></p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>