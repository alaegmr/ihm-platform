<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

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

        .section-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .section {
            width: 30%;
            padding: 15px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 15px;
        }

        .section label {
            background-color: #B8DFCE;
            color: #000000;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin-bottom: 20px;
            text-align: center;
        }

        .section #fileInput {
            display: none;
        }

        .section #documentList {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .section .document {
            border: 2px solid #B8DFCE;
            border-radius: 10px;
            padding: 15px;
            margin: 10px;
            width: calc(100% - 20px);
            position: relative;
            cursor: pointer;
            box-sizing: border-box;
        }

        .section .document i {
            margin-right: 10px;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .section #deleteAllBtn {
            background-color: #e74c3c;
            color: #000000;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
            display: block;
            margin: 20px auto;
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
        .g:hover{
    background-color: #0D6E3D; /* Change the background color on hover */

}
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Oswald:wght@500&display=swap" rel="stylesheet">
    <title>Page Enseignant</title>
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
            <li><a href="indexEns.html">Accueil</a></li>
            <li><a href="enseignant2.php" class="active" style="color: #FFF4A3; font-weight: bold;">Espace Enseignant</a></li>
            <a href="Answer.php">Espace d'échanges </a>
        </ul>
    </nav>

    <!-- Conteneur principal -->
    <div class="section-container">
        <!-- Boîte pour les Cours -->
        <div class="section cours">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label class="g" for="fileInputCours">Ajouter un nouveau Document "Cours"</label>
                <input style="display: none;" type="file" name="file" id="fileInputCours" accept=".pdf, .doc, .docx" onchange="this.form.submit()" />
                <input type="hidden" name="section" value="Cours" />
            </form>
            <div id="documentListCours">
                <!-- Les documents seront affichés ici -->
                <?php include 'list_documentsCours.php'; ?>
            </div>
            <button style="background-color: #e74c3c;
                margin-left: 80px;
                margin-bottom:  0px;
                color: #ffffff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
                font-size: 13px;
                margin-top: 20px;" id="deleteAllBtnCours" onclick="confirmDeleteAll('Cours')">Vider la liste des "Cours"</button>
        </div>

        <!-- Boîte pour les Tds -->
        <div class="section tds">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label class="g" for="fileInputTds">Ajouter un nouveau Document "Tds"</label>
                <input style="display: none;" type="file" name="file" id="fileInputTds" accept=".pdf, .doc, .docx" onchange="this.form.submit()" />
                <input type="hidden" name="section" value="Tds" />
            </form>
            <div id="documentListTds">
                <!-- Les documents seront affichés ici -->
                <?php include 'list_documentsTD.php'; ?>
            </div>
            <button style="background-color: #e74c3c;
                margin-left: 80px;
                margin-bottom:  0px;
                color: #ffffff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
                font-size: 13px;
                margin-top: 20px;" id="deleteAllBtnTds" onclick="confirmDeleteAll('Tds')">Vider la liste des "Tds"</button>
        </div>

        <!-- Boîte pour les Tps -->
        <div class="section tps">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label class="g" for="fileInputTps">Ajouter un nouveau Document "Tps"</label>
                <input style="display: none;" type="file" name="file" id="fileInputTps" accept=".pdf, .doc, .docx" onchange="this.form.submit()" />
                <input type="hidden" name="section" value="Tps" />
            </form>
            <div id="documentListTps">
                <!-- Les documents seront affichés ici -->
                <?php include 'list_documentsTP.php'; ?>
            </div>
            <button style="background-color: #e74c3c;
                margin-left: 80px;
                margin-bottom:  0px;
                color: #ffffff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
                font-size: 13px;
                margin-top: 20px;" id="deleteAllBtnTps" onclick="confirmDeleteAll('Tps')">Vider la liste des "Tps"</button>
        </div>
    </div>
    <?php
function displayDocuments($section) {
    $targetDir = "upload/" . $section . "/";
    $files = scandir($targetDir);

    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            echo "<div class='document'>
                    <strong>$file</strong>
                    <i class='delete-btn' onclick='confirmDeleteDocument(\"$section\", \"$file\")'>❌</i>
                  </div>";
        }
    }
}

$sections = ["Cours", "Tps", "Tds"];

foreach ($sections as $section) {
    $targetDir = "upload/" . $section . "/";
    $files = scandir($targetDir);

    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            
        }
    }

}
?>

    <script>
        function confirmDeleteAll(section) {
            if (confirm(`Êtes-vous sûr de vouloir vider toute la liste de "${section}"?`)) {
                window.location.href = `delete_all.php?section=${section}`;
            }
        }

        function confirmDeleteDocument(section, file) {
            if (confirm(`Êtes-vous sûr de vouloir supprimer "${file}" de la section "${section}"?`)) {
                // Ajoutez ici la logique pour supprimer le document (utilisez AJAX si nécessaire)
                // Puis mettez à jour la liste des documents
                deleteDocument(section, file);
            }
        }

        function deleteDocument(section, file) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Mettez à jour la liste des documents après la suppression réussie
                    updateDocumentList(section);
                }
            };

            // Définissez la méthode AJAX, l'URL du script de suppression et envoyez la demande
            xhr.open("GET", `delete_document.php?section=${section}&file=${file}`, true);
            xhr.send();
        }

        function updateDocumentList(section) {
            var xhr = new XMLHttpRequest();
            var container = document.getElementById("documentList" + section);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Clear the container first
                    container.innerHTML = "";
                    // Then update the content of the container with the new list of documents
                    container.innerHTML = xhr.responseText;
                }
            };

            xhr.open("GET", "list_documents.php?section=" + section, true);
            xhr.send();
        }
    </script>
</body>

</html>