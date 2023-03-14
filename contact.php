<?php
    session_start();
    $tabName = "Contacts";
    include 'assets/includes/header.php';
    include 'admin/assets/includes/alert_success.php';
    include 'admin/assets/includes/alert_failed.php';
?>
    
    <div class="container my-2">
        <div class="d-flex justify-content-center my-2">
            <img src="attachments/CONTACT.png" alt="Contact LOGO">
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body d-flex-justify-content-center">
                        <p class="h3 fw-semibold card-text text-center">Questions not answered yet? We are here to help!</p>
                        <div class="row g-0 my-3 d-flex justify-content-center">
                            <div class="card m-2" style="width: 18rem;">
                                <div class="card-body">
                                <?php
                                    include_once 'system/database/dbcon.php';
                                    $address = $database->getReference('website_info/address')->getValue();
                                    if($address > 0){
                                ?>
                                    <p class="card-title fw-semibold text-center">ADDRESS</p>
                                    <p class="card-text text-center"><?php echo implode($address); }?></p>
                                </div>
                            </div>  

                            <div class="card m-2" style="width: 18rem;">
                                <div class="card-body">
                                    <?php
                                        $contact = $database->getReference('website_info/contact')->getValue();
                                        if($contact > 0){
                                    ?>
                                    <p class="card-title fw-semibold text-center">PHONE NUMBER</p>
                                    <p class="card-text text-center"><?php echo implode($contact); } ?></p>
                                </div>
                            </div>

                            <div class="card m-2" style="width: 18rem;">
                                <div class="card-body">
                                    <?php
                                        $email = $database->getReference('website_info/email')->getValue();
                                        if($email > 0){
                                    ?>
                                    <p class="card-title fw-semibold text-center">EMAIL</p>
                                    <p class="card-text text-center"><?php echo implode($email); } ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">      
                            <div class="col-md-4">

                            </div>              
                            <div class="col-md-4">
                                <div class="card rounded-0">
                                    <div class="card-header text-center">
                                        Send us a Feedback!
                                    </div>

                                    <div class="card-body">
                                        <p class="lead text-dark text-center">
                                            Got a question? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
                                        </p>
                                        <form action="system/database/db_feedback.php" method="post">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" required>
                                            </div>

                                            <div class="mb-3">
                                                <select class="form-select" aria-label="Default select example" name="subject" required>
                                                    <option selected value="selected">Subject</option>
                                                    <option value="Opinions & Request">Opinions & Request</option>
                                                    <option value="Lost & Found">Lost & Found</option>
                                                    <option value="Violation Reports">Violation Reports</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                                                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                            </div>

                                            <button type="submit" name="send_feedback" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
<?php   
    include 'assets/includes/footer.php';
?>