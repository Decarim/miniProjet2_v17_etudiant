<?php
//***************************************
// Montage des controleurs sur le routeur
$app->mount("/", new App\Controller\IndexController($app));
$app->mount("/produit", new App\Controller\ProduitController($app));
$app->mount("/panier", new App\Controller\PanierController($app));
$app->mount("/client", new App\Controller\clientController($app));
$app->mount("/commande", new App\Controller\commandeController($app));
$app->mount("/commentaire", new App\Controller\CommentaireController($app));
$app->mount("/connexion", new App\Controller\UserController($app));
