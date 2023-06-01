# Retards-ecole
## Guide d'installation 

On peut se connecter à la machine à distance avec VSCode (extension remote server)

Ou se connecter avec filezila (sftp://[ip]) pour le transfert de fichiers

ssh -p 13390 debian@[ip]

Mdp (par défaut) : ********


MAJ

	apt update
	apt upgrade


Installer serveur LAMP si ce n'est pas déjà fait, puis les extensions php
	
	sudo apt install php-mysql
	sudo apt-get install php-curl (pour l'API)
	systemctl restart apache2


Si pas de connexion verifier la résolution de domaine (souvent le cas sur plateforme école)

	vim /etc/resolv.conf

	ajouter 8.8.8.8 ou 1.1.1.1 s'il n'y sont pas
		
		dns-nameserver 8.8.8.8

	ou
		
		dns-nameserver 1.1.1.1
	
	le(s) placer au dessus des autres dns pour le(s) rendre prioritaire(s)


Transfert de fichiers FTP

	Placer le dossier du site (GREI) dans /var/www/

	Placer le dossier Scripts à la racine

Donner les droit de lecture écriture (Important):

	sudo chmod -R 777 /var/www/GREI
	sudo chmod -R 777 /Scripts

Configurer le php.ini :

	vim /etc/php/7.4/apache2/php.ini

	Decommenter les extensions : pdo, curl, mysqli
	Modifier display_errors = On
	Verifier que error_reporting = E_ALL au moins


Lancer l'installation sécurisée mysql

	Sudo mysql_secure_installation
	N
	Y
	root
	N
	N
	N
	Y

Créer l'utilisateur SQL

	mysql -u root -p
	grant all privileges on *.* to "[user]"@"%" identified by "[password]";
	flush privileges;

Déploiement de la base

	Suivre les instructions du README.txt dans le dossier GREI/BDD


Modifier le fichier de configuration du site apache 

	vim /etc/apache2/sites-available/[nomdusite].conf
	
	En reprenant le modele de 000-default.conf

	Modifier la ligne du repertoire par défaut (mettre le chemin du dossier GREI à la place)

	Activer le site
		
		a2dissite [nomanciensite] (souvent 000-default.conf)
		a2ensite [nomdusite] (GREI.conf par exemple)


Augmenter la taille des paquets SQL dans le my.ini (très optionnel, en cas de bug ?)

	vim /etc/mysql/my.cnf
	rajouter :

	[mysqld]

	max_allowed_packet = 10000000

Configurer SQL (CLOUD):

	sudo vim /etc/mysql/my.cnf

	décommenter la ligne du port

	aller dans mariadb.conf.d (present dans le dossier mysql)

	puis ouvrir : vim 50-server.cnf

	commenter la ligne "bind-adress"

Configurer le pare-feu Formacloud (CLOUD):

	ouvrir l'interface d'administration (clic sur l'adresse ip)
	se connecter:
	
		user: root
		mdp: *******

	Aller dans Pare-feu > NAT > Redirection de port
	Dupliquer la règle du port 13390
	Modifier la plage de ports de destination : de 13392 à 13392
	Modifier rediriger le port cible à (autres) et rentrer 3306
	Modifier la description de la règle : "Autorise le port mySQL"

Configurer la tache CRON

	crontab -e

	rajouter la ligne:
	
		*/5 * * * * /usr/bin/php /Scripts/traitement.php > /Scripts/logs.txt


Données test API (si l'API ne fonctionne plus):

  load data infile "/var/www/GREI/BDD/Sources/perturbtest.csv" into table Perturbation fields terminated by '|';

  load data infile "/var/www/GREI/BDD/Sources/concerntest.csv" into table Concerner fields terminated by '|';

ET NE PLUS EXECUTER traitement.php ! (Efface les données de la base) 
Donc EFFACER la tache cron si elle est encore active.

Verification des identifiants de connexion (!) :

	Dans

		/Scripts/bdd_config.php (remplacer identifiants SQL et le jeton d'API !)

		/var/www/GREI/controleur/bdd_config.php (identifiants SQL)

		/var/www/GREI/controleur/Connexion.class.php (identifiants SQL)

Verification des chemins (!) :

	Souvent des erreurs car les chemins n'ont pas été changés dans les fichiers sql sourcés.


