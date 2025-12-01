<h1>Connexion</h1>

<?php if (!empty($erreur)) echo "<p style='color:red'>$erreur</p>"; ?>

<form method="post">
    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="mdp" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<p><a href="/?page=register">Créer un compte</a></p>
