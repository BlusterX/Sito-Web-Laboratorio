<?php

//include db
require_once("bootstrap.php");
$templateParams["titolo"] = "Blog TW - Home";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articoli"] = $dbh->getPosts(2);
$templateParams["nome"] = "lista-articoli.php"; 
require("template/base.php");


?>