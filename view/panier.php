<?php

$panier = $_SESSION['panier'] ?? [];
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voici le panier</title>
</head>

<body>
    <?php if (!empty($panier)): ?>
        
        <table>
            <thead>
                <tr>
                    <th colspan="4">Mon panier</th>
                    <th><button> Vider le panier</button></th>
                </tr>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($panier as $productId => $quantity): ?>
                    <tr>
                        <td><?= htmlspecialchars($productId) ?></td>
                        <td><?= htmlspecialchars($quantity) ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button>Valider la commande</button>
    <?php else: ?>
        <p>Votre panier est vide</p>
    <?php endif; ?>
    </tbody>




</body>
</html>