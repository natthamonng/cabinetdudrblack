<?php $title = 'HOME';?>

<?php ob_start(); ?>
<div class="container-fluid d-flex justify-content-center">
    <div class="row">
        <div class="col-12 col-md-9 d-flex justify-content-center">
            <img src="public/images/cabinetdudrblack.jpg"
                class="img-fluid home-img" alt="Cabinet du Docteur Black">
        </div>
        <div class="col-12 col-md-3 border border-white  rounded">
            <div class="row">
                <div class="col-12 d-flex justify-content-center mt-2 p-2 border-bottom border-white">
                    <h4><?= 'Aujourd\'hui:' . ' ' . date("d-m-Y"); ?></h4>
                </div>
                <div class="col-12 mt-3">
                <?php if (count($todayAppointments)): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">HEURE</th>
                                <th scope="col">PATIENT</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                    $count = 1;
                    foreach($todayAppointments as $data) 
                    { 
                ?>
                            <tr>
                                <th scope="row"><?= $count; ?></th>
                                <td><?= date("g:i A", strtotime($data['dateHour'])); ?></td>
                                <td><?= $data['lastname']; ?></td>
                            </tr>
                <?php
                    $count += 1;
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
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>