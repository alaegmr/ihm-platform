    <?php
        // Démarrez la session
        session_start();
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <meta charset="UTF-8">

    <head>
        <!-- Rest of the head section -->
    </head>
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
                color: #2c3e50;
            }

            header {
                background-color: #B8DFCE;
                color: #000000;
                padding: 10px;
                text-align: center;
                font-family: 'Calibre', Arial, sans-serif;
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
    div #student-details{
            margin-left: 50px;
            margin-top:-10px;
            color: #000000;

    }


    .bordered-box {
        border: 1px solid #B8DFCE; /* Couleur de la bordure des boîtes */
        border-radius: 10px;
        border-width: 2px;
        padding: 15px;
        margin-left: 175px;
        margin-top: 80px;
        width: 70%;
        height: 200px;
        background-color: #ecf0f1; /* Couleur de fond des boîtes */
    }
    #cours{
        border: 1px solid #B8DFCE;
        border-radius: 10px;
        border-width: 2px;
        width: 30%;
        margin-top: -250px;


    }
    button#logout {
        margin-top: 280px;
        margin-left: 1200px;
        padding: 7px;
        background-color: #2c3e50;
        color: #ffffff;
        border: none;
        cursor: pointer;
        border-radius: 10px;
        font-size: 16px;
    }
    #profile-info {
        display: flex;
        align-items: center;
    }

    #profile-picture {
        height: 115px;
        width: 115px;
        border-radius: 15px;
        margin-left: 30px;
    }

    .section {
                width: 30%;
                padding: 15px;
                border-radius: 10px;
                background-color: #ecf0f1; /* Couleur de fond des boîtes */
                border: 2px solid #B8DFCE;
                margin: 15px;
            }

            /* Styles pour chaque section (Cours, TD, TP) */
            .section-container {
                display: flex;
                justify-content: space-around;
                margin-top: 20px;
                min-height: 100px;        
                }
    </style>
    <body>
        <!-- Rest of the body section -->
        <header>
            <h1>Profil Enseignant</h1>
        </header>

        <nav>
            <ul>
                <li><a href="indexEns.html">Accueil</a></li>
                <li><a href="profilEns.html" style="color: #FFF4A3; font-weight: bold;">Profil Enseignant</a></li>
                <li><a href="http://localhost/Answer.php" class="active">Espace d'échanges</a></li>
            </ul>
        </nav>

        <section id="student-profile">
            <?php
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

            // Requête SQL pour récupérer les informations de l'enseignant
            $id_ens = $_SESSION['id_ens'];
            $sql = "SELECT * FROM enseignants WHERE id_ens = ?";
            
            // Utilisation de prepared statements pour éviter les injections SQL
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_ens);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Récupérer les données de l'enseignant
                $row = $result->fetch_assoc();
                $nom_ens = $row['nom_ens'];
                $prenom_ens = $row['prenom_ens'];
                $diplome_ens = $row['diplome_ens'];
                $categorie_ens = $row['categorie_ens'];
                $email_ens = $row['email_ens'];

                // Afficher les données dans la section du profil
                echo '<div id="profile-info" class="bordered-box">';
                echo '<img style="height: 115px; width: 115px; margin-left: 30px; border-radius: 15px;" src="avatar.png" alt="Avatar" id="profile-picture">';
                echo '<div id="student-details">';
                echo '<h2 style="color: #000000;">' . $nom_ens . ' ' . $prenom_ens . '</h2>';
                echo '<p>Diplomé(e) en :<span id="student-level">' . $diplome_ens . '</span></p>';
                echo '<p>Chargé(e) de:<span id="student-level">' . $categorie_ens . '</span></p>';
                echo '<p>Email enseignant :<span id="student-level">' . $email_ens . '</span></p>';
                echo '</div>';
                echo '</div>';
            } else {
                echo "Aucun résultat trouvé";
            }

            // Fermer la connexion à la base de données
            $stmt->close();
            $conn->close();
            ?>
        </section>
    </body>
    </html>
