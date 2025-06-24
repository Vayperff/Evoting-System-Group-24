<?php
include_once("php/add_election.php");
include_once("php/elections.php");



?>

<?php include_once("navbar.php"); ?>



    <div class="container-fluid py-2">

  <!-- Dashboard Header -->
  <div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Admin Dashboard</h3>
    <p class="mb-4">Overview of election statistics and voting progress</p>
  </div>

  
   <br><br>
      <div class="row mb-4">
        <div class="col-lg-10 col-md-12 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
  <div class="col-lg-6 col-12">
    <h6>Elections</h6>
    <p class="text-sm mb-0">
      <i class="fa fa-check text-info" aria-hidden="true"></i>
      <span class="font-weight-bold ms-1">5 elections</span> in the running
    </p>
  </div>


                <div class="col-lg-12 col-12 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                  
                  <div class="form-group ml-5" style="margin-left: 20px;">
                  <input type="text" style="border-bottom: 1px solid darkgray" id="search" class="form-control col-md-6 mb-3" placeholder="Search elections...">
                        </div>
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th>
    <div class="d-flex align-items-center">
        <input type="checkbox" id="select_all" class="mr-2">
        <button id="delete_selected" class="btn btn-danger btn-sm ml-4" style="margin: 10px 10px;" disabled>Delete</button>
    </div>
</th>

               
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Election Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start Date</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End Date</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banner</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Edit</th>
                
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
                           <td>
                               <button type="button" class="btn btn-success btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#Election<?= htmlspecialchars($row->id); ?>">
    Edit
</button>

<div class="modal fade" id="Election<?= htmlspecialchars($row->id); ?>" tabindex="-1" role="dialog" aria-labelledby="ElectionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <br><br>
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-white" style="background: white; width: 100%; display: flex; align-items: center; padding: 20px;">
                <h5 class="modal-title" id="Election">Edit Election</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                
                
             <div class="card-body">
                      <form method="POST" enctype="multipart/form-data">
                          
    <input type="hidden" name="id" value="<?= htmlspecialchars(filter_var($row->id,FILTER_SANITIZE_NUMBER_INT),ENT_QUOTES,'UTF-8'); ?>">

    <div class="mb-3">
        <label for="election_name" class="form-label">Election Name:</label>
        <input type="text" id="election_name" name="election_name" class="form-control" 
               value="<?= htmlspecialchars($row->election_name); ?>" 
               placeholder="Enter election name" required>
    </div>

    <div class="mb-3">
        <label for="election_description" class="form-label">Election Description:</label>
        <textarea id="election_description" name="election_description" class="form-control" rows="4" 
                  placeholder="Write a brief description of the election" required><?= htmlspecialchars($row->election_description); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date:</label>
        <input type="date" id="start_date" name="start_date" class="form-control" 
               value="<?= htmlspecialchars($row->start_date); ?>" required>
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">End Date:</label>
        <input type="date" id="end_date" name="end_date" class="form-control" 
               value="<?= htmlspecialchars($row->end_date); ?>" required>
    </div>

    <!-- Custom File Upload for Election Banner -->
    <div class="mb-3">
        <label for="election_banner" class="form-label">Upload Election Banner (Optional):</label>
        <br>
        <a target="blank" href="images/election_banners/<?= htmlspecialchars($row->election_banner,ENT_QUOTES,'UTF-8'); ?>">
        <img class="img" style="width: 100px; height: 100px;" src="images/election_banners/<?= htmlspecialchars($row->election_banner,ENT_QUOTES,'UTF-8'); ?>">
         </a>
        <!-- for the image -->
        <input type="hidden" name="image" value="<?= htmlspecialchars($row->election_banner,ENT_QUOTES,'UTF-8'); ?>">
        
        
        <div class="input-group">
            <input type="text" id="file-name" class="form-control" placeholder="Upload File" 
                   readonly>
            <input type="file" id="election_banner" name="banner[]" class="form-control d-none" accept="image/*">
            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('election_banner').click();">
                Choose File
            </button>
        </div>
    </div>

    <div class="text-start">
        <button type="submit" name="edit_election" class="btn btn-primary">Update Election</button>
    </div>
</form>


                    </div>
            </div>
        </div>
    </div>
</div>

                           </td>
                        <td></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
              
            <?php endif; ?>
        </tbody>
    </table>
    
    
     <div id="noResults1">
                    <p class="text-center text-danger">No results found</p>
                </div>
    
    
    
    <script>
    document.getElementById("election_banner").addEventListener("change", function () {
        let fileName = this.files[0] ? this.files[0].name : "Upload File";
        document.getElementById("file-name").value = fileName;
    });
</script>


                  <?php /*
               <table class="table align-items-center mb-0">
  <thead>
    <tr>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Candidates</th>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Votes</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Progress</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div class="d-flex px-2 py-1">
          <div>
            <img src="../assets/img/candidate-1.jpg" class="avatar avatar-sm me-3" alt="candidate1">
          </div>
          <div class="d-flex flex-column justify-content-center">
            <h6 class="mb-0 text-sm">John Doe</h6>
            <p class="text-xs text-muted mb-0">Candidate for Mayor</p>
          </div>
        </div>
      </td>
      <td>
        <span class="text-xs font-weight-bold">4,500 Votes</span>
      </td>
      <td class="align-middle text-center text-sm">
        <span class="badge bg-success">Active</span>
      </td>
      <td class="align-middle">
        <div class="progress-wrapper w-75 mx-auto">
          <div class="progress-info">
            <div class="progress-percentage">
              <span class="text-xs font-weight-bold">75%</span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-gradient-success w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="d-flex px-2 py-1">
          <div>
            <img src="../assets/img/candidate-2.jpg" class="avatar avatar-sm me-3" alt="candidate2">
          </div>
          <div class="d-flex flex-column justify-content-center">
            <h6 class="mb-0 text-sm">Jane Smith</h6>
            <p class="text-xs text-muted mb-0">Candidate for Mayor</p>
          </div>
        </div>
      </td>
      <td>
        <span class="text-xs font-weight-bold">3,200 Votes</span>
      </td>
      <td class="align-middle text-center text-sm">
        <span class="badge bg-warning">Pending</span>
      </td>
      <td class="align-middle">
        <div class="progress-wrapper w-75 mx-auto">
          <div class="progress-info">
            <div class="progress-percentage">
              <span class="text-xs font-weight-bold">50%</span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-gradient-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="d-flex px-2 py-1">
          <div>
            <img src="../assets/img/candidate-3.jpg" class="avatar avatar-sm me-3" alt="candidate3">
          </div>
          <div class="d-flex flex-column justify-content-center">
            <h6 class="mb-0 text-sm">Samuel Lee</h6>
            <p class="text-xs text-muted mb-0">Candidate for Governor</p>
          </div>
        </div>
      </td>
      <td>
        <span class="text-xs font-weight-bold">2,150 Votes</span>
      </td>
      <td class="align-middle text-center text-sm">
        <span class="badge bg-danger">Inactive</span>
      </td>
      <td class="align-middle">
        <div class="progress-wrapper w-75 mx-auto">
          <div class="progress-info">
            <div class="progress-percentage">
              <span class="text-xs font-weight-bold">30%</span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-gradient-danger w-30" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>
*/ ?>
              </div>
            </div>
          </div>
        </div>
        
        
       
 
      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>
                
              </div>
            </div>
           
          </div>
        </div>
      </footer>
    </div>
  </div>
  </main>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
 
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>

  


</body>

</html>

<style>
.collapse {
  transition: height 0.3s ease;
}

.collapse.show {
  height: auto;
}

.nav-link {
  background-color: transparent; 
  color: black !important;
  padding: 8px 16px; 
}

.nav-link:hover {
  background-color: transparent; 
  color: #333 !important; 
}



</style>

<script>
$(document).ready(function() {
    // Initially hide "No results found" message
    $("#noResults1").hide();

    // Live search functionality
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var rows = $("#electionsTable tr");
        var found = false;

        rows.each(function() {
            var rowText = $(this).text().toLowerCase();
            if (rowText.includes(value)) {
                $(this).show();
                found = true;
            } else {
                $(this).hide();
            }
        });

        // Show or hide the "No results found" message
        $("#noResults1").toggle(!found);
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
            url: "php/delete_elections.php",
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



<style>
.collapse {
  transition: height 0.3s ease;
}

.collapse.show {
  height: auto;
}
.nav-link {
  background-color: transparent; 
  color: black !important; 
  padding: 8px 16px; 
}

.nav-link:hover {
  background-color: 
  color: #333 !important;
}

label {
    color: black !important;
}
.form-control {
    border-bottom: 1px solid darkgray;
}

.modal-content {
    height: 400px;
    overflow: auto;
    margin: 0px 50px;
}


</style>