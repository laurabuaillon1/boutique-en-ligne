<?php 

require_once __DIR__ . '/layout/header.php';

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>

<body>
    <img src="../images/portrait_cheval.jpg" alt="Portrait d'un cheval alezan portant un filet de la marque petit trot" width="800" height="500">
    
    <h1>Liste des nos produits</h1>
    <div>
        <ul> 
            <?php foreach ($produits as $produit): ?>
                <li>
                    <img src="../images/bridons.jpg" alt="bridon en cuir de vachette taille cheval">
                    <strong><?= $produit ->getNom() ?></strong>
                    <p><?= $produit->getDescription() ?></p>
                    <p><?= $produit->getPrix() ?></p>
                    <a href="?page=form-ajout">Ajouter un produit</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
</body>
</html>