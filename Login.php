<?php
// PHP File to connect with MySQL db to check email & password:
// Database connection:
$host = "localhost";
$user = "root";
$pass = "";
$db = "ihm";
$conn = mysqli_connect($host, $user, $pass, $db);

// Initialisez la variable $result à un tableau vide
$result = [];

// Retrieve data entered by the user in vars:
if (isset($_POST['submit'])) {
    // Si l'utilisateur clique sur submit
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Recherche dans la table des étudiants
    $queryStudent = mysqli_query($conn, "SELECT id_etud FROM etudiants WHERE username_etud='$username' AND password1='$password'");
    
    if ($queryStudent) {
        $resultStudent = mysqli_fetch_assoc($queryStudent);

        if ($resultStudent) {
            // L'utilisateur est un étudiant
            session_start();
            $_SESSION['id_etud'] = $resultStudent['id_etud'];
            echo '<p style="color:red;">ID de l\'étudiant connecté : ' . $resultStudent['id_etud'] . '</p>';
            header("Location: indexEtud.html");
            exit();
        }
    }

    // Recherche dans la table des enseignants
    $queryTeacher = mysqli_query($conn, "SELECT id_ens, categorie_ens FROM enseignants WHERE username_ens='$username' AND password1='$password'");
    
    if ($queryTeacher) {
        $resultTeacher = mysqli_fetch_assoc($queryTeacher);

        if ($resultTeacher) {
            // L'utilisateur est un enseignant
            session_start();
            $_SESSION['id_ens'] = $resultTeacher['id_ens'];
            
            // Vérifier la catégorie et rediriger en conséquence
            if ($resultTeacher['categorie_ens'] == 'cours') {
                header("Location: indexEns.html");
            } elseif ($resultTeacher['categorie_ens'] == 'td' || $resultTeacher['categorie_ens'] == 'tp') {
                header("Location: indexEnss.html");
            } else {
                // Catégorie non gérée, rediriger vers une page par défaut
                header("Location: indexEns.html");
            }
            exit();
        }
    }

    // Aucun utilisateur correspondant n'a été trouvé
    echo '<p style=" color:red; float:right; margin-right:30px;">Réessayez, nom d\'utilisateur ou mot de passe incorrect !</p>';
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

        <title>Connexion - IHM Plateforme</title>
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
                font-family: 'Calibre', Arial, sans-serif; /* Ajout de la police personnalisée */
                margin: 0;
                padding: 0;
                font-family: 'Calibre', Arial, sans-serif;
                background-color: #ecf0f1;
                color: #000000;
            }

            header {
                background-color: #B8DFCE;
                color: #000000;
                padding: 0.5px;
                text-align: left;
            }

            header h1 {
                margin-left: 25px;
                font-size: 30px;
            }

            form {
                width: 400px;
                margin: 50px auto;
                margin-top: 80px;
                padding: 40px;
                background-color: #ecf0f1;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                height: 300px;
            }

            label {
                display: block;
                margin: 15px 0;
                font-weight: bold;
                margin-left: 25px;
            }

            input {
                width: 90%;
                padding: 10px;
                margin-left: 23px;
                margin-bottom: 15px;
                box-sizing: border-box;
                border: 1px solid #B8DFCE;
                border-radius: 4px;
            }

            button {
                width: 70%;
                background-color: #B8DFCE;
                color: #000000;
                border: none;
                padding: 13px;
                border-radius: 5px;
                cursor: pointer;
                display: block;
                margin: 15px auto 0;
                font-family: 'Calibre', Arial, sans-serif; /* Ajout de la police personnalisée */
                font-size: 17px;
            }

            .title {
                color: #000000;
                text-decoration: underline;
                margin-top: 50px; /* Ajusté pour descendre davantage le titre */
            }

            .sign_link {
                margin-left: 77px;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>IHM Plateforme</h1>
        </header>
        <div class="title">
            <h1 style="color:000000; text-align: center;">Connexion à la plateforme</h1>
        </div>
        <div class="boxe" action="Q&A.php">
            <form  method="post" >
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>

                <label for="password1">Mot de passe :</label>
                <input type="password" id="password1" name="password" required>

                <button type="submit" name="submit">Connexion</button>
                <div class="sign_link">
                    <br>
                    <br>
                    Vous n'êtes pas un membre? <a href="http://localhost/SignUpEtud.php" style="color: #3498db;" >S'inscrire</a>
                </div>
            </form>
        </div>
    </body>
    </html>
