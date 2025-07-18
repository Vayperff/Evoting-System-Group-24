<?php
include_once("php/admin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="apple-touch-icon" sizes="76x76" href="../student.png">
  <link rel="icon" type="image/png" href="../student.png">
  
  <title>
   Voter |  Welcome <?= htmlspecialchars($fetchStudent->username); ?>
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
    background-color: #F8F9FA !important;
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

<body class="g-sidenav-show  bg-gray-100">
 <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="" target="_blank">
            <span class="ms-1 text-sm text-dark">Welcome Voter <br> <?= $fetchStudent->username; ?></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="navbar-collapse w-auto">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active bg-gradient-dark text-white" href="dashboard.php">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="dashboard.php">
                    <i class="material-symbols-rounded opacity-5">how_to_vote</i>
                    <span class="nav-link-text ms-1">View Elections</span>
                </a>
            </li>
            <!--
            <li class="nav-item">
                <a class="nav-link text-dark" href="candidate_profiles.php">
                    <i class="material-symbols-rounded opacity-5">groups</i>
                    <span class="nav-link-text ms-1">Candidate Profiles</span>
                </a>
            </li>
            -->
            <li class="nav-item">
                <a class="nav-link text-dark" href="voting_history.php">
                    <i class="material-symbols-rounded opacity-5">history</i>
                    <span class="nav-link-text ms-1">Voting History</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="view_results.php">
                    <i class="material-symbols-rounded opacity-5">bar_chart</i>
                    <span class="nav-link-text ms-1">Election Results</span>
                </a>
            </li>
            <!--
            <li class="nav-item">
                <a class="nav-link text-dark" href="help.php">
                    <i class="material-symbols-rounded opacity-5">help</i>
                    <span class="nav-link-text ms-1">Help & Guidelines</span>
                </a>
            </li>
            -->
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
    <li><a class="dropdown-item py-2" href="dashboard.php">View Elections</a></li>
    <li><a class="dropdown-item py-2" href="voting_history.php">Voting History</a></li>
    <li><a class="dropdown-item py-2" href="view_results.php">Election Results</a></li>
    <li><a class="dropdown-item py-2 text-danger" href="logout.php">Logout</a></li>
    <li class="dropdown-item text-muted d-none" id="noResults">No results found</li>
  </ul>
</div>
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
