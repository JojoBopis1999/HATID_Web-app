<div class="d-flex mb-3">
    <div class="d-flex flex-fill justify-content-between bg-dark">
        <button class="btn btn-dark rounded-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <i class="bi bi-list" style="color:white; font-size:2rem;"></i></button>
        <h3 class="text-light pt-3 pe-3 fw-bold"><?php print $tabLocation; ?></h3>
    </div>
</div>

<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Administrator</h5>
    <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div> 
  <div class="offcanvas-body">
        <div class="d-flex justify-content-center">
          <img src="../attachments/hatid-low-resolution-logo-white-on-transparent-background.png" width="250rem" height="50rem" alt="bus">
        </div>
        
        <ul class="navbar-nav d-flex flex-column p-3 mt-3 w-100">
            <li class="nav-item w-100">
                <a href="../admin/dashboard.php" class="nav-link bg-dark text-light fw-bold pl-4">
                    <i class="bi bi-speedometer2 pe-3"></i>Dashboard</a>
            </li>

            <li class="nav-item w-100">
              <a href="../admin/routes.php" class="nav-link bg-dark text-light fw-bold pl-4">
              <i class="bi bi-sign-turn-right pe-3"></i>Routes</a>
            </li>

            <li class="nav-item w-100">
              <a href="../admin/bus_stops.php" class="nav-link bg-dark text-light fw-bold pl-4">
              <i class="bi bi-sign-stop pe-3"></i>Stops</a>
            </li>

            <li class="nav-item w-100">
                <a href="../admin/bus.php" class="nav-link bg-dark text-light fw-bold pl-4">
                <i class="bi bi-truck-front pe-3"></i>Bus</a>
            </li>

            <li class="nav-item w-100">
                <a href="../admin/employees.php" class="nav-link bg-dark text-light fw-bold pl-4">
                <i class="bi bi-person pe-3"></i>Employees</a>
            </li>

            <li class="nav-item w-100">
                <a href="../admin/passengers_feedback.php" class="nav-link bg-dark text-light fw-bold pl-4">
                <i class="bi bi-envelope-open pe-3"></i>Passenger's Feedback</a>
            </li>

            <li class="nav-item w-100">
                <a href="../admin/sender_advisory.php" class="nav-link bg-dark text-light fw-bold pl-4">
                <i class="bi bi-megaphone pe-3"></i>Advisory Sender</a>
            </li>

            <li class="nav-item w-100">
                <a href="../admin/website_information.php" class="nav-link bg-dark text-light fw-bold pl-4">
                <i class="bi bi-megaphone pe-3"></i>Website Information Settings</a>
            </li>

            <li>
              <a class="nav-link bg-dark text-light fw-bold pl-4" data-bs-toggle="collapse" href="#log_collapse" role="button" aria-expanded="false" aria-controls="log_collapse">
              <i class="bi bi-book pe-3"></i>Logs</a>

              <div class="collapse" id="log_collapse">
                <div class="card card-body bg-dark border border-dark">
                  <ul>
                    <li class="nav-item w-100">
                      <a href="../admin/audit_logs.php" class="nav-link bg-dark text-light fw-bold pl-4">
                      <i class="bi bi-book pe-3"></i>Audit Logs</a>
                    </li>

                    <li class="nav-item w-100">
                      <a href="../admin/journey_logs.php" class="nav-link bg-dark text-light fw-bold pl-4">
                      <i class="bi bi-book pe-3"></i>Journey Logs</a>
                    </li>

                    <li class="nav-item w-100">
                      <a href="../admin/incident_logs.php" class="nav-link bg-dark text-light fw-bold pl-4">
                      <i class="bi bi-book pe-3"></i>Incident Logs</a>
                    </li>
                  </ul>
                </div>
              </div>

            </li>

            <li class="nav-item w-100">
                <a href="modal" class="nav-link  bg-dark text-danger fw-bold pl-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-box-arrow-right text-danger pe-3"></i>Log Out</a>
            </li>
        </ul>
  </div>
</div>

<!--Log out modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Log Out</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to log out?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form action="../system/database/db_admin_siginin.php" method="post">
            <button type="submit" name="signout_admin" class="btn btn-primary">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>