<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="form.css">
        <title>Formulaire d'inscription</title>
    </head>
    <body>

    <form action="" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="dateNaissance">Date de naissance :</label>
        <input type="date" id="date" name="date" required><br>

        <div class="gender-options">
        <label>Genre :</label>
        <div class="gender-inputs">
            <input type="radio" id="homme" name="genre" value="homme" required>
            <label for="homme">Homme</label>
        </div>
        <div class="gender-inputs">
            <input type="radio" id="femme" name="genre" value="femme" required>
            <label for="femme">Femme</label>
        </div>
        <div class="gender-inputs">
            <input type="radio" id="autre" name="genre" value="autre" required>
            <label for="autre">Autre</label>
        </div>
    </div>

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" required><br>

        <label for="email">E-mail :</label>
        <input type="email" id="email" name="email" required><br>

        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required><br>

        <label for="loisir">Loisir :</label>
        <select id="loisir" name="loisir" required>
            <option value="sport">Sport</option>
            <option value="lecture">Lecture</option>
            <option value="musique">Musique</option>
            <option value="voyage">Voyage</option>
        </select><br>

        <!-- <input type="checkbox" id="ageVerification" name="ageVerification" required>
        <label for="ageVerification">Je confirme que j'ai plus de 18 ans</label><br> -->
<input type="submit" value="S'inscrire">
        <a href="connection.php">Vous avez déjà un compte ?</a>
    </form>

    </body>
</html>
