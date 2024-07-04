<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: connection.php");
    exit();
}

class User {
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

    function search($genre, $ville, $loisir, $age) {
        try {
            $query = "SELECT * FROM user WHERE 1";
            $params = array();

            if ($genre != "") {
                $query .= " AND genre = :genre";
                $params[':genre'] = $genre;
            }
            if ($ville != "") {
                $query .= " AND ville = :ville";
                $params[':ville'] = $ville;
            }
            if ($loisir != "") {
                $query .= " AND loisir = :loisir";
                $params[':loisir'] = $loisir;
            }
            if ($age != "") {
                list($minAge, $maxAge) = explode('-', $age);
                $minBirthDate = date('Y-m-d', strtotime("-$maxAge years"));
                $maxBirthDate = date('Y-m-d', strtotime("-$minAge years"));
                $query .= " AND date_naissance BETWEEN :minBirthDate AND :maxBirthDate";
                $params[':minBirthDate'] = $minBirthDate;
                $params[':maxBirthDate'] = $maxBirthDate;
            }

            $stmt = $this->base->prepare($query);
            $stmt->execute($params);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (Exception $e) {
            echo "Erreur lors de la recherche : " . $e->getMessage();
            return false;
        }
    }
}

$form = new User();
$users = $form->search($_GET['genre'], $_GET['ville'], $_GET['loisir'], $_GET['age']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de profils</title>
    <link rel="stylesheet" href="recherche.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="carousel.js"></script>
</head>

<body>
    <h1>Recherche de profils</h1>
    
    <div id="container">
        <form action="recherche.php" method="get">
            <div id = "nav">
                <label for="genre">Genre :</label>
                <select id="genre" name="genre">
                    <option value="">- Sélectionner -</option>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                    <option value="autre">Autre</option>
                </select><br>

                <label for="ville">Localisation (Ville) :</label>
                <input type="text" id="ville" name="ville"><br>

                <label for="loisir">Loisir :</label>
                <select id="loisir" name="loisir">
                    <option value="">- Sélectionner -</option>
                    <option value="sport">Sport</option>
                    <option value="lecture">Lecture</option>
                    <option value="musique">Musique</option>
                    <option value="voyage">Voyage</option>
                </select><br>
                <label for="age">Tranche d'âge :</label>
                <select id="age" name="age">
                    <option value="">- Sélectionner -</option>
                    <option value="18-25">18-25</option>
                    <option value="25-35">25-35</option>
                    <option value="35-45">35-45</option>
                    <option value="45-99">45+</option>
                </select><br>
            </div>
            <button type="submit">Rechercher</button>   
        </form>

<main>
    <?php if ($users) : ?>
        <h2>Résultats de la recherche :</h2>
        <div id="user-details">
            <p><strong><?php echo $users[0]['prenom'] . ' ' . $users[0]['nom']; ?></strong></p>
            <p><?php echo $users[0]['date_naissance']; ?></p>
            <p><?php echo $users[0]['genre']; ?></p>
            <p><?php echo $users[0]['ville']; ?></p>
            <div id = "bouton">
            <button class="precedent-btn" data-user-id="<?php echo $users[0]['id']; ?>">précédent</button>
            <button class="suivant-btn" data-user-id="<?php echo $users[0]['id']; ?>">suivant</button>
            </div>
        </div>
    <?php else : ?>
        <p>Aucun utilisateur trouvé pour cette recherche.</p>
    <?php endif; ?>
</main>
    <a href="profil.php">profile</a>
<script>
    $(document).ready(function() {
        <?php if ($users) : ?>
            var users = <?php echo json_encode($users); ?>;
            var currentIndex = 0;
            function afficherUtilisateur() {
                var currentUser = users[currentIndex];
                $('#user-details').empty();
                $('#user-details').append('<p><strong>' + currentUser['prenom'] + ' ' + currentUser['nom'] + '</strong></p>');
                $('#user-details').append('<p>' + currentUser['date_naissance'] + '</p>');
                $('#user-details').append('<p>' + currentUser['genre'] + '</p>');
                $('#user-details').append('<p>' + currentUser['ville'] + '</p>');
                $('#user-details').append('<button class="precedent-btn" data-user-id="' + currentUser['id'] + '">Profil precedent</button>');
                $('#user-details').append('<button class="suivant-btn" data-user-id="' + currentUser['id'] + '">Profil suivant</button>');
            }
            afficherUtilisateur();
            $(document).on('click', '.suivant-btn', function() {
                currentIndex++;
                if (currentIndex < users.length) {
                    afficherUtilisateur();
                } else {
                    // $('#user-details').empty();
                    $('#user-details').append('<p>Aucune personne à proximité :(</p>');
                }
            });
            $(document).on('click', '.precedent-btn', function() {
                currentIndex--;
                if (currentIndex >= 0 && currentIndex < users.length) {
                    afficherUtilisateur();
                } else {
                    // $('#user-details').empty();
                    $('#user-details').append('<p>Aucune personne à proximité :(</p>');
                }
            });
        <?php endif; ?>
    });
</script>




