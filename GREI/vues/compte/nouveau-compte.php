<br/><br/>
<h2>Nouveau compte</h2>
<center>
<?php
  if(isset($_POST['role'])){
    $rolef = $_POST['role'];
    var_dump($rolef);

    echo "<h3>Compte ".$_POST['role']."</h3>";
    echo "<form method='post'>";
    echo "<table>";
    echo "<tr>";
    echo "<td><label for='nom'>Nom :</label></td>";
    echo "<td>";
    echo "<input type='text' name='nom' id='nom'>";
    echo "</td>";
    echo "<td><label for='prenom'>Prenom :</label></td>";
    echo "<td>";
    echo "<input type='text' name='prenom' id='prenom'>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><label for='tel'>Téléphone :</label></td>";
    echo "<td>";
    echo "<input type='text' name='tel' id='tel'>";
    echo "</td>";
    echo "<td><label for='adresse'>Adresse :</label></td>";
    echo "<td>";
    echo "<input type='text' name='adresse' id='adresse'>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><label for='email'>Email :</label></td>";
    echo "<td>";
    echo "<input type='text' name='email' id='email'>";
    echo "</td>";
    echo "<td><label for='mdp'>Mot de passe :</label></td>";
    echo "<td>";
    echo "<input type='text' name='mdp' id='mdp'>";
    echo "</td>";
    echo "</tr>";
    if($rolef == "professeur"){
      echo "<tr>";
      echo "<td><label for='diplome'>Diplome :</label></td>";
      echo "<td><input type='text' name='diplome' id='diplome'></td>";
      echo "</tr>";
    }elseif($rolef == "etudiant"){
      $unControleur -> setTable("Classe");
      $lesClasses = $unControleur -> select_all();
      echo "<tr>";
      echo "<td><label for='classe'>Classe : </label></td>";
      echo "<td><select name='classe' id='classe'>";
      for($i=0; $i<=count($lesClasses)-1; $i++){
        $uneClasse = $lesClasses[$i];
        echo "<option value=".$uneClasse['IdCl'].">".$uneClasse['nom']."</option>";
      }
      echo "</select>";
      echo "</td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "<input type='hidden' name='rolef' value=".$rolef.">";
    echo "<br/><br/>";
    echo "<input type='submit' value='annuler' name='RechoixRole' class='buton'>";
    echo "<input type='submit' value='Confirmer' name='CreerCompte' class='buton'>";
    echo "<br/><br/>";
    echo "<input type='submit' value='Retourner à l acceuil' name='AConnexion' class='buton'>";
    echo "</form>";
  }elseif(!isset($_POST['role'])){
    echo "<form method='post'>";
    echo "Vous étes :";
    // echo "<input type='radio' name='role' value='administrateur' id=ad'>";
    // echo "<label for='ad'>Administrateur</label>";
    echo "<input type='radio' name='role' value='professeur' id='pf'>";
    echo "<label for='pf'>Professeur</label>";
    echo "<input type='radio' name='role' value='etudiant' id='et'>";
    echo "<label for='et'>Etudiant</label>";
    echo "<br/><br/>";
    echo "<input type='submit' value='Retourner à l acceuil' name='AConnexion' class='buton'>";
    echo "<input type='submit' value='Continuer' name='Comfrole' class='buton'>";
    echo "</form>";
  }if(isset($_POST['CreerCompte'])){
    $nom = "'".$_POST['nom']."'";
    $prenom = "'".$_POST['prenom']."'";
    $tel = "'".$_POST['tel']."'";
    $adresse = "'".$_POST['adresse']."'";
    $email = "'".$_POST['email']."'";
    $mdp = "'".$_POST['mdp']."'";
    $rolef = $_POST['rolef'];

    echo "compte creer <br/>";
    echo "nom : ".$nom."<br/>";
    echo "prenom : ".$prenom."<br/>";
    echo "tel : ".$tel."<br/>";
    echo "adresse : ".$adresse."<br/>";
    echo "email : ".$email."<br/>";
    echo "mdp : ".$mdp."<br/>";

    switch($rolef){
      case 'administrateur':
        $ordre = "IdAd, nom, prenom, telephone, adresse, email, mdp";
        $valeurs = array("nom"=>$nom, "prenom"=>$prenom, "telephone"=>$tel, "adresse"=>$adresse, "email"=>$email, "mdp"=>$mdp);
        $unControleur -> setTable("Administrateur");
        $unControleur -> nouveau_compte($ordre, $valeurs);
        echo "role : ".$rolef."<br/>";
        break;
      case 'professeur':
        $diplome = "'".$_POST['diplome']."'";
        $ordre = "IdPf, nom, prenom, telephone, adresse, email, mdp, diplome";
        $valeurs = array("nom"=>$nom, "prenom"=>$prenom, "telephone"=>$tel, "adresse"=>$adresse, "email"=>$email, "mdp"=>$mdp, "diplome"=>$diplome);
        $unControleur -> setTable("Professeur");
        $unControleur -> nouveau_compte($ordre, $valeurs);
        echo "diplome : ".$diplome."<br/>";
        echo "role : ".$rolef."<br/>";
        break;
      case 'etudiant':
        $IdCl = $_POST['classe'];
        $ordre = "IdE, nom, prenom, telephone, adresse, email, mdp, IdCl";
        $valeurs = array("nom"=>$nom, "prenom"=>$prenom, "telephone"=>$tel, "adresse"=>$adresse, "email"=>$email, "mdp"=>$mdp, "IdCl"=>$IdCl);
        $unControleur -> setTable("Etudiant");
        $unControleur -> nouveau_compte($ordre, $valeurs);
        echo "Classe : ".$IdCl."<br/>";
        echo "role : ".$rolef."<br/>";
        break;
    }
  }
  if(isset($_POST['RechoixRole'])){
    unset($_POST['role']);
  }
?>
</center>