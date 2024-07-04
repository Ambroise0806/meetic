<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="form.css">
        <title>Page de connexion</title>
    </head> 
    <body>
    <form action="" method="post">
    <label for="email">E-mail :</label>
    <input type="email" id="email" name="email" required><br>

    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required><br>

    <input type="submit" value="Se connecter">
    <a href="view.php">Vous n'êtes pas encore inscrit ?</a>
    </form>
    <?php
class Connection {
    private $base;
    private $host = "localhost";
    private $dbName = "meetic";
    private $user = "ambroise";
    private $password = "youhou";

    public function __construct() {
        try {
            $this->base = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->password);
            $this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    function logIn($email, $mdp) {
        if ($email != "" && $mdp != "") {
            try {
                $stmt = $this->base->prepare("SELECT * FROM user WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    if (password_verify($mdp, $user['mdp'])) {
                        session_start();
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['nom'] = $user['nom'];
                        $_SESSION['prenom'] = $user['prenom'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['ville'] = $user['ville'];
                        $_SESSION['genre'] = $user['genre'];
                        $_SESSION['loisir'] = $user['loisir'];
                        $_SESSION['date'] = $user['date_naissance'];
                        header("Location: profil.php");
                        exit();
                    } else {
                        echo 'Mot de passe incorrect.';
                    }
                } else {
                    echo "L'utilisateur n'existe pas.";
                }
            } catch (Exception $e) {
                echo "Erreur lors de la connexion : " . $e->getMessage();
            }
        }
    }
}

$form = new Connection();
$form->logIn(
    $_POST['email'],
    $_POST['mdp']
);
?>
</body>
