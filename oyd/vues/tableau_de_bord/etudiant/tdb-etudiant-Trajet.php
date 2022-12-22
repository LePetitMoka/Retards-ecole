<h2>Ajout d'un nouveau trajet</h2>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="nbtc">Nombre de transports : </label>
      </td>
      <td>
        <input type="number" min=1 name="nbtc" id="nbtc" required>
      </td>
    </tr>
  </table>
  <input type="submit" value="Valider" name="Valider" class='sub-buton'>
</form>
<?php
  if(isset($_POST['Valider'])){
    $nbtc = $_POST['nbtc'];
    $limb = $nbtc*2-1;
    var_dump($limb);

    $unControleur -> setTable("transport");
    $lesTransports = $unControleur -> select_all();

    echo "<br/>";
    echo "<br/>";
    echo "Differents types de transports : bus, tram, metro, rail, funicular.";
    echo "<br/>";
    echo "<br/>";
    echo "<form method='post'>";
    echo "<table>";
    for($i=1; $i<=$limb; $i = $i+2){
      echo "<tr>";
      echo "<td>";
      echo "<label for='tp".$i."'>Transport : </label>";
      echo "</td>";
      echo "<td>";
      echo "<select name='tp".$i."' id='tp".$i."' required>";
      for($j=0; $j<=count($lesTransports)-1; $j++){
        $leTransport = $lesTransports[$j];
        echo "<option value=".$leTransport['IdTp'].">".$leTransport['type']." ".$leTransport['nom']."</option>";
      }
      echo "<select>";
      echo "</td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "<input type='submit' value='Continuer' name='Continuer' class='sub-buton'>";
    echo "</form>";
  }
  if(isset($_POST['Continuer'])){
    $limb = (count($_POST)-1)*2;

    $tp = array();
    var_dump($_POST);
    for($i=1; $i<=$limb; $i = $i+2){
      $tp[$i] = $_POST['tp'.$i];
      // $_SESSION['tp'] = $i;

      // if($i%2!=0 && $i==1){
      //   // $_SESSION['tp'] = $i;
      //   $tp[$i] = $_POST['tp'.$i];
      //   echo "tp".$i." pour 1 <br/>";
      //   var_dump($tp[$i]);
      // } elseif($i%2!=0 && $i!=1){
      //   // $_SESSION['tp'] = $i+2;
      //   $tp[$i+2] = $_POST['tp'.$i];
      //   echo "tp".$i." pour les impaires <br/>";
      //   var_dump($tp[$i+2]);
      // } elseif($i%2==0 && $i>1){
      //   // $_SESSION['tp']++;
      //   $tp[$i+1] = $_POST['tp'.$i];
      //   echo "tp".$i." les paires <br/>";
      //   var_dump($tp[$i+1]);
      //   echo "paire ";
      // }
    }

    echo "<br/>"; 
    echo "<br/>";
    echo "<form method='post'>";
    echo "<table>";
    for($i=1; $i<=$limb; $i = $i+2){
      if($i%2!=0){
        $tp[$i] = "'".$tp[$i]."'";
        var_dump($tp);
        $m = $i;
        $n = $i+1;

        $unControleur -> setTable("transport");
        $leTransport = $unControleur -> select_where("IdTp", $tp[$i]);

        $unControleur -> setTable("vue_arret_transport");
        $lesArretsTransport = $unControleur -> select_where_all("IdTp", $tp[$i]);

        echo "<tr>";
        echo "<td>";
        echo "<label for='".$m."'>Depart du transport : ".$leTransport['type']." ".$leTransport['nom']."</label>";
        echo "</td>";
        echo "<td>";
        echo "<select name='".$m."' id='".$m."' required>";
        for($j=0; $j<=count($lesArretsTransport)-1; $j++){
          $lArretTransport = $lesArretsTransport[$j];
          echo "<option value=".$lArretTransport['IdSt'].">".$lArretTransport['NomArret']."</option>";
        }
        echo "<select>";
        echo "</td>";
        echo "<td>";
        echo "<label for='".$n."'>Arret du transport : ".$leTransport['type']." ".$leTransport['nom']."</label>";
        echo "</td>";
        echo "<td>";
        echo "<select name='".$n."' id='".$n."' required>";
        for($j=0; $j<=count($lesArretsTransport)-1; $j++){
          $lArretTransport = $lesArretsTransport[$j];
          echo "<option value=".$lArretTransport['IdSt'].">".$lArretTransport['NomArret']."</option>";
        }
        echo "<select>";
        echo "</td>";
        echo "</tr>";
      }
    }
    echo "</table>";
    echo "<input type='submit' value='Confirmer' name='Confirmer' class='sub-buton'>";
    echo "</form>";
  }
  if(isset($_POST['Confirmer'])){
    var_dump($_POST);
    for($i=1; $i<=count($_POST)-1; $i++){
      $_POST[$i] = "'".$_POST[$i]."'";
      $ordre = "IdSt, IdE";
      $valeurs = array("IdSt" => $_POST[$i], "IdE" => $_SESSION['id']);
      $unControleur -> setTable("trajet");
      $unControleur -> insert($ordre, $valeurs);
    }
  }
?>
</center>