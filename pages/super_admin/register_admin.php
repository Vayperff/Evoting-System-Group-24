<?php include_once("navbar.php"); ?>


<?php
include_once("php/register_admin.php");

?>



<div class="container-fluid py-4">
    <div class="row">
        <!-- Dashboard Header -->
        <div class="ms-3">
            <h3 class="mb-0 h4 font-weight-bolder text-dark text-start">
                Register new admin
            </h3>
            <p class="mb-4 text-start">Register a new admin</p>
        </div>

        <div class="row mb-4 justify-content-start">
            <div class="col-lg-7 col-md-8" style="margin-left: 10px !important;">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 text-dark">Admin Information</h6>
                    </div>
                    <div class="card-body">
                        <!-- Replaced Form Starts Here -->
                        <form role="form" method="POST" id="signupForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="names" class="form-label">Name</label>
                                <input type="text" name="names" id="names" class="form-control" placeholder="Name">
                                <span class="error text-danger" id="nameError"></span>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                <span class="error text-danger" id="emailError"></span>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone Number">
                                <span class="error text-danger" id="phoneError"></span>
                            </div>

                            <div class="mb-3">
                                <button type="button" class="btn btn-dark w-100" id="uploadBtn">Upload Profile Image</button>
                                <input type="file" name="image[]" id="profileImage" class="form-control d-none" accept=".jpg, .png, .webp">
                                <input type="text" id="fileNameDisplay" class="form-control mt-2" placeholder="No file chosen" readonly>
                                <span class="error text-danger" id="imageError"></span>
                            </div>

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
                                <button type="submit" name="signup" class="btn btn-lg bg-gradient-dark w-100">Sign Up</button>
                            </div>
                        </form>
                        <!-- Replaced Form Ends Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



  <!--
<script>
    // Display selected file name
    document.getElementById('uploadBtn').addEventListener('click', function () {
        document.getElementById('profileImage').click();
    });

    document.getElementById('profileImage').addEventListener('change', function () {
        const fileName = this.files[0]?.name || 'No file chosen';
        document.getElementById('fileNameDisplay').value = fileName;
    });
</script>
-->

<script>
    document.getElementById("election_banner").addEventListener("change", function () {
        let fileName = this.files[0] ? this.files[0].name : "Upload File";
        document.getElementById("file-name").value = fileName;
    });
</script>

        
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
} else if (!/^[A-Za-z\s]+$/.test($("#names").val().trim())) {
    $("#nameError").text("Name must only contain letters and spaces. No symbols or dots allowed.");
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
  background-color: 
  color: #333 !important;
}

label {
    color: black !important;
}
.form-control {
    border-bottom: 1px solid darkgray;
}


</style>