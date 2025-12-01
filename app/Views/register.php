<h1>Inscription</h1>

<?php if (!empty($erreur)) echo "<p style='color:red'>$erreur</p>"; ?>

<form method="post">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="mdp" required><br><br>

    <button type="submit">S'inscrire</button>
</form>
