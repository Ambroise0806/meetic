
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
    <input type="text" id="prenom" name = "prenom" required><br>

    <label for="dateNaissance">Date de naissance :</label>
    <input type="date" id="date" name="date" required><br>

    <label>Genre :</label>
    <input type="radio" id="homme" name="genre" value="homme" required>
    <label for="homme">Homme</label>
    <input type="radio" id="femme" name="genre" value="femme" required>
    <label for="femme">Femme</label>
    <input type="radio" id="autre" name="genre" value="autre" required>
    <label for="autre">Autre</label><br>

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
    <a href="connection.php">Vous avez déja un compte ?</a>
</form>
<?php
class Formulaire {
    private $base;
    private $nom;
    private $prenom;
    private $date;
    private $genre;
    private $ville;
    private $email;
    private $mdp;
    private $loisir;
    private $host = "localhost";
    private $dbName = "meetic";
    private $user = "ambroise";
    private $password = "youhou";

    public function __construct() {
        try {
            $this->base = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->password);
            $this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    
    function user($nom, $prenom, $date, $genre, $ville, $email, $mdp, $loisir) {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        if ($nom != "" && $prenom != "" && $date != "" && $genre != "" && $ville != "" && $email != "" && $mdp != "" && $loisir != "") {
            echo "hello";
            $query = $this->base->prepare("INSERT INTO user (nom, prenom, date_naissance, genre, ville, email, mdp, loisir) VALUES ('$nom', '$prenom','$date', '$genre', '$ville', '$email','$hash', '$loisir')");
            $query->execute();
            echo "Insertion réussie";
        } else {
            echo "Des champs sont vides";
        }
    }
}
    $form = new Formulaire();
    $form->user(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['date'],
        $_POST['genre'],
        $_POST['ville'],
        $_POST['email'],
        $_POST['mdp'],
        $_POST['loisir']
    );

?>
</div>
</body>
</html>