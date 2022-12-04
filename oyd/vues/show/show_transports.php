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
  if(isset($pg)){
    echo "<center>";
    for($i=(($pg-1)*$nbEp); $i<=($pg*$nbEp-1); $i++){
      $unTransport = $lesTransports[$i];
      echo $unTransport['IdTp']." ";
      echo $unTransport['nom']." ";
      echo $unTransport['type']."<br/>";
    }
    echo "<form>";
    echo "<label for='pre' class=".$btnClasse.">Precedente</label>";
    echo "<input type='submit' name='pre' value='pre' id='pre' class=".$inpClasse.">";
    echo "<label for='sui' class=".$btnClasse.">suivant</label>";
    echo "<input type='submit' name='sui' value='sui' id='sui' class=".$inpClasse.">";
    echo "</form>";
    echo "</center>";
    if(isset($_POST['pre'])){
      $pg = $pg-1;
      header("Refresh:1");
    } elseif (isset($_POST['sui'])){
      $pg = $pg+1;
      header("Refresh:1");
    }
  } else {
    $pg = 1;
    echo "<center>";
    for($i=(($pg-1)*$nbEp); $i<=($pg*$nbEp-1); $i++){
      $unTransport = $lesTransports[$i];
      echo $unTransport['IdTp']." ";
      echo $unTransport['nom']." ";
      echo $unTransport['type']."<br/>";
    }
    echo "<form>";
    echo "<label for='pre' class=".$btnClasse.">Precedente</label>";
    echo "<input type='submit' name='pre' value='pre' id='pre' class=".$inpClasse.">";
    echo "<label for='sui' class=".$btnClasse.">suivant</a>";
    echo "<input type='submit' name='sui' value='sui' id='sui' class=".$inpClasse.">";
    echo "</form>";
    echo "</center>";
    if(isset($_POST['pre'])){
      $pg = $pg-1;
      header("Refresh:1");
    } elseif (isset($_POST['sui'])){
      $pg = $pg+1;
      header("Refresh:1");
    }
  }
?>