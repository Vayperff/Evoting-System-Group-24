<?php
require __DIR__ . "/connect.php";

if (isset($_POST['ids']) && is_array($_POST['ids'])) {
    $ids = array_map('intval', $_POST['ids']); 
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $deleted = "DELETED";

    // 1. Update candidates
    $sql = $mysqli->prepare("UPDATE candidates SET deleted = ? WHERE id IN ($placeholders)");
    if ($sql === false) {
        die("Error preparing candidates statement: " . $mysqli->error);
    }

    $types = 's' . str_repeat('i', count($ids)); // 's' for deleted, 'i' for each ID
    $params = array_merge([$deleted], $ids);
    $sql->bind_param($types, ...$params);

    // 2. Update votes
    $sql1 = $mysqli->prepare("UPDATE votes SET voting_status = 1 WHERE candidate_id IN ($placeholders)");
    if ($sql1 === false) {
        die("Error preparing votes statement: " . $mysqli->error);
    }

    $voteTypes = str_repeat('i', count($ids));
    $sql1->bind_param($voteTypes, ...$ids);

    // Execute both
    if ($sql->execute() && $sql1->execute()) {
        echo "<script>
                alert('Candidate(s) successfully deleted and votes updated');
                document.location.href = 'manage_candidates.php';
              </script>";
    } else {
        echo "Error updating records: " . $sql->error . " / " . $sql1->error;
    }

    $sql->close();
    $sql1->close();
}
?>
