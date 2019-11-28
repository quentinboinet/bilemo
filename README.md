# BileMo
Dépôt contenant le code pour le projet 7 du parcours développeur d'applications PHP d'OpenClassrooms.

<a href="https://codeclimate.com/github/quentinboinet/bilemo/maintainability"><img src="https://api.codeclimate.com/v1/badges/c249794c88f741bb8d5e/maintainability" /></a>

<h1>Instructions d'installation :</h1>

<p>
  <ol>
    <li>Clonez ou téléchargez le contenu du dépôt GitHub : <i>git clone https://github.com/quentinboinet/bilemo.git</i></li>
    <li>Editez le fichier situé à la racine intitulé ".env" afin de remplacer les valeurs de paramétrage de la base de données.</li>
    <li>Installez les dépendances du projet avec : <i>composer install</i></li>
    <li>Créez la base de données avec la commande suivante : <i>php bin/console doctrine:database:create</i></li>
    <li>Lancer les migrations avec la commande : <i>php bin/console doctrine:migrations:migrate</i></li>
    <li>Importez ensuite le jeu de données initiales avec : <i>php bin/console hautelook:fixtures:load</i></li>
      <li>Afin de lancer le serveur, lancez la commande <i>php bin/console server:run</i></li>
      </ol>   
   Bravo, votre API est désormais accessible à l'adresse : localhost:8000 !
   Vous pouvez la tester via Postman ou tout autre outil de votre choix.
   
   Je vous invite de même à lire le wiki sur l'onglet "Wiki" afin d'en savoir plus.
</p>
