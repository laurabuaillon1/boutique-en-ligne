<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voici le panier</title>
</head>
<body>
    <h1>Mon panier</h1>
    <thead>
        <tr>Produits</tr>
        <tr>Quantités</tr>
        <tr>Total</tr>
    </thead>

    <tbody>
        <?php foreach ($panier as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item->getProductId()) ?></td>
            <td><?= htmlspecialchars($item->getQuantity())  ?></td>
            
        </tr>
        <?php endforeach; ?>
    </tbody>

    
    
    
</body>
</html>