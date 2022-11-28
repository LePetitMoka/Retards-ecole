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
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,500,600,700&amp;display=swap" rel="stylesheet">
	<script src="./js/script.js" defer></script>
	<title>GREI</title>
</head>
<body>
	<header>
		<div class="container">
			<div class="burger-bar">
				<button class="burger" id="burger"><span class="bar"></span></button>
			</div>
			<div class="buttons">
				<div class="user_icon">
					<a href="">
						<img src="./img/icons colorées/admin.png" width="60" height="60">
					</a>
				</div>
				<div class="Deconnection">
					<a href="">
						<img src="./img/icons colorées/deconnexion.png" width="60" height="60">
					</a>
				</div>
			</div>
		</div>
	</header>
	<section class="vertical-navbar">
		<div class="container">
			<ul class="menu unstyled-list">
				<?php require_once("./vues/navbar/nav-admin.php"); ?>
			</ul>
		</div>
	</section>
	<section class="content">
	<?php
		if(isset($_GET['user'])){
			$user = $_GET['user'];
			switch ($user) {
				case 'amdin':
					if(isset($_GET['page'])){
						$page = $_GET['page'];
						switch ($page) {
							case 0:
								require_once("./vues/tableau_de_bord/tdb-admin.php");
								break;
							// case 1:
							// 	require_once("./vues/tableau_de_bord/tdb-admin.php");
							// 	break;
							// case 2:
							// 	require_once("./vues/tableau_de_bord/tdb-admin.php");
							// 	break;
							// case 3:
							// 	require_once("./vues/tableau_de_bord/tdb-admin.php");
							// 	break;
							// case 4:
							// 	require_once("./vues/tableau_de_bord/tdb-admin.php");
							// 	break;
							
							default:
								require_once("./vues/tableau_de_bord/tdb-admin.php");
								break;
						}
					}
					break;
				// case 'prof':
				// 	# code...
				// 	break;
				// case 'etudiant':
				// 	# code...
				// 	break;
				
				default:
					require_once("./vues/tableau_de_bord/tdb-admin.php");
					break;
			}
		}
	?>
	</section>
	<footer>
		<div class="container">
			<div class="contacts">
				<div class="phone">
					<img src="./img/icons colorées/telephone.png" width="60" height="60">
					<p class="diff-font">+33(0)144018670</p>
				</div>
				<div class="mail">
					<a href="mailto:contact@ecoleiris.fr">
						<img src="./img/icons colorées/email.png" width="60" height="60">
						<p class="diff-font">contact@ecoleiris.fr</p>
					</a>
				</div>
				<div class="link">
					<a href="https://ecoleiris.fr/" target="_blank">
						<img src="./img/icons colorées/lien.png" width="60" height="60">
						<p class="diff-font">https://ecoleiris.fr/</p>
					</a>
				</div>
			</div>
			<div class="copyrights">
				<p>Copyright © <?php echo date("Y"); ?> GREI IRIS. All Rights Reserved.<p>
			</div>
		</div>
	</footer>
</body>
</html>