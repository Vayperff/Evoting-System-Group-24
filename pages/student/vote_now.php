<?php
include_once("php/elections.php");
include_once("php/vote.php");




?>

<?php include_once("navbar.php"); ?>



   <div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>Elections <span class="text-sm"><i class="fa fa-check text-info"></i> (<?= htmlspecialchars(number_format($elections->num_rows)); ?>) in the running</span></h6>
                <div class="dropdown">
                    <a class="cursor-pointer" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-v text-secondary"></i></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php while ($row = $elections->fetch_object()) { 
                        $sqlCandidateId = filter_var($row->id, FILTER_SANITIZE_NUMBER_INT);
                        $sqlCandidates = $mysqli->prepare("SELECT * FROM candidates WHERE election_id = ? AND deleted != 'DELETED'");
                        $sqlCandidates->bind_param("i", $sqlCandidateId);
                        $sqlCandidates->execute();
                        $resCandidates = $sqlCandidates->get_result();
                    ?>
                        <div class="col-md-4">
                            <div class="card shadow-sm text-center p-3">
                                <img src="../images/election_banners/<?= htmlspecialchars($row->election_banner); ?>" 
                                     class="img-fluid rounded election-img mb-2" alt="Election Banner"
                                     data-bs-toggle="modal" data-bs-target="#imageModal_<?= $row->id; ?>">
                                <h6><?= htmlspecialchars($row->election_name); ?></h6>
                                <p class="text-muted"><?= substr(htmlspecialchars($row->election_description), 0, 60); ?>...</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <span class="badge bg-success"><?= htmlspecialchars($row->start_date); ?></span>
                                    <span class="badge bg-danger"><?= htmlspecialchars($row->end_date); ?></span>
                                </div>
                                <p class="text-muted mt-2">(<?= htmlspecialchars(number_format($resCandidates->num_rows)); ?>) candidates</p>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewCandidatesModal_<?= $row->id; ?>">View Candidates</button>
                            </div>
                        </div>

                        <div class="modal fade" id="imageModal_<?= $row->id; ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <img src="../images/election_banners/<?= htmlspecialchars($row->election_banner); ?>" class="img-fluid rounded">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="viewCandidatesModal_<?= $row->id; ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= htmlspecialchars($row->election_name); ?> - Candidates</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <?php while($candidate = $resCandidates->fetch_object()) { 
                                                $candidateID = filter_var($candidate->id, FILTER_SANITIZE_NUMBER_INT);
                                                $userID = filter_var($fetchStudent->id, FILTER_SANITIZE_NUMBER_INT);

                                                $sqlCountVotes = $mysqli->prepare("SELECT * FROM votes WHERE candidate_id = ? AND election_id = ?");
                                                $sqlCountVotes->bind_param("ii", $candidateID, $sqlCandidateId);
                                                $sqlCountVotes->execute();
                                                $resCountVotes = $sqlCountVotes->get_result();

                                                $sqlCheckVote = $mysqli->prepare("SELECT * FROM votes WHERE election_id = ? AND user_id = ? AND status = 'VOTED'");
                                                $sqlCheckVote->bind_param("ii", $sqlCandidateId, $userID);
                                                $sqlCheckVote->execute();
                                                $resCheckVote = $sqlCheckVote->get_result();

                                                $sqlCheckVote1 = $mysqli->prepare("SELECT * FROM votes WHERE election_id = ? AND user_id = ? AND status = 'VOTED' AND candidate_id = ?");
                                                $sqlCheckVote1->bind_param("iii", $sqlCandidateId, $userID, $candidateID);
                                                $sqlCheckVote1->execute();
                                                $resCheckVote1 = $sqlCheckVote1->get_result();
                                            ?>
                                                <div class="col-md-4">
                                                    <div class="card p-3 text-center">
                                                        <img src="../images/candidate_images/<?= htmlspecialchars($candidate->candidate_image); ?>" 
                                                             class="rounded-circle mb-2" width="80" height="80">
                                                        <h6><?= htmlspecialchars($candidate->candidate_name); ?></h6>
                                                        <p class="text-muted">Votes: <strong><?= number_format($resCountVotes->num_rows); ?></strong></p>
                                                        
                                                        <?php if(!$resCheckVote): ?>
                                                            <button class="btn btn-primary btn-sm" onclick="toggleVoteForm(<?= $candidate->id; ?>, <?= $sqlCandidateId; ?>)" 
                                                                    <?= ($resCheckVote->num_rows > 0) ? 'disabled' : ''; ?>>
                                                                Vote
                                                            </button>
                                                        <?php else: ?>
                                                            <div>Voted <input type="checkbox" checked></div>
                                                            <form method="post">
                                                                <input type="hidden" name="id" value="<?= htmlspecialchars($resCheckVote1->fetch_object()->id); ?>">
                                                                <input type="hidden" name="candidate_name" value="<?= htmlspecialchars($candidate->candidate_name); ?>">
                                                                <input type="hidden" name="candidate_role" value="<?= htmlspecialchars($candidate->candidate_role); ?>">
                                                                <input type="hidden" name="email" value="<?= htmlspecialchars($fetchStudent->email); ?>">
                                                                <button type="submit" name="cancel_vote" class="btn btn-danger btn-sm">Cancel Vote</button>
                                                            </form>
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
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .election-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .election-img:hover {
        transform: scale(1.05);
    }
</style>



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



<!-- Pop-up Structure -->
<div id="popupContainer" class="popup">
    <div id="popupContent"></div>
</div>

    
    <script>
    function updateCountdown(id, endDate) {
        function calculateTimeLeft() {
            const now = new Date();
            const timeLeft = new Date(endDate) - now;

            if (timeLeft <= 0) {
                document.getElementById(id).innerHTML = "Time is up!";
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