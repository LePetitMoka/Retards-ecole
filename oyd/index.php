<?php
	session_start();

	require_once("./controleur/bdd_config.php");
	require_once("./controleur/controleur.class.php");

	$unControleur = new Controleur($server, $user, $password, $bdd);
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
		$user = null;
		if(!isset($_SESSION['role'])){
			// require_once("./vues/connexion/connexion.php");
			echo '
				<section class="role-choice">
					<div class="container">
						<form method="post">
							<div class="role-admin">
								<label for="admin">
									<img src="./img/icons colorées/administrateur.png">
									<p>Administrateur</p>
								</label>
								<input type="submit" name="role" value="admin" id="admin">
							</div>
							<div class="role-prof">
								<label for="prof">
									<img src="./img/icons colorées/professeur.png">
									<p>Professeur</p>
								</label>
								<input type="submit" name="role" value="prof" id="prof">
							</div>
							<div class="role-etudiant">
								<label for="etudiant">
									<img src="./img/icons colorées/etudiant.png">
									<p>Etudiant</p>
								</label>
								<input type="submit" name="role" value="etudiant" id="etudiant">
							</div>
						</form>
					</div>
				</section>
			';
			if(isset($_POST['role'])){
				$_SESSION['role'] = $_POST['role'];
			}
		}
		if(isset($_SESSION['role'])) {
			require_once("./sub-index.php");
		}
	?>
</body>
</html>