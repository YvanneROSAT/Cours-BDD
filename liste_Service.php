<?php
 require("database/connectMysqlPDO.php");
?>
<?php 
// Récupération de tout les attributs de la table SERVICE
$resultObj = $Bdd->query( "SELECT * FROM service");
$listeService = $resultObj->fetchAll();
?>

