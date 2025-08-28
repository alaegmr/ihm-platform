<?php
// Démarrez la session
session_start();
// PHP File to connect with MySQL db to check email & password:
$host = "localhost";
$user = "root";
$pass = "";
$db = "ihm";
$conn = new mysqli($host, $user, $pass, $db);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifiez si l'ID de l'étudiant est présent dans la session
if (isset($_SESSION['id_etud'])) {
    $id_etud_courant = $_SESSION['id_etud'];

    // Traitement de la requête POST pour ajouter une question
    if (isset($_POST['submit'])) {
        // Récupération des données du formulaire
        $contenu_quest = $_POST["question"];

        // Préparation de la requête SQL avec une requête préparée
        $requete = $conn->prepare("INSERT INTO questions (contenu_quest, id_etud) VALUES (?, ?)");
        $requete->bind_param("si", $contenu_quest, $id_etud_courant);

        if ($requete->execute()) {
            // La question a été ajoutée avec succès
            header("Location: ".$_SERVER['PHP_SELF']); // Redirection vers la même page après le traitement du formulaire
            exit();
        } else {
            echo "Erreur lors de l'ajout de la question : " . $requete->error;
        }

        $requete->close(); // Fermez la requête
    }

    // Suppression de la question si l'action est définie comme "delete"
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id_quest'])) {
        $id_quest = $_GET['id_quest'];

        // Supprimer d'abord les réponses associées à la question
        $delete_responses_query = $conn->prepare("DELETE FROM reponses WHERE id_quest = ?");
        $delete_responses_query->bind_param("i", $id_quest);

        if ($delete_responses_query->execute()) {
            // Maintenant que les réponses sont supprimées, supprimer la question
            $delete_query = $conn->prepare("DELETE FROM questions WHERE id_quest = ? AND id_etud = ?");
            $delete_query->bind_param("ii", $id_quest, $id_etud_courant);

            if ($delete_query->execute()) {
                // La question a été supprimée avec succès
            } else {
                echo "Erreur lors de la suppression de la question : " . $delete_query->error;
            }

            $delete_query->close(); // Fermez la requête pour supprimer la question
        } else {
            echo "Erreur lors de la suppression des réponses : " . $delete_responses_query->error;
        }

        $delete_responses_query->close(); // Fermez la requête pour supprimer les réponses
    }

    // Récupérer les questions de l'étudiant connecté (pour l'affichage initial)
    $result = $conn->query("SELECT id_quest, contenu_quest FROM questions WHERE id_etud = $id_etud_courant");
}
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
    <title>Demande d'Aide - IHM</title>
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
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        #help-request-form {
            flex: 1; /* Plus de largeur pour le formulaire */
            max-width: 600px;
            margin-right: 180px;
            margin-left: 180px;
            margin-top: 40px;
            margin-bottom: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

            .question-container {
                flex: 1 1 60%; /* Moins de largeur pour les questions */
                margin-right: 180px;
                margin-left: 180px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #B8DFCE;
                padding: 20px;
                border-radius: 10px;
            }

        #help-request-form h2 {
            color: #000000;
            text-align: center;
        }

        .question-container h2 {
            text-decoration: underline;
            margin-bottom: 8px;
            color: #000000;
            text-align: center;
        }

        #help-request-form form {
            display: flex;
            flex-direction: column;
        }

        #help-request-form label {
            margin-bottom: 8px;
            color: #000000;
        }

        #help-request-form textarea {
            padding: 10px;
            margin-bottom: 16px;
            border: 2px solid #95a5a6;
            border-radius: 5px;
            font-size: 16px;
            min-height: 240px;
        }

        #help-request-form button {
            background-color: #B8DFCE;
            color: #000000;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .question-container {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #B8DFCE;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        .question-box {
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

        #logout {
            margin-top: 20px;
            margin-right: 20px;
            padding: 12px;
            background-color: #000000;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            float: right;
        }

        #profil {
            list-style: none;
            display: flex;
            justify-content: flex-end;
            margin-right: 20px;
            margin-top: -56px;
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

        .reponse-box {
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
.fa-trash {
    color: #e74c3c; /* Couleur de l'icône */
        font-size: 15px; /* Taille de l'icône */
        margin-left: 5px; /* Marge à gauche de l'icône pour l'espacement */
        text-decoration: none; /* Supprime le soulignement du lien */
        float: right; /* Aligner à droite */
}
    </style>
</head>
<body>
   
  <header>
        <h1>Demande d'Aide</h1>
        <ul>
            <li id="profil"><a href="profilEtud.php"><i class="fa fa-user"></i>Profil</a></li>
        </ul>
    </header>

    <nav>
        <ul>
            <li><a href="indexEtud.html">Accueil</a></li>
            <li><a href="http://localhost/etudiant.php">Espace Etudiant</a></li>
            <li><a href="http://localhost/Q&A.php" class="active">Espace d'échanges</a></li>
        </ul>
    </nav>

    <div class="container">
        <section id="help-request-form">
            <?php
            if (isset($_SESSION['id_etud'])) {
                if ($result) {
                    echo '<h2 style="text-decoration:underline;">Formulaire de Demande d\'Aide</h2>';
                    echo '<form id="question-form" method="post">';
                    echo '<label for="question">Votre Question:</label>';
                    echo '<textarea id="question" name="question" rows="4" required></textarea>';
                    echo '<button type="submit" name="submit">Envoyer la Demande</button>';
                    echo '</form>';
                } else {
                    echo "Erreur lors de la récupération des questions : " . $conn->error;
                }
            }
            ?>
        </section>

        <div class="question-container">
            <?php
            if (isset($_SESSION['id_etud'])) {
                if ($result) {
                    echo '<h2>Section d\'Aide</h2>';
                    while ($row = $result->fetch_assoc()) {
                        // Display the student's question
                        echo '<div class="question-box">' . htmlspecialchars($row['contenu_quest']);

                        // Ajoutez le lien de suppression avec la logique PHP
                        echo '<a href="?action=delete&id_quest=' . $row['id_quest'] . '" onclick="return confirmDelete();"><i class="fa fa-trash"></i></a>';

                        echo '</div>';

                        // Fetch and display answers for each question
                        $id_question = $row['id_quest'];
                        $reponses_result = $conn->query("SELECT id_rep, contenu_rep FROM reponses WHERE id_quest = $id_question");

                        if ($reponses_result) {
                            while ($reponse_row = $reponses_result->fetch_assoc()) {
                                // Display the answer without the delete link
                                echo '<div class="reponse-box">' . htmlspecialchars($reponse_row['contenu_rep']) . '</div>';
                            }
                            $reponses_result->free();
                        } else {
                            echo "Erreur lors de la récupération des réponses : " . $conn->error;
                        }
                    }
                    $result->free(); // Libérez le résultat
                } else {
                    echo "Erreur lors de la récupération des questions : " . $conn->error;
                }
            }
            ?>
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Êtes-vous sûr de vouloir supprimer cette question ?");
        }
    </script>
</body>
</html>

<?php
// Fermez la connexion à la base de données
$conn->close();
?>
