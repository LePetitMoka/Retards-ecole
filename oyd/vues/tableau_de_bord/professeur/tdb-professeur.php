<h1>Tableau de bord étudiant</h1>
<section class="profil">
  <div class="container">
    <div>
      <img src="./img/icons_colorees/professeur.png" width=300 height=300>
    </div>
    <div>
      <p>Nom : <?php echo $_SESSION['nom'] ?></p>
      <p>Preom : <?php echo $_SESSION['prenom'] ?></p>
      <p>Téléphone : <?php echo $_SESSION['telephone'] ?></p>
      <p>Email : <?php echo $_SESSION['email'] ?></p>
      <p>Adresse : <?php echo $_SESSION['adresse'] ?></p>
    </div>
  </div>
</section>
<section class="subnavbar">
  <div class="container">
    <div class="submenu">
      <ul class="submenu-list unstyled-list">
        <li><a class="buton selected" href="index.php?user=prof&page=0&subPage=0">Informations</a></li>
      </ul>
    </div>
  </div>
</section>
<section class="tdb-content">
  <div class="container">
    <?php
      if(isset($_GET['subPage'])){
        $subPage = $_GET['subPage'];
      } else {
        $subPage = 0;
      }
      switch ($subPage) {
        case 0:
          require_once("./vues/tableau_de_bord/professeur/tdb-professeur-Info.php");
          break;
        
        default:
        require_once("index.php?user=prof&page=0&subPage=0");
          break;
      }
    ?>
  </div>
</section>