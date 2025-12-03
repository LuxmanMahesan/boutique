<h1>Historique des achats</h1>

<p>Bonjour <?= htmlspecialchars($user['nom']) ?> !</p>
<p><a href="?page=articles">Retour aux articles</a></p>

<?php if(empty($achats)): ?>
    <p>Vous n'avez effectué aucun achat.</p>
<?php else: ?>
    <table border="1" width="100%">
        <thead>
        <tr>
            <th>Article</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Total</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($achats as $a): ?>
            <tr>
                <td><?= htmlspecialchars($a['article']) ?></td>
                <td><?= $a['montant'] ?></td>
                <td><?= $a['quantite'] ?></td>
                <td><?= $a['montant'] * $a['quantite'] ?></td>
                <td><?= $a['date_achat'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
