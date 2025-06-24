<?php
require __DIR__ . "/connect.php";

if (isset($_POST['ids']) && is_array($_POST['ids'])) {
    $ids = array_map('intval', $_POST['ids']); 
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $deleted = "DELETED";

    // Prepare SQL to update admin_sign_up
    $sql = $mysqli->prepare("UPDATE admin_sign_up SET status = ? WHERE id IN ($placeholders)");
    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

    $types = 's' . str_repeat('i', count($ids)); // 's' for status, 'i' for each ID
    $params = array_merge([$deleted], $ids);
    $sql->bind_param($types, ...$params);

    // Execute update
    if ($sql->execute()) {
        echo "<script>
                alert('Admin(s) successfully DELETED');
                document.location.href = 'manage_admins.php';
              </script>";
    } else {
        echo "Error updating admin records: " . $sql->error;
    }

    $sql->close();
}
?>
