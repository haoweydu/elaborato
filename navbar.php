<?php
session_start();
if (!isset($_SESSION["autorizzato"]) || $_SESSION["autorizzato"]==0) {
  echo "<h1>Area riservata, accesso negato.</h1>";
  echo "Per effettuare il login clicca <a href='login.php'><font color='blue'>qui</font></a>";
  die;
}
$cod = $_SESSION['id'];
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="app.php">Logo</a>
  <ul class="navbar-nav ml-auto">
    <?php if($_SESSION["ruolo"]=="insegnante"): ?>
    <li class="nav-item">
      <a class="nav-link" href="pubblicatidame.php">Pubblicati da me</a>
    </li>
    <?php endif; ?>
    <?php if($_SESSION["ruolo"]=="admin"): ?>
    <li class="nav-item">
      <a class="nav-link" href="gestion_acc.php">Gestione account</a>
    </li>
    <?php endif; ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Tu
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="#">Il tuo account</a>
        <a class="dropdown-item" href="logout.php">logout</a>
      </div>
    </li>
  </ul>
</nav>
