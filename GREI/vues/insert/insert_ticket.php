<h2>Nouveau ticket</h2>
<center>
<?php $curTime = time() ?>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="etud">Etudiant concerné : </label>
      </td>
      <td>
        <select name="etud" id="etud" required>
          <option>Choisir un étudiant</option>
          <?php
            for($i=0; $i<=count($lesEtudiants)-1; $i++){
              $unEtudiant = $lesEtudiants[$i];
              echo "<option value=".$unEtudiant['IdE'].">".$unEtudiant['nomEleve']." ".$unEtudiant['prenom']."</option>";
            }
          ?>
        </select>
      </td>
      <td>
        <label for="sign">Signature : </label>
      </td>
      <td>
        <label for="sign"><?php echo $_SESSION['nom']." ".$_SESSION['prenom'] ?></label>
        <input type="hidden" name="sign" value=<?php echo $_SESSION['nom']." ".$_SESSION['prenom'] ?>>
        <input type="hidden" name="admin" value=<?php echo $_SESSION['id'] ?>>
      </td>
    </tr>
    <tr>
      <td>
        <label for="raison">Raison : </label>
      </td>
      <td>
        <textarea name="raison" id="raison" cols="40" rows="1" placeholder="(Facultatif)"></textarea>
      </td>
    </tr>
  </table>
  <input type="submit" name="Ajouter" value="Ajouter" class="sub-buton">
</form>
</center>
<?php
  if(isset($_POST['Ajouter'])){
    $_POST['sign'] = "'".$_POST['sign']."'";
    $_POST['raison'] = "'".$_POST['raison']."'";
    $ordre = "URLSignature, raison, IdE, IdAd";
    $valeurs = array("sign" => $_POST['sign'], "raison" => $_POST['raison'], "IdE" => $_POST['etud'], "IdAd" => $_POST['admin']);
    $unControleur -> setTable("Billet");
    $unControleur -> insert($ordre, $valeurs);
  }
?>