<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $section = $_POST["section"];

    // Vérifier si le fichier a été téléchargé sans erreur
    if (isset($_FILES["file"]["name"])) {
        $fileName = $_FILES["file"]["name"];
        $tempFile = $_FILES["file"]["tmp_name"];

        // Déplacez le fichier téléchargé vers le répertoire souhaité
        $targetDir = "upload/" . $section . "/";
        $targetFile = $targetDir . $fileName;

        // Vérifier si le fichier est un document autorisé
        $allowedExtensions = ["pdf", "doc", "docx"];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true); // Créer le répertoire s'il n'existe pas
            }

            if (move_uploaded_file($tempFile, $targetFile)) {
                // Redirection vers la même page
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit(); // Assurez-vous d'arrêter le script après la redirection
            } else {
                echo "Erreur lors du déplacement du fichier.";
            }
        } else {
            echo "Erreur : Type de fichier non autorisé.";
        }

        // Vérification des erreurs PHP
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            die('Erreur lors de l\'upload du fichier. Code d\'erreur : ' . $_FILES['file']['error']);
        }
    }
    
}
?>
