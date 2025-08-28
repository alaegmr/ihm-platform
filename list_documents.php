<?php
$section = "Cours"; // Changez cette valeur en fonction de la section actuelle
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
?>
