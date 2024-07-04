<?php
session_start();
include"connexion_database.php";
if (!isset($_SESSION['id'])) {
    header("Location: connection.php");
    exit();
}
$id = $_SESSION['id'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];
$ville = $_SESSION['ville'];
$genre = $_SESSION['genre'];
$loisir = $_SESSION['loisir'];
$date = $_SESSION['date'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST["nom_change"])) {
        $id_user = $_POST["id_user"];
        $change_nom = $_POST["nom_change"];
        try {
            $stmt = $db->prepare("UPDATE user SET nom = :nom WHERE id = :id");
            $stmt->bindParam(':nom', $change_nom);
            $stmt->bindParam(':id', $id_user);
            $stmt->execute();
            $_SESSION['nom'] = $change_nom;
        } catch(PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
        }
    } elseif(isset($_POST["prenom_change"])) {
        $id_user = $_POST["id_user"];
        $change_prenom = $_POST["prenom_change"];
        try {
            $stmt = $db->prepare("UPDATE user SET prenom = :prenom WHERE id = :id");
            $stmt->bindParam(':prenom', $change_prenom);
            $stmt->bindParam(':id', $id_user);
            $stmt->execute();
            $_SESSION['prenom'] = $change_prenom;
        } catch(PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
        }
    }
    elseif(isset($_POST["email_change"])) {
        $id_user = $_POST["id_user"];
        $change_email = $_POST["email_change"];
        try {
            $st = $db->prepare("UPDATE user SET email = :email WHERE id = :id");
            $st->bindParam(':email', $change_email);
            $st->bindParam(':id', $id_user);
            $st->execute();
            $_SESSION['email'] = $change_email;
        } catch(PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
        }
    }
    elseif(isset($_POST["mdp_change"])) {
        $id_user = $_POST["id_user"];
        $change_mdp = $_POST["mdp_change"];
        $hashed_mdp = password_hash($change_mdp, PASSWORD_DEFAULT);
        try {
            $st = $db->prepare("UPDATE user SET mdp = :mdp WHERE id = :id");
            $st->bindParam(':mdp', $hashed_mdp); 
            $st->bindParam(':id', $id_user);
            $st->execute();
        } catch(PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
        }
    }  
    elseif(isset($_POST["ville_change"])) {
        $id_user = $_POST["id_user"];
        $change_ville = $_POST["ville_change"];
        try {
            $st = $db->prepare("UPDATE user SET ville = :ville WHERE id = :id");
            $st->bindParam(':ville', $change_ville);
            $st->bindParam(':id', $id_user);
            $st->execute();
            $_SESSION['ville'] = $change_ville;
        } catch(PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
        }
    }
    elseif(isset($_POST["genre_change"])) {
        $id_user = $_POST["id_user"];
        $change_genre = $_POST["genre_change"];
        try {
            $st = $db->prepare("UPDATE user SET genre = :genre WHERE id = :id");
            $st->bindParam(':genre', $change_genre);
            $st->bindParam(':id', $id_user);
            $st->execute();
            $_SESSION['genre'] = $change_genre;
        } catch(PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
        }
    }
    elseif(isset($_POST["loisir_change"])) {
        $id_user = $_POST["id_user"];
        $change_loisir = $_POST["loisir_change"];
        try {
            $st = $db->prepare("UPDATE user SET loisir = :loisir WHERE id = :id");
            $st->bindParam(':loisir', $change_loisir);
            $st->bindParam(':id', $id_user);
            $st->execute();
            $_SESSION['loisir'] = $change_loisir;
        } catch(PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reglage.css">
    <title>Modifications compte</title>
</head>
<body>
    <h1>Mes réglages</h1>
    <form action="" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom_change" value="<?php echo $nom; ?>" required><br>
        <input type="hidden" name="id_user" value="<?php echo $id; ?>">
        <button type="submit">Modifier Nom</button>
    </form>
    <form action="" method="post">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom_change" value="<?php echo $prenom; ?>" required><br>
        <input type="hidden" name="id_user" value="<?php echo $id; ?>">
        <button type="submit">Modifier Prénom</button>
    </form>
    <form action="" method="post">
        <label for="email">Email :</label>
        <input type="text" id="email" name="email_change" value="<?php echo $email; ?>" required><br>
        <input type="hidden" name="id_user" value="<?php echo $id; ?>">
        <button type="submit">Modifier email</button>
    </form>
    <form action="" method="post">
        <label for="mdp">Mot de passe :</label>
        <input type="text" id="mdp" name="mdp_change" value="<?php echo $mdp; ?>" required><br>
        <input type="hidden" name="id_user" value="<?php echo $id; ?>">
        <button type="submit">Modifier mot de passe</button>
    </form>
    <form action="" method="post">
        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville_change" value="<?php echo $ville; ?>" required><br>
        <input type="hidden" name="id_user" value="<?php echo $id; ?>">
        <button type="submit">Modifier ville</button>
    </form>
    <form action="" method="post">
        <label>Genre :</label>
        <div id= "ligne">
        <input type="radio" id="homme" name="genre_change" value="homme" <?php if($genre === 'homme') echo 'checked'; ?> required>
        <label for="homme">Homme</label>
        <input type="radio" id="femme" name="genre_change" value="femme" <?php if($genre === 'femme') echo 'checked'; ?> required>
        <label for="femme">Femme</label>
        <input type="radio" id="autre" name="genre_change" value="autre" <?php if($genre === 'autre') echo 'checked'; ?> required>
        <label for="autre">Autres</label><br>
        </div>
        <input type="hidden" name="id_user" value="<?php echo $id; ?>">
        <button type="submit">Modifier genre</button>
    </form>
    <form action="" method="post">
        <label for="loisir">Loisir :</label>
        <select id="loisir" name="loisir_change" required>
            <option value="sport" <?php if($loisir === 'sport') echo 'selected'; ?>>Sport</option>
            <option value="lecture" <?php if($loisir === 'lecture') echo 'selected'; ?>>Lecture</option>
            <option value="musique" <?php if($loisir === 'musique') echo 'selected'; ?>>Musique</option>
            <option value="voyage" <?php if($loisir === 'voyage') echo 'selected'; ?>>Voyage</option>
        </select><br>
        <input type="hidden" name="id_user" value="<?php echo $id; ?>">
        <button type="submit">Modifier loisir</button>
    </form>
    <a href="profil.php">profile</a>
</body>
</html>
