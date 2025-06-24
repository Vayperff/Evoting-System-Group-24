<?php
include_once("php/complete_elections.php");

include_once("php/elections.php");


?>

<?php include_once("navbar.php"); ?>



    <div class="container-fluid py-2" style="overflow: hidden;">
    <div class="row">
  <!-- Dashboard Header -->
  <div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Voting Dashboard</h3>
    <p class="mb-4">Overview of election statistics and voting progress</p>
  </div>

  <!-- Total Registered Voters -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
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
      <span class="font-weight-bold ms-1"><?= number_format($elections->num_rows); ?> elections </span> currently active
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
          View votes
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
        $sqlElectionId = filter_var($row->id, FILTER_SANITIZE_NUMBER_INT);
        $sqlCandidates = $mysqli->prepare("SELECT * FROM candidates WHERE election_id = ? AND deleted != 'DELETED'");
        $sqlCandidates->bind_param("i", $sqlElectionId);
        $sqlCandidates->execute();
        $resCandidates = $sqlCandidates->get_result();
        
        $sqlvotes = $mysqli->prepare("SELECT * FROM votes WHERE voting_status = '0' AND election_id = ?");
        $sqlvotes->bind_param("i",$sqlElectionId);
        $sqlvotes->execute();
        $resvotes = $sqlvotes->get_result();
        $votesInSystem = $resvotes->fetch_object();
        
       
        
        
        
        $currentDate = date("Y-m-d");
        
        //echo $currentDate;
        
        $endDateForElections = $row->end_date;
         
         //echo $row->end_date;
         
         if($currentDate >= $endDateForElections) {
             
             /* //check for voting done
        $sqlvotes1 = $mysqli->prepare("SELECT * FROM votes WHERE voting_status = '1' AND election_id = ?");
        $sqlvotes1->bind_param("i",$sqlElectionId);
        $sqlvotes1->execute();
        $resvotes1 = $sqlvotes1->get_result();
        $votesInSystem1 = $resvotes1->fetch_object();
        
        
        $candidateFromVoted = $votesInSystem1->candidate_id;
        
        $sqlCandidates1 = $mysqli->prepare("SELECT * FROM candidates WHERE id = ? AND deleted != 'DELETED'");
        $sqlCandidates1->bind_param("i", $candidateFromVoted);
        $sqlCandidates1->execute();
        $resCandidates1 = $sqlCandidates1->get_result();
        $emailForCandidate = $resCandidates1->fetch_object();
        $emailForCandidate1 = $emailForCandidate->email;
             */
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
                        <?php  if($currentDate === $endDateForElections): ?>
                            <button class="text-xs text-success  mb-0" 
                                style="background: none; border: none; font-size: 18px; text-decoration: underline; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#viewCandidatesModal_<?= $row->id; ?>">
                                View (<?= number_format($resvotes->num_rows); ?>)   Final vote count for this election
                            </button>
                            <?php else: ?>
                            <button class="text-xs text-muted mb-0" 
                                style="background: none; border: none; font-size: 18px; text-decoration: underline; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#viewCandidatesModal_<?= $row->id; ?>">
                                 (<?= number_format($resvotes->num_rows); ?>) 
                                 
                                
                                 
                                 Total
                                votes for this election
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
        <img src="images/election_banners/<?= htmlspecialchars($row->election_banner); ?>" 
             class="avatar avatar-sm me-3" 
             alt="candidate2" 
             data-bs-toggle="modal" 
             data-bs-target="#imageModal_<?= $row->id; ?>" 
             style="cursor: pointer;">
    </div>

    <!-- Candidate Info -->
    <div class="d-flex flex-column justify-content-center">
        <h6 class="mb-0 text-sm"><?= htmlspecialchars($row->election_name); ?></h6>
        <p class="text-xs text-muted mb-0">Candidate for <?= htmlspecialchars($row->election_name); ?></p>
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
                <span class="description" data-full="<?= htmlspecialchars($row->election_description); ?>">
                    <?= substr(htmlspecialchars($row->election_description), 0, 5); ?>...
                </span>
            </td>

            <td><span class="text-xs font-weight-bold"><?= htmlspecialchars($row->start_date); ?></span></td>
            <td><span class="text-xs font-weight-bold"><?= htmlspecialchars($row->end_date); ?></span></td>
            
            
            <td>
                <span class="text-xs font-weight-bold text-success"><span id="timeLeft_<?= $row->id; ?>"></span></span>

 <?php if($row->is_ended == null): ?>
                 <form method="post">
                    <input type="hidden" name="id" value="<?= filter_var($row->id, FILTER_SANITIZE_NUMBER_INT); ?>">
                   
                    <button class="btn btn-sm btn-success" type="submit" name="terminate_election">
                        End election
                    </button>
                </form>
<?php endif; ?>

                
                <?php if($currentDate >= $endDateForElections): ?>
              <?php if ($currentDate >= $endDateForElections): ?>
    <?php
    // Step 1: Get the maximum vote count for this election
    $sqlMaxVotes = $mysqli->prepare("
        SELECT COUNT(*) as vote_count 
        FROM votes 
        WHERE election_id = ? AND voting_status = 0 
        GROUP BY candidate_id 
        ORDER BY vote_count DESC 
        LIMIT 1
    ");
    $sqlMaxVotes->bind_param("i", $sqlElectionId);
    $sqlMaxVotes->execute();
    $resMaxVotes = $sqlMaxVotes->get_result();
    $maxVote = $resMaxVotes->fetch_object();

    if ($maxVote) {
        $highestVotes = $maxVote->vote_count;

        // Step 2: Get all candidates with the highest vote count
        $sqlWinners = $mysqli->prepare("
            SELECT DISTINCT candidate_id 
            FROM votes 
            WHERE election_id = ? AND voting_status = 0 
            GROUP BY candidate_id 
            HAVING COUNT(*) = ?
        ");
        $sqlWinners->bind_param("ii", $sqlElectionId, $highestVotes);
        $sqlWinners->execute();
        $resWinners = $sqlWinners->get_result();

        $winnerCount = $resWinners->num_rows;
    ?>

        <?php if ($winnerCount == 1): ?>
            <?php
            // Step 3A: If only one winner, fetch their name & role
            $winner = $resWinners->fetch_object();
            $winnerId = $winner->candidate_id;

            $sqlGetCandidate = $mysqli->prepare("SELECT candidate_name, candidate_role FROM candidates WHERE id = ?");
            $sqlGetCandidate->bind_param("i", $winnerId);
            $sqlGetCandidate->execute();
            $resCandidate = $sqlGetCandidate->get_result();
            $candidate = $resCandidate->fetch_object();
            ?>

            <?php if ($candidate): ?>
                <p class="text-xs font-weight-bold text-success">
                    The candidate with <br> the highest votes <br> for the role of <br> 
                    <strong><?= htmlspecialchars($candidate->candidate_role); ?></strong> is 
                    <strong><?= htmlspecialchars($candidate->candidate_name); ?></strong>.
                </p>

                <button class="text-xs text-success mb-0" 
                        style="background: none; border: none; font-size: 18px; text-decoration: underline; cursor: pointer;"
                        data-bs-toggle="modal" data-bs-target="#viewCandidatesModal_<?= htmlspecialchars($row->id); ?>">
                    View
                </button>

                <form method="post">
                    <input type="hidden" name="id" value="<?= filter_var($row->id, FILTER_SANITIZE_NUMBER_INT); ?>">
                    <input type="hidden" name="results" value="<?= htmlspecialchars($candidate->candidate_name); ?>">
                    <button class="btn btn-sm btn-success" type="submit" name="complete_elections">
                        Complete elections
                    </button>
                </form>
            <?php endif; ?>

        <?php else: ?>
            <p class="text-xs font-weight-bold text-danger">There is a tie between the following candidates:</p>
            <ul class="text-danger">
                <?php
                $tieCandidates = [];
                while ($winner = $resWinners->fetch_object()) {
                    $winnerId = $winner->candidate_id;

                    $sqlGetCandidate = $mysqli->prepare("SELECT candidate_name, candidate_role FROM candidates WHERE id = ?");
                    $sqlGetCandidate->bind_param("i", $winnerId);
                    $sqlGetCandidate->execute();
                    $resCandidate = $sqlGetCandidate->get_result();
                    $candidate = $resCandidate->fetch_object();

                    if ($candidate) {
                        echo '<li>' . htmlspecialchars($candidate->candidate_name) . ' (' . htmlspecialchars($candidate->candidate_role) . ')</li>';
                        $tieCandidates[] = htmlspecialchars($candidate->candidate_name);
                    }
                }
                ?>
            </ul>
            <p class="text-xs font-weight-bold text-danger">Please resolve the tie manually.</p>
            
            <form method="post">
                <input type="hidden" name="id" value="<?= $row->id; ?>">
                <div class="form-group">
                <label class="text-danger">Current end date</label>
                <input type="date" name="date_add" class="form-control" style="border: 1px solid red; width: 100px;" value="<?= htmlspecialchars($row->end_date); ?>">
                <input type="hidden" name="election_name" value="<?= htmlspecialchars($row->election_name); ?>">
                
                
                </div>
                <br>
                 <button class="btn btn-sm btn-danger" type="submit" name="extend_date">
                    Extend date
                </button>
                
                
            </form>
            <!--
            <form method="post">
                <input type="hidden" name="id" value="<?= filter_var($row->id, FILTER_SANITIZE_NUMBER_INT); ?>">
                <input type="hidden" name="results" value="Tie between: <?= implode(', ', $tieCandidates); ?>">
                <button class="btn btn-sm btn-danger" type="submit" name="complete_elections">
                    Complete elections
                </button>
            </form>
            -->
            
            
            
            
        <?php endif; ?>

    <?php } ?>
<?php endif; ?>

                
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
    if($votesInSystem) {
    $userID = filter_var($votesInSystem->user_id, FILTER_SANITIZE_NUMBER_INT);
    }
    else {
        $userID = "";
    }

    $sqlCountVotes = $mysqli->prepare("SELECT * FROM votes WHERE candidate_id = ? AND election_id = ? AND voting_status = 0");
    $sqlCountVotes->bind_param("ii", $candidateID, $electionID);
    $sqlCountVotes->execute();
    $resCountVotes = $sqlCountVotes->get_result();

    $sqlCheckVote = $mysqli->prepare("SELECT * FROM votes WHERE election_id = ? AND user_id = ? AND status = 'VOTED' AND voting_status = 0");
    $sqlCheckVote->bind_param("ii", $electionID, $userID);
    $sqlCheckVote->execute();
    $resCheckVote = $sqlCheckVote->get_result();
    $voteCheck = $resCheckVote->fetch_object();
    
    
    $sqlCheckVote1 = $mysqli->prepare("SELECT * FROM votes WHERE election_id = ? AND user_id = ? AND status = 'VOTED' AND candidate_id = ? AND voting_status = 0");
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
            </div>
            <div class="d-flex flex-column align-items-center">
                <img src="images/candidate_images/<?= htmlspecialchars($candidate->candidate_image); ?>" class="rounded-circle" width="80" height="80" alt="Candidate">
                
                <?php if($resCountVotes->num_rows > 0): ?>
                
                <form method="get" action="view_voters.php">
                    <input type="hidden" name="candidate_id" value="<?=  filter_var($candidateID,FILTER_SANITIZE_NUMBER_INT); ?>">
                    
               <button type="submit" name="view_voters1" class="btn btn-success btn-sm vote-btn"
               >
                   View <?= number_format($resCountVotes->num_rows); ?> voters
               </button>
               </form>
               
               <?php else: ?>
               <form method="get" action="view_voters.php">
                    <input type="hidden" name="candidate_id" value="<?=  filter_var($candidateID,FILTER_SANITIZE_NUMBER_INT); ?>">
                    
               <button type="submit" name="view_voters1" class="btn btn-info btn-sm vote-btn"
               >
                   View <?= number_format($resCountVotes->num_rows); ?> voters
               </button>
               </form>
              <?php endif; ?>
               
            </div>
        </div>
        <div id="voteForm_<?= $candidate->id; ?>" class="vote-form d-none mt-3 text-center" data-election-id="<?= $electionID; ?>" data-voted="<?= ($voteCheck !== null) ? 'true' : 'false'; ?>">
            <?php if ($voteCheck === null): ?>
                <form method="POST">
                    <!--
                    <input type="hidden" name="userid" value="<?= htmlspecialchars($fetchStudent->id); ?>">
                    -->
                    <input type="hidden" name="candidate_id" value="<?= $candidate->id; ?>">
                    <input type="hidden" name="candidate_name" value="<?= $candidate->candidate_name; ?>">
                    
                    <input type="hidden" name="candidate_role" value="<?= $candidate->candidate_role; ?>">
                    
                    <!--
                    <input type="hidden" name="email" value="<?= $fetchStudent->email; ?>">
                    
                    -->
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
                document.getElementById(id).innerHTML = " <span style='text-decoration: underline'>Election period done </span>";
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