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
    <title>Plateforme Etudiante - IHM</title>

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
            font-family: 'Calibre', Arial, sans-serif;
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

        #b {
            text-align: center;
            font-size: 28px;
            margin-top: 28px;
        }

        #p1 {
            font-size: 24px;
            margin-left: 1px;
            margin-top: 15px;
        }

        #p2 {
            font-size: 24px;
            margin-left: 2px;
            margin-top: 12px;
        }

        footer {
            background-color: #B8DFCE;
            color: #000000;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 35px;
        }

        #profil {
            list-style: none;
            display: flex;
            margin-left: 1150px;
            margin-top: -56px;
        }

        #profil a {
            color: #000000;
            text-decoration: none;
            font-weight: bold;
            font-size: 20px;

        }

        #profil i {
            margin-right: 7px;
            
        }

        /* Style pour le lien actif */
        nav a.active {
            color: yellow;
            font-weight: bold;
        }

        /* Styles pour la section principale */
        section {
            padding: 30px;
            text-align: center;
        }

        /* Nouveau style pour aligner les catégories horizontalement */
        .document-section {
            display: flex;
            justify-content: space-between; /* Espacement équitable entre les catégories */
            flex-wrap: wrap; /* Permet le passage à la ligne en cas de manque d'espace */
            margin-top: 20px;
        }

        /* Styles pour chaque catégorie de document partagé */
        .document-category {
            border-radius: 10px;
            padding: 15px;
            width: calc(33.33% - 20px); /* Ajustez la largeur en fonction du nombre de colonnes */
            box-sizing: border-box;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            min-height: 400px;
            margin: 10px; /* Ajout de marges entre les catégories */
        }

        /* Styles pour chaque document partagé */
        .document {
            border: 2px solid #B8DFCE;
            border-radius: 10px;
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            cursor: pointer;
            box-sizing: border-box;
        }

        /* Styles pour les icônes de téléchargement */
        .document i {
            margin-right: 10px;
            cursor: pointer;
        }

        .sec {
            display: flex;
            justify-content: space-around;
            margin-top: -50px;
        }
        .document a {
    text-decoration: none;
    color: #2c3e50; /* Couleur par défaut pour les liens non visités */
    transition: color 0.3s; /* Ajouter une transition de couleur pour une animation fluide */

}

.document a:visited {
    color: #2c3e50; /* Couleur pour les liens déjà visités */
}

.document a:hover {
    color: #3498db; /* Couleur au survol du lien */
}

/* Styles pour les icônes de téléchargement */
.document i {
    margin-right: 10px;
    cursor: pointer;
}
    </style>
</head>

<body>

    <header>
        <h1>Plateforme Enseignante</h1>
        <ul>
            <li id="profil"><a href="profilEns.php"><i class="fa fa-user"></i>Profil</a></li>
        </ul>
    </header>

    <nav>
        <ul>
            <li><a href="indexEnss.html">Accueil</a></li>
            <li><a href="docihm.php" class="active" style="color: #FFF4A3;">Espace Documents</a></li>
            <a href="enseignant2.php">Espace Enseignant</a>
            <a style="margin-left:9px;" href="Answer2.php">Espace d'échanges</a>
        </ul>
    </nav>

    <section id="accueil">
     
        <p id="p2">Vous pouvez consulter les documents partagés par les enseignants responsables du module IHM</p>
    </section>
    
    <section class="sec" id="documentSection">
    <?php
    // Répertoire où sont stockés les documents (ajustez selon votre structure de répertoire)
    $baseDirectory = __DIR__ . '/upload';

    // Liste des catégories
    $categories = ['Cours', 'Tds', 'Tps'];

    foreach ($categories as $category) {
        $categoryDirectory = $baseDirectory . '/' . $category;

        // Vérifiez si le répertoire de la catégorie existe
        if (is_dir($categoryDirectory)) {
            $files = scandir($categoryDirectory);

            // Affichez la liste des fichiers au format HTML
            if (count($files) > 0) {
                echo "<div class='document-category' id='{$category}Category'>";
                echo "<h2>$category</h2>"; // Titre de la catégorie

                // Bloc PHP spécifique à la catégorie
                foreach ($files as $file) {
                    if (!in_array($file, ['.', '..'])) {
                        $filePath = "upload/$category/$file";
                        echo "<div class='document'>
                                 <a href='$filePath' target='_blank'><strong>$category - $file</strong></a>
                              </div>";

                              
                    }
                }
                echo "</div>"; // Fermeture de la catégorie
            } else {
                echo "<p>Aucun document disponible dans la catégorie $category.</p>";
            }
        } else {
            echo "<p>Le répertoire de la catégorie $category n'existe pas.</p>";
        }
    }
    ?>
</section>


</body>

</html>
