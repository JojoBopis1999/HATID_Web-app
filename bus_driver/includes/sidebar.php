    <!--Nav Bar-->
    <div class="d-flex bg-dark flex-fill justify-content-between">
        <p id="timeDate" class="lead text-light pt-3 ps-3">Time</p>
        <div class="btn-group">
            <button type="button" class="btn rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person" style="color:white; font-size: 2rem;"></i>
            </button>
            
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../bus_driver/menu.php"><i class="bi bi-menu-button-wide"></i>  Menu</a></li>
                <li><a class="dropdown-item" href="../bus_driver/incident_report.php"><i class="bi bi-exclamation-triangle"></i>  Report an incident</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="modal" data-bs-toggle="modal" data-bs-target="#logout_modal"><i class="bi bi-box-arrow-right"></i>  Sign Out</a></li>
            </ul>
        </div>
    </div>  

    <!--logout Modal -->
    <div class="modal fade" id="logout_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Out</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Sign out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form action="../system/database/db_employee_signin.php" method="post">
                    <button type="submit" name="signout_employee" class="btn btn-primary">Yes</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script>
        //for time and date display
        function display_ct() {
        var x = new Date()
        var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
        hours = x.getHours( ) % 12;
        hours = hours ? hours : 12;
        var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
        x1 = x1 + " - " +  hours + ":" +  x.getMinutes() + ":" +  x.getSeconds() + " " + ampm;
        document.getElementById('timeDate').innerHTML = x1;
        display_c6();
        }

        function display_c6(){
        var refresh=1000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct()',refresh)
        }
        display_c6()
    </script>