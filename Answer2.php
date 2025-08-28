<?php
// Démarrez la session
ob_start(); // Met en mémoire tampon la sortie
session_start();
// Reste du code HTML et PHP ici
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Oswald:wght@500&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'Calibre';
            font-style: normal;
            font-weight: 500;
            src: local('Calibre'), url('https://fonts.cdnfonts.com/s/22257/CalibreMedium.woff') format('woff');
        }

        @font-face {
            font-family: 'CalibreBold';
            font-style: normal;
            font-weight: 700;
            src: local('Calibre'), url('https://fonts.cdnfonts.com/s/22257/CalibreBold.woff') format('woff');
        }

        body {
            font-family: 'Calibre', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ecf0f1;
            color: #000000;
        }

        header {
            background-color: #B8DFCE;
            color: #000000;
            padding: 10px;
            text-align: center;
            height: 67px;
        }

        nav {
            background-color: #2c3e50;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            font-size: 18px;
        }

        #profil {
            list-style: none;
            display: flex;
            justify-content: flex-end;
            margin-top: -56px;
            margin-right: 20px;
        }

        #profil a {
            color: #000000;
            text-decoration: none;
            font-weight: bold;
            font-size: 20px;
        }

        #profil i {
            margin-right: 5px;
        }

        nav a.active {
            color: #FFF4A3;
            font-weight: bold;
        }
        .main-container {
    max-width: 1000px; /* Augmenter la largeur du conteneur principal */
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
        .main-content {
            margin-top: 20px;
        }

        .question-box {
    background-color: #ecf0f1;
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    text-align: left; /* Alignement à gauche pour les questions */
    max-width: 70%; /* Ajustez la largeur maximale selon vos préférences */
    margin-left: 0; /* Aligner la boîte de question à gauche */
    margin-right: auto;
} 

.reponse-box {
    position: relative;
    background-color: #ecf0f1;
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    text-align: left; /* Alignement à gauche pour les réponses */
    max-width: 70%; /* Ajustez la largeur maximale selon vos préférences */
    margin-left: auto; /* Aligner la boîte de réponse à droite */
    margin-right: 0;
}
.reponse-box a {
    position: absolute;
    top: 5px;
    right: 5px;
    color: #e74c3c;
    cursor: pointer;
    text-decoration: underline;
    margin-left: 10px;
}
.reponse-box a.edit-link {
    color: #3498db;
    margin-right: 23px;
}

.reponse-box a.edit-link {
    color: #3498db;
    margin-right: 23px;
}

        form {
            margin-top: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #B8DFCE;
            color: #000000;
            font-weight: bold;
            padding: 8px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px; /* Ajoutez une marge en bas du bouton */
        }

        form button {
            margin-top: -5px; /* Ajoutez une marge en haut du bouton */
            margin-left: 3px;
        }
        .g:hover{
    background-color: #0D6E3D; /* Change the background color on hover */

}
    </style>
</head>
<body>
    <header>
        <h1>Donner Aide aux Etudiants</h1>
        <ul>
            <li id="profil"><a href="profilEns.php"><i class="fa fa-user"></i>Profil</a></li>
        </ul>
    </header>
    <nav>
        <ul>
            <li><a href="indexEnss.html">Accueil</a></li>
        <li><a href="enseignant2.php">Espace Enseignant</a></li>
        <li><a href="docihm.php" >Espace Documents</a></li>
            <li><a href="Answer2.php" class="active">Espace d'échanges</a></li>
        </ul>
    </nav>
    <div class="main-container">
        <div class="main-content"><?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "ihm";
$conn = new mysqli($host, $user, $pass, $db);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if (isset($_SESSION['id_ens'])) {
    $id_enseignant_courant = $_SESSION['id_ens'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $id_question = $_POST['id_question'];
        $reponse_content = $_POST['reponse'];

        $insert_query = $conn->prepare("INSERT INTO reponses (id_quest, contenu_rep,id_ens) VALUES (?, ?,?)");
        $insert_query->bind_param("isi", $id_question, $reponse_content, $id_enseignant_courant);

        if ($insert_query->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']); // Redirection vers la même page après le traitement du formulaire
            exit();
        } else {
            echo "Erreur lors de l'ajout de la réponse : " . $insert_query->error;
        }

        $insert_query->close();
    }

    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id_rep'])) {
        $id_rep = $_GET['id_rep'];
        $delete_query = $conn->prepare("DELETE FROM reponses WHERE id_rep = ?");
        $delete_query->bind_param("i", $id_rep);

        if ($delete_query->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']); // Redirection vers la même page après la suppression
            exit();
        } else {
            echo "Erreur lors de la suppression de la réponse : " . $delete_query->error;
        }

        $delete_query->close();
    }}

    $result = $conn->query("SELECT id_quest, contenu_quest FROM questions");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="question-box">' . htmlspecialchars($row['contenu_quest']) . '</div>';
    
            $id_question = $row['id_quest'];
            $reponses_result = $conn->prepare("SELECT id_rep, contenu_rep FROM reponses WHERE id_quest = ? AND id_ens = ?");
            $reponses_result->bind_param("ii", $id_question, $id_enseignant_courant);
            $reponses_result->execute();
            $reponses_result->store_result();
            $reponses_result->bind_result($id_rep, $contenu_rep);
            
    
            if ($reponses_result->num_rows > 0) {
                while ($reponses_result->fetch()) {
                    echo '<div class="reponse-box">' . htmlspecialchars($contenu_rep);
                    echo '<a href="?action=delete&id_rep=' . $id_rep . '" onclick="return confirmDelete();"><i class="fa fa-trash"></i></a>';
                    echo '</div>';
                }
            } else {
               // echo "Aucune réponse trouvée.";
            }
    
            $reponses_result->free_result();
            $reponses_result->close();
    
            echo '
                <form method="post">
                    <input type="hidden" name="id_question" value="' . $id_question . '">
                    <label for="reponse">Votre Réponse:</label>
                    <textarea id="reponse" name="reponse" rows="4" required></textarea>
                    <button class="g" type="submit" name="submit">Envoyer la Réponse</button>
                </form>
            ';
        }
        $result->free();
    } else {
        echo "Erreur lors de la récupération des questions : " . $conn->error;
    }
    
$conn->close();
?><script>
            function confirmDelete() {
                return confirm("Êtes-vous sûr de vouloir supprimer cette réponse ?");
            }
        </script>
        </div>
    </div>
</body>
</html>
<?php
ob_end_flush(); // Envoie la sortie tamponnée
?>
