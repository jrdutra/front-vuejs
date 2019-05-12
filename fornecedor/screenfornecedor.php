<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-buscar" role="tab" aria-controls="nav-home" aria-selected="true">Buscar</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-novo" role="tab" aria-controls="nav-profile" aria-selected="false">Novo</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-alterar" role="tab" aria-controls="nav-contact" aria-selected="false">Alterar</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-buscar" role="tabpanel" aria-labelledby="nav-home-tab"><?php require_once('fornecedor/buscar.php'); ?></div>
  <div class="tab-pane fade" id="nav-novo" role="tabpanel" aria-labelledby="nav-profile-tab"><?php require_once('fornecedor/novo.php'); ?></div>
  <div class="tab-pane fade" id="nav-alterar" role="tabpanel" aria-labelledby="nav-contact-tab"><?php require_once('fornecedor/alterar.php'); ?></div>
</div>