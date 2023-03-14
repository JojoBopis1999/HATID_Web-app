<?php
    session_start();
    $tabName = "About";
    include 'assets/includes/header.php';
    include 'admin/assets/includes/alert_success.php';
    include 'admin/assets/includes/alert_failed.php';
?>

    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <img src="attachments/about_us.png" alt="Contact LOGO">
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card mt-3" style="width: fit-content;">
                    <img src="./attachments/hatid-high-resolution-logo-black-on-white-background.png" class="card-img-bottom" alt="Hatid LOGO">
                    <div class="card-body"> 
                        <p class="card-text">
                            HATID or Handy Aviation Transportation Display is a web-app based application developed by students 
                            from Philippine State College of Aeronautics. The primary goal of the students is to build 
                            a system that can allow daily commuters of Pasay city, particularly those commuters who has 
                            business at airports, such as passengers or employees or regular daily commuter. 
                        </p>
                        <p>
                            The HATID web-app system will allow our daily commuters to monitor the schedule of the shuttle b
                            us's location, reduce the amount of 
                            waiting time and prevent the possibility of looking for alternative options for transportation
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">The Team</h5>
                        <p class="card-text">
                            We are the developers from the Philippine State College of Aeronautics who created
                            HATID Web-App. A shuttle bus system for HM Transport Inc.
                        </p>
                        <p class="card-text">
                            The pandemic had a huge effect on how the Philippines' transportation system operated.
                            The capacity of public transit was reduced to at least 75% of its capacity in order to 
                            stop the virus spreading. Due to this, the average amount of time that daily commuters 
                            spend traveling each day worsens.
                        </p>
                        <p class="card-text">
                            Using HATID allows the daily commuter that was going to NAIA Terminal 3 to see the schedule 
                            and whereabouts of the bus.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="row pt-4">
                    <div class="col-sm-3">
                        <img src="./attachments/steaven.png" class="card-img-top rounded-pill mb-1" alt="John Steaven Brixz Bueno">
                        <div class="card mb-3">
                            <div class="card-body text-center fw-semibold">
                                John Steaven Brixz Bueno
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <img src="./attachments/jones.jpg" class="card-img-top rounded-pill mb-1" alt="Jones Greg Castañeros">
                        <div class="card mb-3">
                            <div class="card-body text-center fw-semibold">
                                Jones Greg Castañeros
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <img src="./attachments/janice.jpg" class="card-img-top rounded-pill mb-1" alt="Janice Dela Vega">
                        <div class="card mb-3">
                            <div class="card-body text-center fw-semibold">
                                Janice
                                </br> 
                                Dela Vega
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <img src="./attachments/nelson.jpg" class="card-img-top rounded-pill mb-1" alt="Nelson Yu">
                        <div class="card mb-3">
                            <div class="card-body text-center fw-semibold">
                                Nelson <br> Yu
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php   
    include 'assets/includes/footer.php';
?>