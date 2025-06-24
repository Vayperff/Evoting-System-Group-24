<?php
require "php/connect.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch elections data using a prepared statement
$sql = $mysqli->prepare("SELECT id, election_name, election_description, start_date, end_date, election_banner FROM elections ORDER BY date_created DESC");
$sql->execute();
$elections = $sql->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elections</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <input type="text" id="search" class="form-control mb-3" placeholder="Search elections...">
    
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th><input type="checkbox" id="select_all"></th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Election Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start Date</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End Date</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banner</th>
                <th><button id="delete_selected" class="btn btn-danger btn-sm" disabled>Delete</button></th>
            </tr>
        </thead>
        <tbody id="electionsTable">
            <?php if ($elections->num_rows > 0): ?>
                <?php while ($row = $elections->fetch_object()): ?>
                    <tr data-id="<?= $row->id ?>">
                        <td><input type="checkbox" class="select-row" value="<?= $row->id ?>"></td>
                        <td><?= htmlspecialchars($row->election_name) ?></td>
                        <td><?= htmlspecialchars($row->election_description) ?></td>
                        <td class="text-center"><?= htmlspecialchars($row->start_date) ?></td>
                        <td class="text-center"><?= htmlspecialchars($row->end_date) ?></td>
                        <td class="text-center">
                            <?php if (!empty($row->election_banner)): ?>
                                <img src="images/election_banners/<?= htmlspecialchars($row->election_banner) ?>" class="avatar avatar-sm" width="50">
                            <?php else: ?>
                                No Banner
                            <?php endif; ?>
                        </td>
                        <td></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr id="noResults">
                    <td colspan="7" class="text-center text-danger">No results found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Live search functionality
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var rows = $("#electionsTable tr");
        var found = false;
        
        rows.each(function() {
            if ($(this).text().toLowerCase().includes(value)) {
                $(this).show();
                found = true;
            } else {
                $(this).hide();
            }
        });

        $("#noResults").toggle(!found);
    });

    // Row selection by clicking anywhere
    $("#electionsTable").on("click", "tr", function(event) {
        if (!$(event.target).is("input")) {
            $(this).find("input[type='checkbox']").prop("checked", function(i, checked) {
                return !checked;
            }).trigger("change");
        }
    });

    // Enable/disable delete button based on selection
    $("#electionsTable").on("change", ".select-row", function() {
        var selected = $(".select-row:checked").length;
        $("#delete_selected").prop("disabled", selected === 0);
    });

    // Select/Deselect all rows
    $("#select_all").on("change", function() {
        $(".select-row").prop("checked", this.checked).trigger("change");
    });

    // Delete selected rows
    $("#delete_selected").on("click", function() {
        var selectedIds = $(".select-row:checked").map(function() {
            return $(this).val();
        }).get();

        if (selectedIds.length === 0) return;

        if (!confirm("Are you sure you want to delete the selected elections?")) return;

        $.ajax({
            url: "delete_elections.php",
            type: "POST",
            data: { ids: selectedIds },
            success: function(response) {
                selectedIds.forEach(function(id) {
                    $("tr[data-id='" + id + "']").remove();
                });
                $("#delete_selected").prop("disabled", true);
            }
        });
    });
});
</script>

</body>
</html>
