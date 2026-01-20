<?php

use Dom\Attr;

function getPDO(): PDO {

    try {
        //INSTANCE DE LA BDD
        $pdo = new PDO('mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8mb4', 'root', '');

        //AFFICHE DES EXECPTION EN CAS D'ERREUR
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo;
        echo "connexion réussie !";
        
    } catch (PDOException $e) {
        //GESTION DES ERREURS DE CONNEXION
        die("Erreur de connexion" . $e->getMessage());
    }
}
