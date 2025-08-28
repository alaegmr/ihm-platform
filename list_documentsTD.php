<?php
$section = "Tds"; // Changez cette valeur en fonction de la section actuelle (TP)
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

// Comment out the following lines as they cause duplication
// displayDocuments("Cours");
// displayDocuments("Tps");
// displayDocuments("Tds");
?>