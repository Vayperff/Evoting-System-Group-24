<?php
include_once("php/sign_up.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../student.png">
  <link rel="icon" type="image/png" href="../student.png">
  <title>
    Student voting system
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .error { color: red; font-size: 14px; }
    </style>
    
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-2 pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="dashboard.php">
              UICT voting system
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
             
               <ul class="navbar-nav d-lg-flex d-none">
                <li class="nav-item d-flex align-items-center">
                  <a class="btn  btn-sm mb-0 me-2" href="sign-in.php">Sign in</a>
                </li>
                <li class="nav-item" style="background-image: url('../system-image.png'); background-size: fit; border-radius: 10%;">
                  <a href="sign-up.php" class="btn btn-sm mb-0 me-1 text-white">Sign up</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../system-image.png'); background-size: cover;">
              </div>
              
              
                <!--
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
              </div>
              -->
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                  <p class="mb-0">Enter your email and password to register</p>
                </div>
                <div class="card-body">
                 
              <form role="form" method="POST" id="signupForm" enctype="multipart/form-data">
    <div class="input-group input-group-outline mb-3">
        <input type="text" name="names" id="names" class="form-control" placeholder="Name">
    </div>
    <div class="mb-2">
        <span class="error text-danger" id="nameError"></span>
    </div>

    <div class="input-group input-group-outline mb-3">
        <input type="text" name="reg_number" id="reg_number" class="form-control text-uppercase" placeholder="Registration Number">
    </div>
    <div class="mb-2">
        <span class="error text-danger" id="regNumberError"></span>
    </div>

    <div class="input-group input-group-outline mb-3">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
    </div>
    <div class="mb-2">
        <span class="error text-danger" id="emailError"></span>
    </div>

    <div class="input-group input-group-outline mb-3">
        <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone Number">
    </div>
    <div class="mb-2">
        <span class="error text-danger" id="phoneError"></span>
    </div>

   <div class="input-group input-group-outline mb-3">
    <button type="button" style="background-image: url('../system-image.png'); background-size: fit;" class="btn btn-dark w-100" id="uploadBtn">Upload Profile Image</button>
    <input type="file" name="image[]" id="profileImage" class="form-control" accept=".jpg, .png, .webp" style="display: none;">
</div>

<!-- Display selected file name -->
<div class="mb-2">
    <input type="text" id="fileNameDisplay" class="form-control" placeholder="No file chosen" readonly>
    <span class="error text-danger" id="imageError"></span>
</div>


    <div class="input-group input-group-outline mb-3">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
    </div>
    <div class="mb-2">
        <span class="error text-danger" id="passwordError"></span>
    </div>

    <div class="input-group input-group-outline mb-3">
        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
    </div>
    <div class="mb-2">
        <span class="error text-danger" id="confirmPasswordError"></span>
    </div>

    <div class="form-check form-check-info text-start ps-0">
        <input class="form-check-input" type="checkbox" name="terms" id="terms">
        <label class="form-check-label" for="terms">
            I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
        </label>
    </div>
    <div class="mb-2">
        <span class="error text-danger" id="termsError"></span>
    </div>

    <div class="text-center">
        <button type="submit" name="signup" style="background-image: url('../system-image.png'); background-size: fit;" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Sign Up</button>
    </div>
</form>


                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="sign-in.php" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
        let regNumber = $("#reg_number").val().trim();
        let regNumberPattern = /^[a-zA-Z0-9\/-]+$/;

        if (regNumber === "") {
            $("#regNumberError").text("Registration Number is required.");
            isValid = false;
        } else if (!regNumberPattern.test(regNumber)) {
            $("#regNumberError").text("Only letters and numbers are allowed.");
            isValid = false;
        } else {
            $("#regNumberError").text("");
        }

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

        // Terms and Conditions Validation
        if (!$("#terms").is(":checked")) {
            $("#termsError").text("You must agree to the Terms and Conditions.");
            isValid = false;
        } else {
            $("#termsError").text("");
        }

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
