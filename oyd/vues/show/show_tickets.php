<h2>Liste des ticket</h2>
<?php
  $unControleur -> setTable("billet");

  $lesTickets = $unControleur -> select_all();

  // 1963
  $tabClass = '"show-table"';
  $btnClass = '"sub-buton"';
  $inpClass = '"invisible"';
  $classFull = '"full"';
  $classPartial = '"partial"';
  $stateClass = '"state"';
  $totEl = count($lesTickets);
  $nbEp = 10;
  $totpg = floor($totEl/$nbEp);
  if ($totEl%$nbEp > 0){
    $totpg ++;
  }

  function showLoop($x, $y){
    for($i=$x; $i<=$y; $i++){
      $unTicket = $lesTickets[$i];
      echo "<table class=".$tabClass.">";
      echo "<tr>";
      echo "<td rowspan='2' class=".$classFull."></td>";
      echo "<td class=".$classPartial.">Etudiant ".$unTicket['IdE']." Administrateur".$unTicket['IdAd']."</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class=".$classPartial."> Fait le : ".$unTicket['dateB']."</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class=".$classFull.">".$unTicket['dureeRetard']."</td>";
      echo "<td class=".$stateClass.">Signature : ".$unTicket['URLSignature']."</td>";
      echo "</tr>";
      echo "</table>";
    }
  }

  function loopConditions(){
    if($_SESSION['pg']>=1 || $_SESSION['pg']<$totpg){
      $a = ($_SESSION['pg']-1)*$nbEp;
      $b = $_SESSION['pg']*$nbEp-1;
      showLoop($a, $b);
    } elseif($_SESSION['pg'] == $totpg){
      $b = $totEl;
      $a = $b - ($totEl - floor($totEl/$nbEp)*$nbEp);
      showLoop($a, $b);
    } elseif($_SESSION['pg']<1){
      $_SESSION['pg'] = 1;
      $a = ($_SESSION['pg']-1)*$nbEp;
      $b = $_SESSION['pg']*$nbEp-1;
    } elseif($_SESSION['pg']>$totpg){
      $_SESSION['pg'] = $totpg;
      $b = $totEl;
      $a = $b - ($totEl - floor($totEl/$nbEp)*$nbEp);
      showLoop($a, $b);
    }
  }

  if(isset($_SESSION['pg'])){
    echo "<center>";
    // echo "<div class='show-content'>";
    loopConditions();
    // echo "</div>";
    echo "<form method='post'>";
    if($_SESSION['pg']>1){
      echo "<label for='pre' class=".$btnClass.">Precedente</label>";
      echo "<input type='submit' name='pre' value='pre' id='pre' class=".$inpClass.">";
    }
    echo "<p>page ".$_SESSION['pg']."</p>";
    if($_SESSION['pg']<$totpg){
      echo "<label for='sui' class=".$btnClass.">suivant</label>";
      echo "<input type='submit' name='sui' value='sui' id='sui' class=".$inpClass.">";
    }
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
    // echo "<div class='show-content'>";
    loopConditions();
    // echo "</div>";
    echo "<form method='post'>";
    if($_SESSION['pg']>1){
      echo "<label for='pre' class=".$btnClass.">Precedente</label>";
      echo "<input type='submit' name='pre' value='pre' id='pre' class=".$inpClass.">";
    }
    echo "<p>page ".$_SESSION['pg']."</p>";
    if($_SESSION['pg']<$totpg){
      echo "<label for='sui' class=".$btnClass.">suivant</label>";
      echo "<input type='submit' name='sui' value='sui' id='sui' class=".$inpClass.">";
    }
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
<script>
  alert("page <?php echo $_SESSION['pg']; ?>");
</script>