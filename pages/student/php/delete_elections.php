<?php
require __DIR__ . "/connect.php";

if (isset($_POST['ids']) && is_array($_POST['ids'])) {
    $ids = array_map('intval', $_POST['ids']); 
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $deleted = "DELETED"; 
    $sql = $mysqli->prepare("UPDATE elections SET deleted = ? WHERE id IN ($placeholders)");

    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

    $types = 's' . str_repeat('i', count($ids)); // 's' for deleted, 'i' for each ID
    $params = array_merge([$deleted], $ids);

    $sql->bind_param($types, ...$params);

    if ($sql->execute()) {
        echo "<script>
                alert('Election(s) successfully deleted');
                document.location.href = 'manage_elections.php';
              </script>";
    } else {
        echo "Error deleting records: " . $sql->error;
    }

    $sql->close();
}
?>
