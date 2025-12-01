<h1>Panier</h1>

<?php if (empty($panier)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <?php foreach ($panier as $id => $qte): ?>
        <p>Article ID : <?= $id ?> — Quantité : <?= $qte ?></p>
    <?php endforeach; ?>
<?php endif; ?>
