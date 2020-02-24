<nav class="navbar navbar-expand-lg navbar-dark bg-black mb-3">
  <a class="navbar-brand" href="index.php">Le Cabinet du Docteur Black</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=home">Accueil<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Patient
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?action=listPatients">Liste des patients</a>
          <a class="dropdown-item" href="index.php?action=addPatient">Ajouter un patient</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Rendez-vous
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?action=listAppointments">Liste des rendez-vous</a>
          <a class="dropdown-item" href="index.php?action=addAppointment">Ajouter un rendez-vous</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <auto-complete class="mr-sm-3" query-url="index.php?action=search" query-field="q"></auto-complete>
      <!-- <input class="form-control mr-sm-2 bg-dark" type="search" placeholder="Recherche un patient" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button> -->
    </form>
  </div>
</nav>

<script type="text/javascript" src="public/js/AutoCompletion.js"></script>
<script type="text/javascript">
  const $autoComp = document.querySelector('auto-complete');
  $autoComp.addEventListener('select', (evt) => {
      const patient = evt.detail.patient;
      console.log(patient);
      window.location.href = `http://localhost/cabinetdudrblack/index.php?action=patient&id=${patient.id}`;
  });
</script>