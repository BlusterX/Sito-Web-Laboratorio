<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Blog TW - Articoli Categoria";
$templateParams["nome"] = "lista-articoli.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$idcategoria = -1;
if(isset($_GET["id"])){
    $idcategoria = $_GET["id"];
}
$nomecategoria = $dbh->getCategoryById($idcategoria);
if(count($nomecategoria)>0){
    $templateParams["titolo_pagina"] = "Articoli della categoria ".$nomecategoria[0]["nomecategoria"];
    $templateParams["articoli"] = $dbh->getPostByCategory($idcategoria);
}
else{
    $templateParams["titolo_pagina"] = "Categoria non trovata"; 
    $templateParams["articoli"] = array();   
}

require 'template/base.php';
?>