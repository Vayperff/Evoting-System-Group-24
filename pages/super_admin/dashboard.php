<?php

include_once("php/register_admin.php");


?>

<?php include_once("navbar.php"); ?>



    <div class="container-fluid py-2" style="overflow: hidden;">
    <div class="row">
  <!-- Dashboard Header -->
  <div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Super admin dashboard</h3>
    <p class="mb-4">Overview of admins</p>
  </div>

  <!-- Total Registered Voters -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <?php /*
    <div class="card">
      <div class="card-header p-2 ps-3">
        <div class="d-flex justify-content-between">
          <div>
            <p class="text-sm mb-0 text-capitalize">Total Registered Voters</p>
            <h4 class="mb-0"><?= number_format($resCountVotersNum->num_rows); ?></h4>
          </div>
          <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
            <i class="material-symbols-rounded opacity-10">person</i>
          </div>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-2 ps-3">
        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span> All time</p>
      </div>
    </div>
  </div>

  <!-- Ongoing Elections -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-2 ps-3">
        <div class="d-flex justify-content-between">
          <div>
            <p class="text-sm mb-0 text-capitalize">Ongoing Elections</p>
            <h4 class="mb-0"><?= number_format($resCounElectionsNum->num_rows); ?></h4>
          </div>
          <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
            <i class="material-symbols-rounded opacity-10">campaign</i>
          </div>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-2 ps-3">
        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span> All time</p>
      </div>
    </div>
  </div>

  <!-- Total Votes Cast -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-2 ps-3">
        <div class="d-flex justify-content-between">
          <div>
            <p class="text-sm mb-0 text-capitalize">Total Votes Cast for ongoing elections</p>
            <h4 class="mb-0"><?= number_format($resCounTotalVotesNum->num_rows); ?></h4>
          </div>
          <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
            <i class="material-symbols-rounded opacity-10">ballot</i>
          </div>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-2 ps-3">
        <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder"></span> All time</p>
      </div>
    </div>
  </div>

  <!-- Upcoming Elections -->
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-header p-2 ps-3">
        <div class="d-flex justify-content-between">
          <div>
            <p class="text-sm mb-0 text-capitalize">Completed Elections</p>
            <h4 class="mb-0"><?= number_format($resCounElectionsNum1->num_rows); ?></h4>
          </div>
          <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
            <i class="material-symbols-rounded opacity-10">event</i>
          </div>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-2 ps-3">
        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span> All time</p>
      </div>
    </div>
    */ ?>
  </div>

</div>

   <!-- FOR VOTING TRENDS -->
   <?php /*
      <div class="row">
  <!-- Votes Overview Card -->
  <div class="col-lg-4 col-md-6 mt-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-0">Voting Trends</h6>
        <p class="text-sm">Recent Campaign Performance</p>
        <div class="pe-2">
          <div class="chart">
            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
          </div>
        </div>
        <hr class="dark horizontal">
        <div class="d-flex">
          <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
          <p class="mb-0 text-sm">Campaign sent 2 days ago</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Daily Voting Results Card -->
  <div class="col-lg-4 col-md-6 mt-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-0">Daily Votes</h6>
        <p class="text-sm">(<span class="font-weight-bolder">+15%</span>) increase in today's votes.</p>
        <div class="pe-2">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
          </div>
        </div>
        <hr class="dark horizontal">
        <div class="d-flex">
          <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
          <p class="mb-0 text-sm">Updated 4 min ago</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Task Completion Card (For Candidate Voting Updates) -->
  <div class="col-lg-4 mt-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-0">Candidate Votes</h6>
        <p class="text-sm">Current Status of Each Candidate</p>
        <div class="pe-2">
          <div class="chart">
            <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
          </div>
        </div>
        <hr class="dark horizontal">
        <div class="d-flex">
          <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
          <p class="mb-0 text-sm">Just updated</p>
        </div>
      </div>
    </div>
  </div>
</div>

*/ ?>
   <br><br>
      <div class="row mb-4">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
  <div class="col-lg-6 col-7">
    <h6>Admins </h6>
    <p class="text-sm mb-0">
      <i class="fa fa-check text-info" aria-hidden="true"></i>
     <span class="font-weight-bold ms-1">(<?= number_format($numAdmin); ?>) </span> admins registered
    </p>
  </div>


                <div class="col-lg-6 col-5 my-auto text-end">
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
                  <input type="text" style="border-bottom: 1px solid darkgray" id="search" class="form-control col-md-6 mb-3" placeholder="Search admins...">
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

               <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Candidate image</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Full names</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date registered</th>
                
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Edit</th>
                
            </tr>
        </thead>
        <tbody id="electionsTable">
            <?php if ($numAdmin > 0): ?>
                <?php while ($row = $resAdmins->fetch_object()): ?>
              
                
                
                    <tr data-id="<?= $row->id ?>">
                        
                        <td><input type="checkbox" class="select-row" value="<?= $row->id ?>"></td>
                        
                        
                         <td class="text-center">
                            <?php if (!empty($row->image)): ?>
                                <img src="images/profile_images/<?= htmlspecialchars($row->image) ?>" class="avatar avatar-sm" width="50">
                            <?php else: ?>
                                No image
                            <?php endif; ?>
                        </td>
                        
                        
                        <td><?= htmlspecialchars($row->username) ?></td>
                        
                        <td>
                            <a href="mailto:<?= htmlspecialchars($row->email,ENT_QUOTES,'UTF-8'); ?>">
                            <?= htmlspecialchars($row->email) ?>
                            </a>
                            </td>
                        
                        <td class="text-center"><?= htmlspecialchars($row->phone) ?></td>
                        
                        <td class="text-center"><?= htmlspecialchars($row->date_format) ?></td>
                       
                           <td>
                               <button type="button" class="btn btn-success btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#Candidate<?= htmlspecialchars($row->id); ?>">
    Edit
</button>

<div class="modal fade" id="Candidate<?= htmlspecialchars($row->id); ?>" tabindex="-1" role="dialog" aria-labelledby="ElectionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <br><br>
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-white" style="background: white; width: 100%; display: flex; align-items: center; padding: 20px;">
                <h5 class="modal-title" id="Election">Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                
                
             <div class="card-body">
  <form role="form" method="POST" id="signupForm" enctype="multipart/form-data">
      
      <input type="hidden" name="id" value="<?= $row->id; ?>">
      
                            <div class="mb-3">
                                <label for="names" class="form-label">Name</label>
                                <input type="text" name="names" id="names" class="form-control" placeholder="Name" value="<?= $row->username; ?>">
                                <span class="error text-danger" id="nameError"></span>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= $row->email; ?>">
                                <span class="error text-danger" id="emailError"></span>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="<?= $row->phone; ?>">
                                <span class="error text-danger" id="phoneError"></span>
                            </div>
                            
                            <?php if($row->image !== null): ?>
                            <div class="mb-3">
                                <img class="img" style="height: 200px; height: 200px;" src="images/profile_images/<?= $row->image; ?>">
                                <input type="hidden" name="imageOld" value="<?= $row->image; ?>">
                                
                                <br><br>
                                <input type="file" name="image[]"  class="form-control" accept=".jpg, .png, .webp">
                                
                            </div>
                            <?php else: ?>
                            <div class="mb-3">
                                <span class="text-danger">
                                    No image was uploaded
                                </span>
                                <br><br>
                                <input type="file" name="image[]"  class="form-control " accept=".jpg, .png, .webp">
                                
                            </div>
                            <?php endif; ?>
                            <!--
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                <span class="error text-danger" id="passwordError"></span>
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                                <span class="error text-danger" id="confirmPasswordError"></span>
                            </div>
                            -->

                    <!--
                            <div class="form-check form-check-info text-start ps-0 mb-3">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms">
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                </label>
                                <span class="error text-danger" id="termsError"></span>
                            </div>
-->
                            <div class="text-start">
                                <button type="submit" name="update_admin" class="btn btn-lg bg-gradient-dark w-100">Update admin</button>
                            </div>
                        </form>
                        <!-- Replaced Form Ends Here -->


                    </div>
            </div>
        </div>
    </div>
</div>

                           </td>
                        <td></td>
                    </tr>
                <?php endwhile; ?>
                
            <script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".candidate_role").forEach(function(selectElement) {
        selectElement.addEventListener("change", function() {
            let selectedValue = this.value.split('|');
            let hiddenInputId = this.getAttribute("data-hidden-input");
            document.getElementById(hiddenInputId).value = selectedValue[1] || ''; 
        });
    });
});
</script>


            <?php else: ?>
                <div id="noResults1">
                    <td colspan="7" class="text-center text-danger">No results found</td>
                </div>
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
            <div class="col-lg-6">
              
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
            url: "php/delete_admins.php",
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


<script>
    document.getElementById("election_banner").addEventListener("change", function () {
        let fileName = this.files[0] ? this.files[0].name : "Upload File";
        document.getElementById("file-name").value = fileName;
    });
</script>


 
<script>
$(document).ready(function () {
    // Trigger file dialog on button click
    $("#uploadBtn").click(function () {
        $("#profileImage").click(); // Open file dialog
    });

    // Display selected file name
    $("#profileImage").change(function () {
        let file = this.files[0]; // Get selected file
        if (file) {
            $("#fileNameDisplay").val(file.name); // Display file name
        } else {
            $("#fileNameDisplay").val("No file chosen");
        }
    });

    function validateForm() {
        let isValid = true;

        // Name Validation
        if ($("#names").val().trim() === "") {
            $("#nameError").text("Name is required.");
            isValid = false;
        } else {
            $("#nameError").text("");
        }

        // Registration Number Validation (Letters and Numbers Only) 
        /*
        let regNumber = $("#reg_number").val().trim();
        let regNumberPattern = /^[a-zA-Z0-9]+$/;
        if (regNumber === "") {
            $("#regNumberError").text("Registration Number is required.");
            isValid = false;
        } else if (!regNumberPattern.test(regNumber)) {
            $("#regNumberError").text("Only letters and numbers are allowed.");
            isValid = false;
        } else {
            $("#regNumberError").text("");
        }
        */
        // Email Validation
        let email = $("#email").val().trim();
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "") {
            $("#emailError").text("Email is required.");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $("#emailError").text("Enter a valid email.");
            isValid = false;
        } else {
            $("#emailError").text("");
        }

        // Phone Number Validation (Only Numbers, Minimum 10 Digits)
        let phone = $("#phone").val().trim();
        let phonePattern = /^[0-9]+$/;
        if (phone === "") {
            $("#phoneError").text("Phone Number is required.");
            isValid = false;
        } else if (!phonePattern.test(phone)) {
            $("#phoneError").text("Only numbers are allowed.");
            isValid = false;
        } else if (phone.length < 10) {
            $("#phoneError").text("Phone Number must be at least 10 digits.");
            isValid = false;
        } else {
            $("#phoneError").text("");
        }

        // Image Validation
        let fileInput = $("#profileImage")[0];
        if (fileInput.files.length > 0) {
            let file = fileInput.files[0];
            let fileType = file.type;
            let allowedTypes = ["image/jpeg", "image/png", "image/webp"];

            if (!allowedTypes.includes(fileType)) {
                $("#imageError").text("Only JPG, PNG, and WEBP formats are allowed.");
                isValid = false;
            } else {
                $("#imageError").text("");
            }
        }

        // Password Validation
        if ($("#password").val().length < 6) {
            $("#passwordError").text("Password must be at least 6 characters.");
            isValid = false;
        } else {
            $("#passwordError").text("");
        }

        // Confirm Password Validation
        if ($("#confirm_password").val() !== $("#password").val()) {
            $("#confirmPasswordError").text("Passwords do not match.");
            isValid = false;
        } else {
            $("#confirmPasswordError").text("");
        }

       /*
        // Terms and Conditions Validation
        if (!$("#terms").is(":checked")) {
            $("#termsError").text("You must agree to the Terms and Conditions.");
            isValid = false;
        } else {
            $("#termsError").text("");
        }
*/
        return isValid;
    }

    // Real-time validation on input change
    $("input").on("input", function () {
        validateForm();
    });

    // Prevent form submission if validation fails
    $("#signupForm").on("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
});
</script>
