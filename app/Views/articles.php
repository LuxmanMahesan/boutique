<h1>Articles</h1>
<p><a href="?page=ajouter_article">Ajouter un article</a></p>

<?php if ($user): ?>
    <p>Bonjour <?= htmlspecialchars($user['nom']) ?> ! Solde : <span id="solde"><?= htmlspecialchars($wallet['solde']) ?></span> crédits</p>
    <p><a href="?page=logout">Se déconnecter</a></p>
<?php endif; ?>

<?php if(!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

<div style="margin-bottom:10px;">
    <input type="text" id="rechercheNom" placeholder="Recherche par nom...">
    <input type="text" id="rechercheCategorie" placeholder="Recherche par catégorie...">
    <input type="number" id="rechercheStock" placeholder="Stock min">
</div>

<table border="1" width="100%" id="tableArticles">
    <thead>
    <tr>
        <th data-col="nom">Nom</th>
        <th data-col="categorie">Catégorie</th>
        <th data-col="montant">Prix</th>
        <th data-col="quantite">Stock</th>
        <th data-col="description">Description</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($articles as $a): ?>
        <tr class="article"
            data-nom="<?= strtolower($a['nom']) ?>"
            data-categorie="<?= strtolower($a['categorie']) ?>"
            data-montant="<?= $a['montant'] ?>"
            data-quantite="<?= $a['quantite'] ?>">
            <td><?= htmlspecialchars($a['nom']) ?></td>
            <td><?= htmlspecialchars($a['categorie']) ?></td>
            <td><?= $a['montant'] ?></td>
            <td><?= $a['quantite'] ?></td>
            <td><?= htmlspecialchars($a['description']) ?></td>
            <td>
                <?php if($user): ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="article_id" value="<?= $a['id'] ?>">
                        <button type="submit" name="acheter">Acheter</button>
                    </form>
                <?php endif; ?>
                <a href="?page=modifier_article&id=<?= $a['id'] ?>">Modifier</a> |
                <a href="?page=supprimer_article&id=<?= $a['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const lignes = Array.from(document.querySelectorAll("#tableArticles tbody tr"));
        const rechercheNom = document.getElementById("rechercheNom");
        const rechercheCategorie = document.getElementById("rechercheCategorie");
        const rechercheStock = document.getElementById("rechercheStock");

        // Filtrage dynamique
        function filtrer() {
            const nom = rechercheNom.value.toLowerCase();
            const cat = rechercheCategorie.value.toLowerCase();
            const stockMin = parseInt(rechercheStock.value) || 0;

            lignes.forEach(l => {
                const matchNom = l.dataset.nom.includes(nom);
                const matchCat = cat === "" || l.dataset.categorie.includes(cat);
                const matchStock = parseInt(l.dataset.quantite) >= stockMin;

                l.style.display = (matchNom && matchCat && matchStock) ? "" : "none";
            });
        }

        rechercheNom.addEventListener("input", filtrer);
        rechercheCategorie.addEventListener("input", filtrer);
        rechercheStock.addEventListener("input", filtrer);

        // Tri par clic sur l'en-tête
        document.querySelectorAll("#tableArticles th[data-col]").forEach(th => {
            th.addEventListener("click", () => {
                const col = th.dataset.col;
                const tbody = th.closest("table").querySelector("tbody");
                const sorted = lignes.slice().sort((a, b) => {
                    let valA = a.dataset[col];
                    let valB = b.dataset[col];
                    if (!isNaN(valA) && !isNaN(valB)) return valA - valB; // tri numérique
                    return valA.localeCompare(valB); // tri texte
                });
                sorted.forEach(tr => tbody.appendChild(tr));
            });
        });
    });
</script>
