<h1>Articles</h1>

<?php if ($user): ?>
    <p id="bonjour">Bonjour <?= htmlspecialchars($user['nom']) ?> ! Solde : <span id="solde"><?= htmlspecialchars($wallet['solde']) ?></span> crédits</p>
    <p><a href="?page=logout">Se déconnecter</a></p>
<?php else: ?>
    <p><a href="?page=login">Connexion</a> | <a href="?page=register">Inscription</a></p>
<?php endif; ?>

<div id="toast" style="display:none; position:fixed; top:10px; right:10px; padding:10px; background:green; color:white; border-radius:5px;"></div>

<?php foreach ($articles as $a): ?>
    <div class="article" style="border:1px solid #ccc; margin:5px; padding:5px;" data-id="<?= $a['id'] ?>">
        <h3><?= htmlspecialchars($a['nom']) ?></h3>
        <p>Prix : <span class="prix"><?= $a['montant'] ?></span> crédits</p>
        <p>Stock : <span class="stock"><?= $a['quantite'] ?></span></p>
        <?php if ($a['description']): ?>
            <p><?= htmlspecialchars($a['description']) ?></p>
        <?php endif; ?>

        <?php if ($user): ?>
            <form method="post" action="?page=articles" class="acheterForm">
                <input type="hidden" name="article_id" value="<?= $a['id'] ?>">
                <button type="submit" name="acheter">Acheter</button>
            </form>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toast = document.getElementById('toast');

        // Confirmation avant achat
        document.querySelectorAll('.acheterForm').forEach(form => {
            form.addEventListener('submit', e => {
                if(!confirm("Voulez-vous vraiment acheter cet article ?")){
                    e.preventDefault();
                }
            });
        });

        // Affichage du message après reload (si $message existe)
        const message = "<?= $message ?? '' ?>";
        if(message){
            toast.textContent = message;
            toast.style.display = 'block';
            setTimeout(() => toast.style.display = 'none', 3000);
        }

        // Optionnel : mise à jour du stock et solde côté client
        <?php if(isset($user) && !empty($_POST['acheter']) && isset($articleId)): ?>
        const articleDiv = document.querySelector(`.article[data-id='<?= $articleId ?>']`);
        if(articleDiv){
            const stockSpan = articleDiv.querySelector('.stock');
            stockSpan.textContent = Math.max(0, parseInt(stockSpan.textContent) - 1);

            const soldeSpan = document.getElementById('solde');
            soldeSpan.textContent = <?= $wallet['solde'] ?>;
        }
        <?php endif; ?>
    });
</script>
