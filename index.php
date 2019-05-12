<!doctype html>
<html lang="en">
  <!-- header -->
  <?php require_once('incl/header.php'); ?>
  <body>
  <!-- nav Bar -->
    <?php require_once('incl/navbar.php'); ?>

    <!-- Renderiza corpo da página -->
    <?php 
      (!empty($_GET))?require_once($_GET['pst']."/".$_GET['arq'].".php"):"";
    ?>

    <!-- Dependencias Js -->
    <?php require_once('incl/jsdependencies.php'); ?>
  </body>
</html>