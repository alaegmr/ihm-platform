<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $section = $_GET["section"];
    $targetDir = "upload/" . $section . "/";

    $files = glob($targetDir . "*");

    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }

    header("Location: {$_SERVER['HTTP_REFERER']}"); // Redirection vers la page précédente
    exit();  // Assurez-vous d'arrêter le script après la redirection
}
?>
