<h1>Mon panier</h1>

<?php if (!empty($_SESSION['msg_panier'])): ?>
    <p style="color:green;"><?= $_SESSION['msg_panier']; unset($_SESSION['msg_panier']); ?></p>
<?php endif; ?>

<?php if (empty($articles)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <table border="1">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php $totalPanier = 0; ?>
        <?php foreach ($articles as $a): ?>
            <tr>
                <td><?= htmlspecialchars($a['info']['nom']) ?></td>
                <td><?= $a['info']['montant'] ?></td>
                <td><?= $a['quantite'] ?></td>
                <td><?= $a['info']['montant'] * $a['quantite'] ?></td>
            </tr>
            <?php $totalPanier += $a['info']['montant'] * $a['quantite']; ?>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td><?= $totalPanier ?></td>
        </tr>
        </tfoot>
    </table>
    <form method="post" action="?page=valider_panier">
        <button type="submit">Valider l'achat</button>
    </form>
<?php endif; ?>
