<h2>Listes de tout les transports</h2>
<?php
  $unControleur -> setTable("transport");

  $lesTransports = $unControleur -> select_all();

  // 1963
  $btnClasse = '"sub-buton"';
  $inpClasse = '"invisible"';
  $totEl = count($lesTransports);
  $nbEp = 10;
  $totpg = floor($totEl/$nbEp);
  if ($totEl%$nbEp > 0){
    $totpg ++;
  }
  if(isset($_SESSION['pg'])){
    echo "<center>";
    for($i=(($_SESSION['pg']-1)*$nbEp); $i<=($_SESSION['pg']*$nbEp-1); $i++){
      $unTransport = $lesTransports[$i];
      echo $unTransport['IdTp']." ";
      echo $unTransport['nom']." ";
      echo $unTransport['type']."<br/>";
    }
    echo "<form method='post'>";
    echo "<label for='pre' class=".$btnClasse.">Precedente</label>";
    echo "<input type='submit' name='pre' value='pre' id='pre' class=".$inpClasse.">";
    echo "<label for='sui' class=".$btnClasse.">suivant</label>";
    echo "<input type='submit' name='sui' value='sui' id='sui' class=".$inpClasse.">";
    echo "</form>";
    echo "</center>";
    if(isset($_POST['pre'])){
      $_SESSION['pg'] = $_SESSION['pg']-1;
      // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
    } elseif (isset($_POST['sui'])){
      $_SESSION['pg'] = $_SESSION['pg']+1;
      // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
    }
  } else {
    $_SESSION['pg'] = 1;
    echo "<center>";
    for($i=(($_SESSION['pg']-1)*$nbEp); $i<=($_SESSION['pg']*$nbEp-1); $i++){
      $unTransport = $lesTransports[$i];
      echo $unTransport['IdTp']." ";
      echo $unTransport['nom']." ";
      echo $unTransport['type']."<br/>";
    }
    echo "<form method='post'>";
    echo "<label for='pre' class=".$btnClasse.">Precedente</label>";
    echo "<input type='submit' name='pre' value='pre' id='pre' class=".$inpClasse.">";
    echo "<label for='sui' class=".$btnClasse.">suivant</a>";
    echo "<input type='submit' name='sui' value='sui' id='sui' class=".$inpClasse.">";
    echo "</form>";
    echo "</center>";
    if(isset($_POST['pre'])){
      $_SESSION['pg'] = $_SESSION['pg']-1;
      // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
    } elseif (isset($_POST['sui'])){
      $_SESSION['pg'] = $_SESSION['pg']+1;
      // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
    }
  }
?>