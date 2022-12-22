Le présent dossier contient des fichiers destinés à n'être utilisés 
que lors de l'établissement de la BDD. Il n'est pas nécessaire
de les conserver sur le serveur une fois cela fait.


Informations utiles sur les entités:
    - Les arrets de type bus peuvent avoir le meme nom, elles n'ont cependant pas le meme Id et sont donc differentes.
        Il n'y a pour l'instant pas de "bonne" façon de differencier les doublons lorsqu'ils sortent en select (les criteres existent mais impliquent l'existence de nouvelles tables et l'importation d'autres jeux de données)
        Ceci n'est cependant pas important car les infos trafic qui remontent dans l'API sont des lignes ferrées (apres constat, à voir cependant dans le futur).
