<?php
$folder = __DIR__; // Get the current directory (pages folder)

// Open the directory
$files = scandir($folder);

foreach ($files as $file) {
    $oldPath = $folder . '/' . $file;

    // Check if it's a file and has .html extension
    if (is_file($oldPath) && pathinfo($file, PATHINFO_EXTENSION) === 'html') {
        $newFile = pathinfo($file, PATHINFO_FILENAME) . '.php';
        $newPath = $folder . '/' . $newFile;

        // Rename the file
        if (rename($oldPath, $newPath)) {
            echo "Renamed: $file → $newFile <br>";
        } else {
            echo "Failed to rename: $file <br>";
        }
    }
}

echo "Renaming process completed!";
?>
