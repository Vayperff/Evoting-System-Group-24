<?php
//include_once("php/elections.php");
include_once("php/add_candidate.php");

$sql = $mysqli->prepare("SELECT * FROM elections WHERE deleted != 'DELETED' AND status != 'COMPLETED' ORDER BY date_created DESC");
$sql->execute();
$elections = $sql->get_result();

if(isset($_GET['editCandidate'])) {
    $candidateId = $mysqli->real_escape_string(filter_var($_GET['candidate_id'],FILTER_SANITIZE_NUMBER_INT));
    $num = $mysqli->real_escape_string(filter_var($_GET['num'],FILTER_SANITIZE_NUMBER_INT));
    
    $sql = $mysqli->prepare("SELECT * FROM candidates WHERE id = ?");
    $sql->bind_param("i",$candidateId);
    $sql->execute();
    $res = $sql->get_result();
    $row = $res->fetch_object();
    
    
    $election_id = filter_var($row->election_id,FILTER_SANITIZE_NUMBER_INT);
                
    $sqlElection = $mysqli->prepare("SELECT * FROM elections WHERE id = ? AND deleted != 'DELETED'");
    $sqlElection->bind_param("i",$election_id);
    $sqlElection->execute();
    $resElection = $sqlElection->get_result();
    $electionData = $resElection->fetch_object();
                
                
}


?>

<?php include_once("navbar.php"); ?>



    <div class="container-fluid py-4">
 
        <!-- Dashboard Header -->
        <div class="ms-3">
            <h3 class="mb-0 h4 font-weight-bolder text-dark text-start">
                Edit information for candidate <span class="text-info"> <?= $row->candidate_name; ?></span>
                
            </h3>
            
            <p class="mb-4 text-start">
                Candidate has <span class="text-success">
                    <b>
                    <?= number_format($num); ?> votes
                    </b>
                </span>
            </p>
        </div>

        <div class="row mb-4">
            <div class="col-lg-10 col-md-10 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        
                        <?php if($elections->num_rows > 0): ?>
                        <h6 class="mb-0 text-dark">Candidate Information</h6>
                        <?php else: ?>
                        <h6 class="mb-0 text-dark">Candidate Information
                         
                         <span class="text-danger">
                             No elections currrently running, candidate cannot be registered
                         </span>
                        </h6>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                       <form  method="POST" enctype="multipart/form-data">
     
     <input type="hidden" name="id" value="<?= htmlspecialchars(filter_var($row->id,FILTER_SANITIZE_NUMBER_INT),ENT_QUOTES,'UTF-8'); ?>">
     
     
                            <div class="mb-3">
                                <label for="candidate_name" class="form-label">Candidate Name:</label>
                                <input type="text" id="candidate_name" name="candidate_name" class="form-control" 
                                       placeholder="Enter candidate's full name" required value="<?= htmlspecialchars($row->candidate_name,ENT_QUOTES,'UTF-8'); ?>">
                            </div>
                            
                            
                            <div class="mb-3">
                                <label for="candidate_email" class="form-label">Candidate Email</label>
                                <input type="email" id="candidate_email" name="candidate_email" class="form-control" 
                                       placeholder="Enter candidate's Email" required value="<?= htmlspecialchars($row->email,ENT_QUOTES,'UTF-8'); ?>">
                            </div>
                            
                         <div class="mb-3">
        <label for="candidate_role_<?= $row->id ?>" class="form-label">Role (Position):</label>
        
        
        <select name="candidate_role[]" class="candidate_role form-control" data-hidden-input="election_name_<?= $row->id ?>" required>
            
           
            <option selected value="<?= htmlspecialchars($electionData->id . '|' . $electionData->election_name, ENT_QUOTES, 'UTF-8'); ?>">
                
                
                * <?= htmlspecialchars($electionData->election_name . " (Start: " . $electionData->start_date . " | End: " . $electionData->end_date . ")", ENT_QUOTES, 'UTF-8'); ?> *
                
                
                
            </option>
          
            
            <option value="">Enter the position the candidate is running for</option>
            <?php while ($row1 = $elections->fetch_object()): ?>
                <option value="<?= htmlspecialchars($row1->id . '|' . $row1->election_name, ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($row1->election_name . " (Start: " . $row1->start_date . " | End: " . $row1->end_date . ")", ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <input type="hidden" name="election_name[]" id="election_name_<?= $row->id ?>">
    </div>
                          
                            
                            <!--

                            <div class="mb-3">
                                <label for="candidate_role" class="form-label">Role (Position):</label>
                                <input type="text" id="candidate_role" name="candidate_role" class="form-control" 
                                       placeholder="Enter the position the candidate is running for" required>
                            </div>
                            
                            -->
                            
                            
                            <div class="mb-3">
                                <label for="candidate_bio" class="form-label">Candidate Biography:</label>
                                <textarea id="candidate_bio" name="candidate_bio" class="form-control" rows="4" 
                                          placeholder="Write a brief biography of the candidate" required><?= htmlspecialchars($row->candidate_bio,ENT_QUOTES,'UTF-8'); ?></textarea>
                            </div>

                            <!-- Custom File Upload with Displayed File Name -->
                            <div class="mb-3">
                                <label for="candidate_image" class="form-label">Upload Candidate Image:</label>
                                
                                 <br>
        <a target="blank" href="images/candidate_images/<?= htmlspecialchars($row->candidate_image,ENT_QUOTES,'UTF-8'); ?>">
        <img class="img" style="width: 100px; height: 100px;" src="images/candidate_images/<?= htmlspecialchars($row->candidate_image,ENT_QUOTES,'UTF-8'); ?>">
         </a>
        <!-- for the image -->
        <input type="hidden" name="image" value="<?= htmlspecialchars($row->candidate_image,ENT_QUOTES,'UTF-8'); ?>">
        
        
        
        
                                <div class="input-group">
                                    <input type="text" id="file-name" class="form-control" placeholder="Upload File" readonly>
                                    <input type="file" id="candidate_image" name="image[]" class="form-control d-none" accept="image/*">
                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('candidate_image').click();">
                                        Choose File
                                    </button>
                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" name="update_candidate1" class="btn btn-primary">Update Candidate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("candidate_image").addEventListener("change", function () {
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