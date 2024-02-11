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
class connection {
    private $base;
    private $email;
    private $mdp;
    private $host = "localhost";
    private $dbName = "meetic";
    private $user = "ambroise";
    private $password = "youhou";
    public function __construct() {
        try {
            $this->base = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->password);
            $this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Connectaymerictrinh@hotmail.comion failed: " . $e->getMessage();
        }
    }
    function connect($email, $mdp, $hash) {
        $pd = password_verify($mdp, $hash);
        // var_dump($hash);
        $con = $this->base->prepare("SELECT * FROM user WHERE email LIKE '$email' AND mdp LIKE '$hash'");
        $con->execute(); 
        var_dump($con);
        $user = $con->fetchAll();
        print_r($user);
        if ($user) {
            echo "email existe";
        } else {
            echo "email n'existe pas";
        }
    } 
}
    $form = new connection();
    $form->connect(
        $_POST['email'],
        $_POST['mdp'],
    );
?>
    </body>
