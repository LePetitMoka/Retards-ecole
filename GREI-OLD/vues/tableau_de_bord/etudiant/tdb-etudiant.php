<h1>Tableau de bord étudiant</h1>
<section class="profil">
  <div class="container">
    <div>
      <img src="./img/icons_colorees/etudiant.png" width=300 height=300>
    </div>
    <div>
      <?php 
      $unControleur -> setTable("classe");
      $SaClasse = $unControleur -> select_where("IdCl", $_SESSION['IdCl']);
      $_SESSION['classe'] = $SaClasse['nom'];
      $_SESSION['dippre'] = $SaClasse['diplomePrepare']; 
      ?>
      <p>Nom : <?php echo $_SESSION['nom'] ?></p>
      <p>Preom : <?php echo $_SESSION['prenom'] ?></p>
      <p>Classe : <?php echo $_SESSION['classe'] ?></p>
      <p>Diplome préparé : <?php echo $_SESSION['dippre'] ?></p>
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
        <li><a class="buton selected" href="index.php?user=etudiant&page=0&subPage=0">Info Classe</a></li>
        <li><a class="buton selected" href="index.php?user=etudiant&page=0&subPage=1">Tickets de retard</a></li>
        <li><a class="buton selected" href="index.php?user=etudiant&page=0&subPage=2">Trajet</a></li>
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
          require_once("./vues/tableau_de_bord/etudiant/tdb-etudiant-InfoClasse.php");
          break;
        case 1:
          require_once("./vues/tableau_de_bord/etudiant/tdb-etudiant-Tickets.php");
          break;
        case 2:
          require_once("./vues/tableau_de_bord/etudiant/tdb-etudiant-Trajet.php");
          break;
        
        default:
        require_once("index.php?user=etudiant&page=0&subPage=0");
          break;
      }
    ?>
  </div>
</section>