<h2>Modification d'un Cours</h2>
<?php
  $unControleur -> setTable("Classe");
  $lesClasses = $unControleur -> select_all();
  $unControleur -> setTable("Professeur");
  $lesProfesseurs = $unControleur -> select_all();
  $unControleur -> setTable("Matiere");
  $lesMatieres = $unControleur -> select_all();
?>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="classe">Classe : </label>
      </td>
      <td>
        <select name="classe" id="classe" required>
          <option value="<?php echo $leCours['IdCl'] ?>">Choisir une classe</option>
          <?php
            for($i=0; $i<=count($lesClasses)-1; $i++){
              $uneClasse = $lesClasses[$i];
              echo "<option value=".$uneClasse['IdCl'].">".$uneClasse['nom']."</option>";
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label for="prof">Professeur : </label>
      </td>
      <td>
        <select name="prof" id="prof" required>
          <option value="<?php echo $leCours['IdPf'] ?>">Choisir un professeur</option>
          <?php
            for($i=0; $i<=count($lesProfesseurs)-1; $i++){
              $unProfesseur = $lesProfesseurs[$i];
              echo "<option value=".$unProfesseur['IdPf'].">M/Mm ".$unProfesseur['nom']." ".$unProfesseur['prenom']."</option>";
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label for="matiere">Matière : </label>
      </td>
      <td>
        <select name="matiere" id="matiere" required>
          <option value="<?php echo $leCours['IdM'] ?>">Choisir une matière</option>
          <?php
            for($i=0; $i<=count($lesMatieres)-1; $i++){
              $uneMatiere = $lesMatieres[$i];
              echo "<option value=".$uneMatiere['IdM'].">".$uneMatiere['intitule']."</option>";
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label for="jour">Jour : </label>
      </td>
      <td>
        <input type="date" name="jour" id="jour" required>
      </td>
      <td>
        <label for="salle">Salle : </label>
      </td>
      <td>
        <input type="number" name="salle" id="salle" required>
      </td>
    </tr>
      <td>
        <label for="deb">Debute à : </label>
      </td>
      <td>
        <input type="time" name="deb" id="deb" required>
      </td>
      <td>
       <label for="fin">Finis à : </label>
      </td>
      <td>
        <input type="time" name="fin" id="fin" required>
      </td>
    </tr>
  </table>
  <input type="submit" name="Modifier" value="Modifier" class="sub-buton">
</form>
</center>