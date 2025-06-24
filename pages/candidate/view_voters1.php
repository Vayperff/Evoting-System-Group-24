<?php
include_once("php/elections.php");


if(isset($_GET['view_voters1'])) {
    $candidate_id = $mysqli->real_escape_string(filter_var($_GET['candidate_id'],FILTER_SANITIZE_NUMBER_INT));
    
    $sql = $mysqli->prepare("SELECT * FROM votes WHERE candidate_id = ? AND voting_status = 1");
    $sql->bind_param("i",$candidate_id);
    $sql->execute();
    $resvoters1 = $sql->get_result();
    
    
    
    $sqlcandidates = $mysqli->prepare("SELECT * FROM candidates WHERE id = ?");
    $sqlcandidates->bind_param("i",$candidate_id);
    $sqlcandidates->execute();
    $rescandidates = $sqlcandidates->get_result();
    $candidate = $rescandidates->fetch_object();
    
    
    
}

?>

<?php include_once("navbar.php"); ?>



    <div class="container-fluid py-2" style="overflow: hidden;">
    <div class="row">
  <!-- Dashboard Header -->
  <div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Voters who voted for <span class="text-info"> 
    
    <span style="text-decoration:underline; ">
        <?= $candidate->candidate_name; ?>
        
        </span>


        
        for the role of  <span style="text-decoration:underline; ">
            <?= $candidate->candidate_role; ?>
            </span>
            </span>
            </h3>
    <p class="mb-4">Overview of election statistics and voting progress</p>
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
    <h6>Elections running</h6>
    <p class="text-sm mb-0">
      <i class="fa fa-check text-info" aria-hidden="true"></i>
      <span class="font-weight-bold ms-1"><?= number_format($resvoters1->num_rows); ?> voters </span> voted for  <span class="font-weight-bold ms-1">
          <?= htmlspecialchars($candidate->candidate_name); ?> for the role of <?= htmlspecialchars($candidate->candidate_role); ?>
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
              <table class="table align-items-center mb-0">
  <thead>
    <tr>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Registration number</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date registered</th>
    </tr>
  </thead>
  <tbody>
    <?php if($resvoters1->num_rows > 0): ?>
      <?php while($row1 =  $resvoters1->fetch_object()) { ?>
        <?php
          $student_ids = filter_var($row1->user_id,FILTER_SANITIZE_NUMBER_INT);
          $sqlvoters = $mysqli->prepare("SELECT * FROM student_sign_up WHERE id = ?");
          $sqlvoters->bind_param("i",$student_ids);
          $sqlvoters->execute();
          $resvoters = $sqlvoters->get_result();
          $row = $resvoters->fetch_object();
        ?>
        <tr>
          <td>
            <div class="d-flex px-2 py-1">
              <!-- Clickable Image -->
              <div>
                <img src="student/images/profile_images/<?= htmlspecialchars($row->image); ?>" 
                     class="avatar avatar-sm me-3" 
                     alt="candidate2" 
                     data-bs-toggle="modal" 
                     data-bs-target="#imageModal_<?= $row->id; ?>" 
                     style="cursor: pointer;">
              </div>

              <!-- Candidate Info -->
              <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm"><?= htmlspecialchars($row->username); ?></h6>
                <p class="text-xs text-muted mb-0"><?= htmlspecialchars($row->email); ?></p>
              </div>
            </div>

            <!-- Bootstrap Modal for Larger Image -->
            <div class="modal fade" id="imageModal_<?= $row->id; ?>" tabindex="-1" aria-labelledby="imageModalLabel_<?= $row->id; ?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body text-center">
                    <img src="student/images/profile_images/<?= htmlspecialchars($row->image); ?>" 
                         class="img-fluid rounded" 
                         alt="Expanded Image">
                  </div>
                </div>
              </div>
            </div>

          </td>
          
          <td>
            <?= htmlspecialchars($row->reg_name); ?>
          </td>
          
          <td>
            <?= htmlspecialchars($row->phone); ?>
          </td>
          <td>
            <?= htmlspecialchars($row->date_format); ?>
          </td>
        </tr>
      <?php } ?>
    <?php else: ?>
      <tr>
        <td colspan="4" class=" text-uppercase text-secondary text-center" style="font-size: 1.5rem; color: #6c757d;">
          No voters for this candidate
        </td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>


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
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["M", "T", "W", "T", "F", "S", "S"],
        datasets: [{
          label: "Views",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#43A047",
          data: [50, 45, 22, 28, 50, 60, 76],
          barThickness: 'flex'
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: '#e5e5e5'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
              color: "#737373"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"],
        datasets: [{
          label: "Sales",
          tension: 0,
          borderWidth: 2,
          pointRadius: 3,
          pointBackgroundColor: "#43A047",
          pointBorderColor: "transparent",
          borderColor: "#43A047",
          backgroundColor: "transparent",
          fill: true,
          data: [120, 230, 130, 440, 250, 360, 270, 180, 90, 300, 310, 220],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
          tooltip: {
            callbacks: {
              title: function(context) {
                const fullMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                return fullMonths[context[0].dataIndex];
              }
            }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [4, 4],
              color: '#e5e5e5'
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 12,
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 12,
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Tasks",
          tension: 0,
          borderWidth: 2,
          pointRadius: 3,
          pointBackgroundColor: "#43A047",
          pointBorderColor: "transparent",
          borderColor: "#43A047",
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [4, 4],
              color: '#e5e5e5'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#737373',
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [4, 4]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
        },
      },
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
  /* Add smooth transition for the collapsible sections */
.collapse {
  transition: height 0.3s ease;
}

.collapse.show {
  height: auto;
}
/* Style for the <a> links to remove background and set text color to black */
.nav-link {
  background-color: transparent; /* Remove background */
  color: black !important; /* Set text color to black */
  padding: 8px 16px; /* Optional: Adjust padding if needed */
}

.nav-link:hover {
  background-color: transparent; /* Ensure background remains transparent on hover */
  color: #333 !important; /* Optional: Set text color to a dark shade on hover */
}



</style>