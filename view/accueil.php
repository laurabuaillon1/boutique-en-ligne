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
        <img src="./images/portrait_cheval.jpg" alt="Portrait d'un cheval alezan portant un filet de la marque petit trot" width="800" height="500">
        
        <h1>Liste des nos produits</h1>
        <div>
            <ul>
                <?php foreach ($produits as $produit): ?>
                    <li>
                        <img src="./images/<?=htmlspecialchars($produit->getImage()) ?>" alt="<?= htmlspecialchars($produit->getName()) ?>" width="200" height="200">
                        <h3><?= htmlspecialchars($produit->getName()) ?></h3>
                        <p><?= htmlspecialchars($produit->getDescription()) ?></p>
                        <p><?= htmlspecialchars($produit->getPrix()) ?></p>
                        
                        <form method="POST" action="?page=ajouter-au-panier">
                            <input type="hidden" name="productId" value="<?= $produit->getId() ?>">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                            <button type="submit">Ajouter au panier</button>
                        </form>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
        </body>
        
        <?= require_once __DIR__ . '/layout/footer.php'; ?>
        </html>