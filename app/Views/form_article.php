<h2><?= isset($article) ? "Modifier" : "Ajouter" ?> un article</h2>

<form method="post">
    <label>Nom : <input type="text" name="nom" value="<?= $article['nom'] ?? '' ?>" required></label><br>
    <label>Prix : <input type="number" name="montant" value="<?= $article['montant'] ?? '' ?>" required></label><br>
    <label>Quantité : <input type="number" name="quantite" value="<?= $article['quantite'] ?? '' ?>" required></label><br>
    <label>Description : <textarea name="description"><?= $article['description'] ?? '' ?></textarea></label><br>
    <button type="submit">Valider</button>
</form>
