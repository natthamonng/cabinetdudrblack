<?php $title = 'Ajouter un rendez-vous';?>

<?php ob_start(); ?>
<div class="container">
    <h4>Ajouter un rendez-vous :</h4>
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 mt-3">
            <form action="index.php?action=addNewAppointment" method="POST" class="mt-3 mb-2">
            <div class="form-row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="idPatients">Patient</label>
                        <select class="form-control" id="idPatients" name="idPatients">
                            <option value="" disabled selected>--select--</option>
                        <?php 
                            foreach($patients as $data)
                            {
                        ?>
                            <option class="text-dark" value="<?= $data['id']; ?>"><?= strtoupper($data['lastname']) . ' ' . $data['firstname']; ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="hour">Heure</label>
                        <select class="form-control" id="hour" name="hour">
                            <option class="text-dark" value="" disabled selected>--heure--</option>
                            <option class="text-dark" value="08:00:00" >08:00</option>
                            <option class="text-dark" value="08:30:00" >08:30</option>
                            <option class="text-dark" value="09:00:00" >09:00</option>
                            <option class="text-dark" value="09:30:00" >09:30</option>
                            <option class="text-dark" value="10:00:00" >10:00</option>
                            <option class="text-dark" value="10:30:00" >10:30</option>
                            <option class="text-dark" value="11:00:00" >11:00</option>
                            <option class="text-dark" value="11:30:00" >11:30</option>
                            <option class="text-dark" value="14:00:00" >14:00</option>
                            <option class="text-dark" value="14:30:00" >14:30</option>
                            <option class="text-dark" value="15:00:00" >15:00</option>
                            <option class="text-dark" value="15:30:00" >15:30</option>
                        </select>
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-outline-light btn-sm float-right">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>