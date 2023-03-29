<?php
	session_start();
	
	require_once("./controleur/controleur.class.php");
	require_once("./controleur/Connexion.class.php");
	$unControleur = Connexion::getConnexion(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./img/favicon_io/favicon-32x32.png">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/header.css">
	<link rel="stylesheet" href="./css/footer.css">
	<link rel="stylesheet" href="./css/vertical-navbar.css">
	<link rel="stylesheet" href="./css/content.css">
	<link rel="stylesheet" href="./css/connexion.css">
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,500,600,700&amp;display=swap" rel="stylesheet">
	<script src="./js/script.js" defer></script>
	<title>GREI</title>
</head>
<body>
	<?php
		if(!isset($_SESSION['id'])){
			if(isset($_SESSION['role'])){
				switch ($_SESSION['role']) {
					case 'Administrateur':
						require_once("./vues/connexion/connexion_admin.php");
						break;
					// case 'Professeur':
					//   require_once("./connexion_prof.php");
					//   break;
					case 'Etudiant':
					  require_once("./vues/connexion/connexion_etudiant.php");
					  break;
					
					default:
						unset($_SESSION['role']);
						header("location:index.php");
						break;
				}
			} else {
				require_once("./vues/connexion/connexion.php");
			}
		}
		if(isset($_SESSION['id'])) {
			require_once("./sub-index.php");
		}
	?>
</body>
</html>