# formulaire_auth
Projet de création d'un formulaire d'authentification et de creéation de compte avec PHP et MySql de maniére sécurisée

##Téchnologie Utilisé:

j'ai utilisé du PHP pour le backend, du Mysql pour la base de donnée, le language SQL pour gérer cette derniére et du bootstrap pour le front

##Instruction d'execution du Projet:

1/ Il faut télécharger la base de donnée qui se trouve dans le fichier sql/db.sql avec la ligne de commande suivante: **sudo mysql -u root -p < chemin du projet sur votre machine/sql/db.sql**

2/ mettre a jour le fichier qui se trouve dans **lib/db.sql** en mettant vos identifiant Mysql afin de vous connecter a la base de donnée, ex: **$db = new PDO('mysql:host=localhost;dbname=Formulaire_Securise',' votre nom d'utilisateur Mysql "généralement c'est root" ','votre mot de passe MySql');**

3/C'est fait le site est operationnel
