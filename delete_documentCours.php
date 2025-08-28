<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $section = $_GET["section"];
    $file = $_GET["file"];
    $targetDir = "upload/" . $section . "/";
    $filePath = $targetDir . $file;

    if (is_file($filePath)) {
        unlink($filePath);
        // Vous pouvez également effectuer d'autres opérations de nettoyage ici si nécessaire
        // ...
        echo "Suppression réussie";
        exit();
    } else {
        echo "Erreur : Document non trouvé.";
        exit();
    }
}
?>
