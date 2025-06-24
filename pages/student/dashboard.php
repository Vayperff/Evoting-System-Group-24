
<?php include_once("navbar.php"); ?>
<?php
include_once("php/elections.php");
include_once("php/vote.php");




?>



    <div class="container-fluid py-2" style="overflow: hidden;">
    <div class="row">
  <!-- Dashboard Header -->
  <div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Voting Dashboard</h3>
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
    <h6>Elections</h6>
    <p class="text-sm mb-0">
      <i class="fa fa-check text-info" aria-hidden="true"></i>
      <span class="font-weight-bold ms-1">(<?= htmlspecialchars(number_format($elections->num_rows)); ?>)</span> in the running
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
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
          Vote now
      </th>
      
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Election names</th>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Election description</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start date</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End date</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Period of time left</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date created</th>
      
    </tr>
  </thead>
 <tbody>
    <?php while($row = $elections->fetch_object()) { ?>
        <?php
        $sqlCandidateId = filter_var($row->id, FILTER_SANITIZE_NUMBER_INT);
        $sqlCandidates = $mysqli->prepare("SELECT * FROM candidates WHERE election_id = ? AND deleted != 'DELETED'");
        $sqlCandidates->bind_param("i", $sqlCandidateId);
        $sqlCandidates->execute();
        $resCandidates = $sqlCandidates->get_result();
        
        
        
        $currentDate = date("Y-m-d");
        
        //echo $currentDate;
        
        $endDateForElections = $row->end_date;
         
         //echo $row->end_date;
         
         if($currentDate === $endDateForElections) {
             
             
             
         }
         
        ?>
        
        <tr>
            
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-muted mb-0"> 
                            (<?= htmlspecialchars(number_format($resCandidates->num_rows)); ?>) candidates for this election
                        </p>
                        <p class="text-xs text-muted mb-0 text-center"> 
                        
                        <?php if($currentDate >= $endDateForElections): ?>
                            <button class="text-xs text-success mb-0" 
                                style="background: none; border: none; font-size: 18px; text-decoration: underline; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#viewCandidatesModal_<?= $row->id; ?>">
                                Election done , votings will nolonger be received
                            </button>
                            <?php else: ?>
                            <button class="text-xs text-muted mb-0" 
                                style="background: none; border: none; font-size: 18px; text-decoration: underline; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#viewCandidatesModal_<?= $row->id; ?>">
                                
                                
                                Vote now
                            </button>
                            
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </td>
            
            <td>
                <div class="d-flex px-2 py-1">
    <!-- Clickable Image -->
    <div>
        <img src="../images/election_banners/<?= htmlspecialchars($row->election_banner); ?>" 
             class="avatar avatar-sm me-3" 
             alt="candidate2" 
             data-bs-toggle="modal" 
             data-bs-target="#imageModal_<?= $row->id; ?>" 
             style="cursor: pointer;">
    </div>

    <!-- Candidate Info -->
    <div class="d-flex flex-column justify-content-center">
        <h6 class="mb-0 text-sm"><?= htmlspecialchars($row->election_name); ?></h6>
        <p class="text-xs text-muted mb-0">Candidate for <?= htmlspecialchars($row->election_name); ?> </p>
    </div>
</div>

<!-- Bootstrap Modal for Larger Image -->
<div class="modal fade" id="imageModal_<?= $row->id; ?>" tabindex="-1" aria-labelledby="imageModalLabel_<?= $row->id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="../images/election_banners/<?= htmlspecialchars($row->election_banner); ?>" 
                     class="img-fluid rounded" 
                     alt="Expanded Image">
            </div>
        </div>
    </div>
</div>

            </td>

<td>
           <span class="description"
      data-full="<?= htmlspecialchars($row->election_description); ?>"
      data-id="<?= $row->id; ?>"
      onclick="togglePopup(this)">
    <?= substr(htmlspecialchars($row->election_description), 0, 5); ?>...
</span>

<div id="desc-popup-<?= $row->id; ?>" class="profile-popup1 d-none">
    <button class="btn btn-danger btn-close float-end mb-2" style="background: green" aria-label="Close" onclick="closePopup(this)">Close</button>
    <div class="popup-content">
        <?= nl2br(htmlspecialchars($row->election_description)); ?>
    </div>
</div>



         </td>   
            

            <td><span class="text-xs font-weight-bold"><?= htmlspecialchars($row->start_date); ?></span></td>
            <td><span class="text-xs font-weight-bold"><?= htmlspecialchars($row->end_date); ?></span></td>
            
            
            <td>
                <span class="text-xs font-weight-bold text-success"><span id="timeLeft_<?= $row->id; ?>"></span></span>
                 
                 <br>
                 <?php if($currentDate >= $endDateForElections): ?>
                 
                  <button disabled class="btn btn-sm btn-success text-white">
                      Elections are being <br> reviewed you will get <br> notification once its completed
                      
                  </button>
                <?php endif; ?>
                </td>
            
            
            
            <td><span class="text-xs font-weight-bold"><?= htmlspecialchars($row->date_created); ?></span></td>

            
        </tr>
        
        
        

        <!-- Candidate Modal -->
        <div class="modal fade" id="viewCandidatesModal_<?= $row->id; ?>" tabindex="-1" aria-labelledby="viewCandidatesLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= htmlspecialchars($row->election_name); ?> - Candidates</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                       <?php while($candidate = $resCandidates->fetch_object()) { ?>
    <?php
    $electionID = filter_var($row->id, FILTER_SANITIZE_NUMBER_INT);
    $candidateID = filter_var($candidate->id, FILTER_SANITIZE_NUMBER_INT);
    $userID = filter_var($fetchStudent->id, FILTER_SANITIZE_NUMBER_INT);

    $sqlCountVotes = $mysqli->prepare("SELECT * FROM votes WHERE candidate_id = ? AND election_id = ?");
    $sqlCountVotes->bind_param("ii", $candidateID, $electionID);
    $sqlCountVotes->execute();
    $resCountVotes = $sqlCountVotes->get_result();

    $sqlCheckVote = $mysqli->prepare("SELECT * FROM votes WHERE election_id = ? AND user_id = ? AND status = 'VOTED'");
    $sqlCheckVote->bind_param("ii", $electionID, $userID);
    $sqlCheckVote->execute();
    $resCheckVote = $sqlCheckVote->get_result();
    $voteCheck = $resCheckVote->fetch_object();
    
    
    $sqlCheckVote1 = $mysqli->prepare("SELECT * FROM votes WHERE election_id = ? AND user_id = ? AND status = 'VOTED' AND candidate_id = ?");
    $sqlCheckVote1->bind_param("iii", $electionID, $userID,$candidateID);
    $sqlCheckVote1->execute();
    $resCheckVote1 = $sqlCheckVote1->get_result();
    $voteCheck1 = $resCheckVote1->fetch_object();
    
    
    
    
    
    ?>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border rounded p-3 d-flex flex-row align-items-center">
            <div class="text-left me-3">
                <h6 class="text-muted">Candidate</h6>
                <h5 class="fw-bold mb-1"><?= htmlspecialchars($candidate->candidate_name); ?></h5>
                <p class="text-xs text-muted">Votes: <strong><?= number_format($resCountVotes->num_rows); ?> votes</strong></p>
                
            <p class="text-xs text-muted" style="cursor: pointer;" 
   onclick="showPopup('popup<?= $candidate->id ?>')">
   Profile
</p>

<div id="backdrop<?= $candidate->id ?>" class="profile-popup-backdrop" onclick="hidePopup('popup<?= $candidate->id ?>')"></div>

<div id="popup<?= $candidate->id ?>" class="profile-popup">
    <h5><?= htmlspecialchars($candidate->candidate_name) ?></h5>
    <p><strong>Email:</strong> <?= htmlspecialchars($candidate->email) ?></p>
    <p><?= htmlspecialchars($candidate->candidate_bio) ?></p>
    <div class="text-end">
        <button class="btn btn-sm btn-outline-secondary" onclick="hidePopup('popup<?= $candidate->id ?>')">Close</button>
    </div>
</div>



               
               
            </div>
            <div class="d-flex flex-column align-items-center">
                <img src="../images/candidate_images/<?= htmlspecialchars($candidate->candidate_image); ?>" class="rounded-circle" width="80" height="80" alt="Candidate">
                
                <?php if($voteCheck1 === null): ?>
                
                 <?php if($currentDate <= $endDateForElections): ?>
                <button class="btn btn-primary btn-sm vote-btn" onclick="toggleVoteForm(<?= $candidate->id; ?>, <?= $electionID; ?>)" data-election-id="<?= $electionID; ?>" <?= ($voteCheck !== null) ? 'disabled' : ''; ?>>Vote</button>
                
                <?php else: ?>
                <button class="btn btn-primary btn-sm vote-btn" disabled>Vote</button>
                
                <?php endif; ?>
                
                <?php else: ?>
                <div>
                Voted <input type="checkbox" checked>
                </div>
                
                <div>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($voteCheck1->id); ?>">
                        
                        
                        <input type="hidden" name="candidate_name" value="<?= htmlspecialchars($candidate->candidate_name); ?>">
                        
                        <input type="hidden" name="candidate_role" value="<?= htmlspecialchars($candidate->candidate_role); ?>">
                        
                        <input type="hidden" name="email" value="<?= htmlspecialchars($fetchStudent->email); ?>">
                        
                        <?php if($currentDate >= $endDateForElections): ?>
                        <button disabled type="submit" name="cancel_vote" class="btn btn-danger btn-sm vote-btn">
                            Cancel your vote
                        </button>
                        <br>Vote has been submitted
                        <?php else: ?>
                        <button disabled type="submit" name="cancel_vote" class="btn btn-success text-white btn-sm vote-btn">
                            <small>
                                Your voted for this candidate
                            </small>
                            
                        </button>
                        <?php endif; ?>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div id="voteForm_<?= $candidate->id; ?>" class="vote-form d-none mt-3 text-center" data-election-id="<?= $electionID; ?>" data-voted="<?= ($voteCheck !== null) ? 'true' : 'false'; ?>">
            <?php if ($voteCheck === null): ?>
                <form method="POST">
                    <input type="hidden" name="userid" value="<?= htmlspecialchars($fetchStudent->id); ?>">
                    <input type="hidden" name="candidate_id" value="<?= $candidate->id; ?>">
                    <input type="hidden" name="candidate_name" value="<?= $candidate->candidate_name; ?>">
                    
                    <input type="hidden" name="candidate_role" value="<?= $candidate->candidate_role; ?>">
                    
                    <input type="hidden" name="email" value="<?= $fetchStudent->email; ?>">
                    
                    
                    <input type="hidden" name="election_id" value="<?= $electionID; ?>">
                    <p class="text-muted">Are you sure you want to vote for <?= htmlspecialchars($candidate->candidate_name); ?>?</p>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="vote_user" class="btn btn-success btn-sm mx-2">Yes</button>
                        <button type="button" class="btn btn-secondary btn-sm mx-2" onclick="toggleVoteForm(<?= $candidate->id; ?>)">Close</button>
                    </div>
                </form>
            <?php else: ?>
                <span class="text-success"><input type="checkbox" checked> You voted in this election</span>
            <?php endif; ?>
        </div>
    </div>
<?php } ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</tbody>



<script>
document.addEventListener("DOMContentLoaded", function () {
    let votedElections = new Set();
    document.querySelectorAll(".vote-form").forEach((form) => {
        let electionId = form.getAttribute("data-election-id");
        let isVoted = form.getAttribute("data-voted") === "true";
        if (isVoted) {
            votedElections.add(electionId);
            disableElectionVotes(electionId);
        }
    });
    function disableElectionVotes(electionId) {
        document.querySelectorAll(`[data-election-id="${electionId}"] button.vote-btn`).forEach((btn) => {
            btn.disabled = true;
        });
    }
    window.toggleVoteForm = function (candidateId, electionId) {
        let form = document.getElementById(`voteForm_${candidateId}`);
        if (votedElections.has(electionId)) {
            alert("You have already voted in this election!");
            return;
        }
        form.classList.toggle("d-none");
    };
    document.querySelectorAll("form.vote-form").forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            let electionId = form.getAttribute("data-election-id");
            votedElections.add(electionId);
            disableElectionVotes(electionId);
            alert("Vote submitted successfully!");
        });
    });
});
</script>
<script>
    // Function to toggle the visibility of the vote form
    function toggleVoteForm(candidateId) {
        // Get the specific vote form for the clicked candidate
        var voteForm = document.getElementById('voteForm_' + candidateId);
        
        // Check if the form is currently hidden
        var isHidden = voteForm.classList.contains('d-none');

        // Hide all forms first
        document.querySelectorAll('.vote-form').forEach(function(form) {
            form.classList.add('d-none');
        });

        // If the form was hidden before, show it; otherwise, leave it hidden
        if (isHidden) {
            voteForm.classList.remove('d-none'); // Show the form
        }
    }

    // Function to close only the currently open vote form
    function closeVoteForm(candidateId) {
        var voteForm = document.getElementById('voteForm_' + candidateId);
        voteForm.classList.add('d-none'); // Hide only this form
    }
</script>




    
    <script>
    function updateCountdown(id, endDate) {
        function calculateTimeLeft() {
            const now = new Date();
            const timeLeft = new Date(endDate) - now;

            if (timeLeft <= 0) {
                document.getElementById(id).innerHTML = "Election period is over";
                clearInterval(interval); // Stop updating when time is up
                return;
            }

            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.getElementById(id).innerHTML = `${days} Days, ${hours} Hours, ${minutes} Minutes, ${seconds} Seconds`;
        }

        const interval = setInterval(calculateTimeLeft, 1000);
        calculateTimeLeft(); // Initial call to avoid delay
    }

    <?php
    // Reset elections result set and loop again for JS initialization
    $elections->data_seek(0);
    while ($row = $elections->fetch_object()):
    ?>
        updateCountdown("timeLeft_<?= $row->id; ?>", "<?= htmlspecialchars($row->end_date); ?>");
    <?php endwhile; ?>
</script>







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
   document.addEventListener("DOMContentLoaded", function () {
    const descriptions = document.querySelectorAll(".description");
    const popup = document.getElementById("popupContainer");
    const popupContent = document.getElementById("popupContent");

    descriptions.forEach(desc => {
        desc.addEventListener("click", function (event) {
            popupContent.innerHTML = event.target.dataset.full; // Show full text
            popup.classList.add("active");
        });
    });

    // Close popup when clicking outside
    document.addEventListener("click", function (event) {
        if (!popup.contains(event.target) && !event.target.classList.contains("description")) {
            popup.classList.remove("active");
        }
    });

    // Prevent closing when clicking inside popup
    popup.addEventListener("click", function (event) {
        event.stopPropagation();
    });
});

</script>

<style>
  /* Add smooth transition for the collapsible sections */
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

.popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    z-index: 10000;
    max-width: 50%;
    max-height: 60vh;
    overflow-y: auto;
    text-align: center;
    font-size: 16px;
    display: none;
    border: 1px solid #ccc;
}
.popup.active {
    display: block;
}


</style>



<script>
function showPopup(id) {
    const popup = document.getElementById(id);
    const backdrop = document.getElementById('backdrop' + id.replace('popup', ''));
    popup.style.display = 'block';
    backdrop.style.display = 'block';
}

function hidePopup(id) {
    const popup = document.getElementById(id);
    const backdrop = document.getElementById('backdrop' + id.replace('popup', ''));
    popup.style.display = 'none';
    backdrop.style.display = 'none';
}
</script>

<style>
.profile-popup {
    width: 350px;
    max-width: 90%;
    padding: 1rem;
    background-color: #fff;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1050;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-radius: 10px;
    display: none;
    border: 1px solid #ddd;
}
.profile-popup-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.3);
    z-index: 1049;
    display: none;
}

/* Backdrop overlay */
.popup-backdrop1 {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.4); /* dark semi-transparent */
    z-index: 1049; /* just behind the popup */
    display: none;
}

/* The popup content */
.profile-popup1 {
    max-width: 90%;
    width: 300px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1050;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    padding: 15px;
    border-radius: 10px;
    word-wrap: break-word;
    white-space: pre-wrap;
}


</style>

<script>
function togglePopup(el) {
    const id = el.dataset.id;
    const popup = document.getElementById('desc-popup-' + id);
    const backdrop = document.getElementById('popupBackdrop');

    // Hide all popups first
    document.querySelectorAll('.profile-popup1').forEach(p => p.classList.add('d-none'));

    // Show the selected popup
    popup.classList.remove('d-none');
    backdrop.style.display = 'block';

    // Close popup when clicking outside
    function handleClickOutside(e) {
        if (!popup.contains(e.target) && !el.contains(e.target)) {
            popup.classList.add('d-none');
            backdrop.style.display = 'none';
            document.removeEventListener('mousedown', handleClickOutside);
        }
    }

    // Attach listener
    setTimeout(() => {
        document.addEventListener('mousedown', handleClickOutside);
    }, 0);
}

// Close popup manually with button
function closePopup(buttonEl) {
    const popup = buttonEl.closest('.profile-popup1');
    popup.classList.add('d-none');

    const backdrop = document.getElementById('popupBackdrop');
    if (backdrop) {
        backdrop.style.display = 'none';
    }
}
</script>


