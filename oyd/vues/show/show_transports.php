<h2>Listes de tout les transports</h2>
<?php
  $unControleur -> setTable("transport");

  $lesTransports = $unControleur -> select_all();

  // 1963
  $tabClass = '"show-table"';
  $btnClass = '"sub-buton"';
  $inpClass = '"invisible"';
  $classFull = '"full"';
  $classPartial = '"partial"';
  $totEl = count($lesTransports);
  $nbEp = 10;
  $totpg = floor($totEl/$nbEp);
  if ($totEl%$nbEp > 0){
    $totpg ++;
  }
  if(isset($_SESSION['pg'])){
    echo "<center>";
    // echo "<div class='show-content'>";
    for($i=(($_SESSION['pg']-1)*$nbEp); $i<=($_SESSION['pg']*$nbEp-1); $i++){
      $unTransport = $lesTransports[$i];
      echo "<table class=".$tabClass.">";
      echo "<tr>";
      echo "<td rowspan='2' class=".$classFull."><img src='".$unTransport['pictogramme']."' width='100' height='100'></td>";
      echo "<td class=".$classPartial.">".$unTransport['type']." ".$unTransport['nom']."</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class=".$classPartial."> Géré par : </td>";
      echo "<td class=".$classPartial.">".$unTransport['transporteur']."</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class=".$classFull.">".$unTransport['type']."</td>";
      echo "<td class=".$classPartial.">Etat : </td>";
      echo "<td class=".$classPartial.">fluide</td>";
      echo "</tr>";
      echo "</table>";
      // echo "<div class='item-container'>";
      // echo "<ul class='item-list unstyled-list item-list-left'>";
      // echo "<li class='item-list-elements'><img src='".$unTransport['pictogramme']."' width='100' height='100'></li>";
      // echo "<li class='item-list-elements'>".$unTransport['type']."</li>";
      // echo "</ul>";
      // echo "<ul class='item-list unstiled-list'>";
      // echo "<li class='item-list-elements'>".$unTransport['type']."</li>";
      // echo "<li class='item-list-elements'> Géré par : </li>";
      // echo "<li class='item-list-elements'>Etat : </li>";
      // echo "</ul>";
      // echo "<ul class='item-list unstiled-list'>";
      // echo "<li class='item-list-elements'>".$unTransport['nom']."</li>";
      // echo "<li class='item-list-elements'>".$unTransport['transporteur']."</li>";
      // echo "<li class='item-list-elements'>Ok</li>";
      // echo "</ul>";
      // echo "</div>";
    }
    // echo "</div>";
    echo "<form method='post'>";
    echo "<label for='pre' class=".$btnClass.">Precedente</label>";
    echo "<input type='submit' name='pre' value='pre' id='pre' class=".$inpClass.">";
    echo "<label for='sui' class=".$btnClass.">suivant</label>";
    echo "<input type='submit' name='sui' value='sui' id='sui' class=".$inpClass.">";
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
    echo "<label for='pre' class=".$btnClass.">Precedente</label>";
    echo "<input type='submit' name='pre' value='pre' id='pre' class=".$inpClass.">";
    echo "<label for='sui' class=".$btnClass.">suivant</a>";
    echo "<input type='submit' name='sui' value='sui' id='sui' class=".$inpClass.">";
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