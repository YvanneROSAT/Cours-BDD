<?php
// Variable de connexion
$user = "root";
$pass = "";
//  connexion à la base de donnée
try {
    // Céation de l'intance PDO
    $Bdd = new PDO('mysql:host=localhost;dbname=db_entreprise', $user, $pass);
    $Bdd->query("SET NAMES UTF8");
} catch (exception $e) {
    // Si une erreur se produit ce code nous retourne la valeur de l'erreur
    die('Une erreur a été trouver : ' . $e->getMessage());
}
