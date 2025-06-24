 <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
  <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
  <a class="navbar-brand px-4 py-3 m-0" target="_blank" style="display: block; text-align: center;">
    <img src="images/profile_images/<?= $fetchAdmin->image; ?>" class="navbar-brand-img" 
         alt="main_logo" 
         style=" width: 100%; height: 300px !important; max-width: 150px;">
    <span class="ms-1 text-sm text-dark" style="display: block; margin-top: 10px;">
      Welcome Admin <br> <?= $fetchAdmin->username; ?>
    </span>
  </a>
</div>

    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="../pages/dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
  <a class="nav-link text-dark" href="../pages/dashboard.php">
    <i class="material-symbols-rounded opacity-5">dashboard</i>
    <span class="nav-link-text ms-1">Dashboard</span>
  </a>
</li>

<!-- Election Management Accordion -->
<li class="nav-item">
  <a class="nav-link text-dark" data-bs-toggle="collapse" href="#electionManagement" role="button" aria-expanded="false" aria-controls="electionManagement">
    <i class="material-symbols-rounded opacity-5">how_to_vote</i>
    <span class="nav-link-text ms-1">Election Management</span>
  </a>
  <div class="collapse" id="electionManagement">
    <ul class="list-unstyled ps-3">
      <li><a class="nav-link" href="../pages/create_election.php">Create New Election</a></li>
      <li><a class="nav-link" href="../pages/manage_elections.php">Manage Elections</a></li>
      <li><a class="nav-link" href="../pages/view_results.php">View Results</a></li>
      <!--
      <li><a class="nav-link" href="../pages/archived_elections.php">Archived Elections</a></li>
      <li><a class="nav-link" href="../pages/election_logs.php">Election Logs</a></li>
      -->
    </ul>
  </div>
</li>

<!-- Candidate Management Accordion -->
<li class="nav-item">
  <a class="nav-link text-dark" data-bs-toggle="collapse" href="#candidateManagement" role="button" aria-expanded="false" aria-controls="candidateManagement">
    <i class="material-symbols-rounded opacity-5">groups</i>
    <span class="nav-link-text ms-1">Candidate Management</span>
  </a>
  <div class="collapse" id="candidateManagement">
    <ul class="list-unstyled ps-3">
      <li><a class="nav-link" href="../pages/add_candidate.php">Add New Candidate</a></li>
      <li><a class="nav-link" href="../pages/manage_candidates.php">Manage Candidates</a></li>
      <!--
      <li><a class="nav-link" href="../pages/candidate_reports.php">Candidate Reports</a></li>
      <li><a class="nav-link" href="../pages/remove_candidates.php">Remove Candidates</a></li>
      -->
    </ul>
  </div>
</li>

<!-- Voter Management Accordion -->
<li class="nav-item">
  <a class="nav-link text-dark" data-bs-toggle="collapse" href="#voterManagement" role="button" aria-expanded="false" aria-controls="voterManagement">
    <i class="material-symbols-rounded opacity-5">person</i>
    <span class="nav-link-text ms-1">Voter Management</span>
  </a>
  <div class="collapse" id="voterManagement">
    <ul class="list-unstyled ps-3">
      <li><a class="nav-link" href="../pages/view_voters.php">View Registered Voters</a></li>
      <!--
      <li><a class="nav-link" href="../pages/approve_voters.php">Approve/Revoke Voters</a></li>
      <li><a class="nav-link" href="../pages/voter_reports.php">Voter Reports</a></li>
      <li><a class="nav-link" href="../pages/ban_voters.php">Ban Voters</a></li>
      -->
    </ul>
  </div>
</li>

<!-- Voting Results Accordion 
<li class="nav-item">
  <a class="nav-link text-dark" data-bs-toggle="collapse" href="#votingResults" role="button" aria-expanded="false" aria-controls="votingResults">
    <i class="material-symbols-rounded opacity-5">bar_chart</i>
    <span class="nav-link-text ms-1">Voting Results</span>
  </a>
  <div class="collapse" id="votingResults">
    <ul class="list-unstyled ps-3">
      <li><a class="nav-link" href="../pages/view_results.php">View Results</a></li>
    </ul>
  </div>
</li>
-->
<!-- User Authentication Accordion 
<li class="nav-item">
  <a class="nav-link text-dark" data-bs-toggle="collapse" href="#authManagement" role="button" aria-expanded="false" aria-controls="authManagement">
    <i class="material-symbols-rounded opacity-5">account_circle</i>
    <span class="nav-link-text ms-1">User Authentication</span>
  </a>
  <div class="collapse" id="authManagement">
    <ul class="list-unstyled ps-3">
      <li><a class="nav-link" href="../pages/login.php">Admin Login</a></li>
      <li><a class="nav-link" href="../pages/manage_roles.php">Manage Roles</a></li>
      <li><a class="nav-link" href="../pages/reset_password.php">Reset Password</a></li>
      <li><a class="nav-link" href="../pages/forgot_password.php">Forgot Password</a></li>
    </ul>
  </div>
</li>
-->
<!-- Settings Accordion 
<li class="nav-item">
  <a class="nav-link text-dark" data-bs-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="settings">
    <i class="material-symbols-rounded opacity-5">settings</i>
    <span class="nav-link-text ms-1">Settings</span>
  </a>
  <div class="collapse" id="settings">
    <ul class="list-unstyled ps-3">
      <li><a class="nav-link" href="../pages/voting_settings.php">Voting Rules</a></li>
      <li><a class="nav-link" href="../pages/update_profile.php">Update Admin Profile</a></li>
      <li><a class="nav-link" href="../pages/configure_notifications.php">Configure Notifications</a></li>
    </ul>
  </div>
</li>
-->
<!-- Notifications
<li class="nav-item">
  <a class="nav-link text-dark" href="../pages/notifications.php">
    <i class="material-symbols-rounded opacity-5">notifications</i>
    <span class="nav-link-text ms-1">Notifications</span>
  </a>
</li>
 -->
<!-- Logout -->
<li class="nav-item">
  <a class="nav-link text-danger" href="logout.php">
    <i class="material-symbols-rounded opacity-5">logout</i>
    <span class="nav-link-text ms-1">Logout</span>
  </a>
</li>

  <!--
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/tables.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/billing.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/virtual-reality.php">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/rtl.php">
            <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.php">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/profile.php">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-in.php">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-up.php">
            <i class="material-symbols-rounded opacity-5">assignment</i>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
        -->
      </ul>
    </div>
   
  </aside>