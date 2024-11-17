<?php
require_once 'bootstrap.php';
$templateParams["titolo"] = "Blog TW - Archivio";
$templateParams["nome"] = "lista-articoli.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["articoli"] = $dbh->getPosts();
require 'template/base.php';
?>