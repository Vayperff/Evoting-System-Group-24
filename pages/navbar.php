<?php
include_once("php/admin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="apple-touch-icon" sizes="76x76" href="student.png">
  <link rel="icon" type="image/png" href="student.png">
  <title>
   Admin |  Welcome <?= htmlspecialchars($fetchAdmin->username); ?>
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  
  
   
  <style>
   @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@300;400;700&display=swap') !important;

body, main, nav{
    font-family: 'Roboto', sans-serif !important;
    /*background-color: #F8F9FA !important;*/
    color: #333 !important;
}

h1, h2, h3 {
    font-family: 'Montserrat', sans-serif !important;
    font-weight: 700 !important;
    color: #0056b3 !important;
}

.btn-primary {
    background-color: #007BFF !important;
    border-color: #0056b3 !important;
}

.btn-success {
    background-color: #28a745 !important;
}

.btn-warning {
    background-color: #FFC107 !important;
}

  </style>
  
  
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-success-100">
    
    
    
 <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand px-4 py-3 m-0" target="_blank" style="display: block; text-align: center;">
      <img src="../super_admin/images/profile_images/<?= $fetchAdmin->image; ?>" class="navbar-brand-img" alt="main_logo" style="width: 100%; height: 300px !important; max-width: 150px;">
      <span class="ms-1 text-sm text-dark" style="display: block; margin-top: 10px;">
        Welcome Admin <br> <?= $fetchAdmin->username; ?>
      </span>
    </a>
  </div>

  <hr class="horizontal dark mt-0 mb-2">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active bg-gradient-dark text-white" href="dashboard.php">
          <i class="material-symbols-rounded opacity-5">dashboard</i>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-dark" href="create_election.php">
          <i class="material-symbols-rounded opacity-5">how_to_vote</i>
          <span class="nav-link-text ms-1">Election Management</span>
        </a>
        <ul class="list-unstyled ps-3">
          <li><a class="nav-link" href="create_election.php">Create New Election</a></li>
          <li><a class="nav-link" href="manage_elections.php">Manage Elections</a></li>
          <li><a class="nav-link" href="view_results.php">View Results</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link text-dark" href="add_candidate.php">
          <i class="material-symbols-rounded opacity-5">groups</i>
          <span class="nav-link-text ms-1">Candidate Management</span>
        </a>
        <ul class="list-unstyled ps-3">
          <li><a class="nav-link" href="add_candidate.php">Add New Candidate</a></li>
          <li><a class="nav-link" href="manage_candidates.php">Manage Candidates</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link text-dark" href="voters.php">
          <i class="material-symbols-rounded opacity-5">person</i>
          <span class="nav-link-text ms-1">Voter Management</span>
        </a>
        <ul class="list-unstyled ps-3">
          <li><a class="nav-link" href="voters.php">View Registered Voters</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link text-danger" href="logout.php">
          <i class="material-symbols-rounded opacity-5">logout</i>
          <span class="nav-link-text ms-1">Logout</span>
        </a>
      </li>
    </ul>
  </div>
</aside>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <!-- Search Input with Styled Dropdown -->
<div class="ms-md-auto pe-md-3 d-flex align-items-center position-relative" style="flex: 1;">
  <div class="input-group input-group-outline w-100" style="min-width: 300px;">
    <label class="form-label">Type here...</label>
    <input type="text" id="SearchPages" class="form-control" oninput="filterPages()" onclick="showDropdown()" onblur="hideDropdownWithDelay()" style="font-size: 14px; padding: 10px;">
  </div>

  <!-- Dropdown list -->
  <ul id="pagesDropdown" class="dropdown-menu w-100 shadow-sm show"
      style="
        display: none;
        max-height: 250px;
        overflow-y: auto;
        position: absolute;
        top: 55px; /* push dropdown lower */
        z-index: 1050;
        font-size: 13px;  /* smaller font */
      ">
    <li><a class="dropdown-item py-2" href="dashboard.php">Dashboard</a></li>
    <li><a class="dropdown-item py-2" href="create_election.php">Create New Election</a></li>
    <li><a class="dropdown-item py-2" href="manage_elections.php">Manage Elections</a></li>
    <li><a class="dropdown-item py-2" href="view_results.php">View Results</a></li>
    <li><a class="dropdown-item py-2" href="add_candidate.php">Add New Candidate</a></li>
    <li><a class="dropdown-item py-2" href="manage_candidates.php">Manage Candidates</a></li>
    <li><a class="dropdown-item py-2" href="voters.php">View Registered Voters</a></li>
    <li><a class="dropdown-item py-2" href="#candidate_profiles.php">Candidate Profiles</a></li>
    <li><a class="dropdown-item py-2" href="voting_history.php">Voting History</a></li>
    <li><a class="dropdown-item py-2" href="#help.php">Help & Guidelines</a></li>
    <li class="dropdown-item text-muted d-none" id="noResults">No results found</li>
  </ul>
</div>

<!-- JS Logic (Same as before) -->
<script>
  function showDropdown() {
    document.getElementById('pagesDropdown').style.display = 'block';
  }

  function hideDropdownWithDelay() {
    setTimeout(() => {
      document.getElementById('pagesDropdown').style.display = 'none';
    }, 200);
  }

  function filterPages() {
    const input = document.getElementById('SearchPages').value.toLowerCase();
    const items = document.querySelectorAll('#pagesDropdown .dropdown-item');
    let hasResults = false;

    items.forEach(item => {
      if (item.id === "noResults") return;
      const text = item.textContent.toLowerCase();
      if (text.includes(input)) {
        item.style.display = 'block';
        hasResults = true;
      } else {
        item.style.display = 'none';
      }
    });

    document.getElementById("noResults").classList.toggle("d-none", hasResults);
  }
</script>

          <ul class="navbar-nav d-flex align-items-center  justify-content-end">
           
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
             
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="material-symbols-rounded">account_circle</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    
  
    
       