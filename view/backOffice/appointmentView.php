<?php $title = 'Les information d\'un rendez-vous';?>

<?php ob_start(); ?>
<div class="container">
    <h4><a class="text-white" href="index.php?action=listAppointments"><i class="fas fa-chevron-left"></i></a> Les informations d'un rendez-vous</h4>
    <div class="row">
        <div class="col-12 col d-flex justify-content-center">
            <form action="index.php?action=editAppointment&amp;id=<?= $appointment['appointment_id'] ?>" method="POST" class="mt-3 mb-3  p-3 border rounded">
                <div class="form-row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?= date("Y-m-d", strtotime($appointment['dateHour'])); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="hour">Heure</label>
                            <select class="form-control" id="hour" name="hour" >
                            <?php
                                $hours = [
                                    "08:00",
                                    "08:30",
                                    "09:00",
                                    "09:30",
                                    "10:00",
                                    "10:30",
                                    "11:00",
                                    "11:30",
                                    "14:00",
                                    "14:30",
                                    "15:00",
                                    "15:30"
                                ];
                                $found = false;
                                $hourPost = date("H:i", strtotime($appointment['dateHour']));
                                foreach($hours as $hour){
                                    $attr_selected = "";
                                    if($hour === $hourPost){
                                        $attr_selected = "selected";
                                        $found = true;
                                    }
                                    ?>
                                    
                                    <option class="text-dark" value="<?= $hour.':00' ?>" <?= $attr_selected ?>><?= $hour ?></option>
                                <?php
                                }
                                ?>
                                <option value="" disabled <?= $found ? '' : 'selected' ?>>--heure--</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="patient">Patient</label>
                            <input type="text" readonly class="form-control" id="patient" name="patient" value="<?= strtoupper($appointment['lastname']) . ' ' . $appointment['firstname']; ?>">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id'] ?>">
                <button type="submit" class="btn btn-outline-light btn-sm float-right" name="modifier">Modifier</button>
                <a class="btn btn-outline-light btn-sm float-right mr-2" href="index.php?action=appointment&amp;id=<?= $appointment['appointment_id']; ?>">Annuler</a>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>