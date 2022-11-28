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
	<title>GREI</title>
</head>
<body>
	<header>
		<div class="container">
			<div class="burger">
				<button class="burger"><span class="bar">-</span></button>
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
				<li><a href="">Tableau de bord</a></li>
				<li><a href="">Messagerie</a></li>
				<li><a href="">Gestion de données</a></li>
				<li><a href="">Compte</a></li>
				<li><a href="">Deconnexion</a></li>
			</ul>
		</div>
	</section>
	<footer>
		<div class="container">
			<div class="contacts">
				<div class="phone-mail">
					<div class="phone">
						<img src="./img/icons colorées/telephone.png" width="60" height="60">
						<p>+33(0)144018670</p>
					</div>
					<div class="mail">
						<a href="mailto:contact@ecoleiris.fr">
							<img src="./img/icons colorées/email.png" width="60" height="60">
							<p>contact@ecoleiris.fr</p>
						</a>
					</div>
				</div>
				<div class="link">
					<a href="https://ecoleiris.fr/" target="_blank">
						<img src="./img/icons colorées/lien.png" width="60" height="60">
						<p>https://ecoleiris.fr/</p>
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