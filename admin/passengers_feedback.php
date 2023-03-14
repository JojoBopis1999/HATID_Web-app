<?php 
    include '../system/database/db_authentication_token.php';
    //session_start();
    $uid = $_SESSION['verified_admin_uid'];
    $idTokenString = $_SESSION['idTokenString'];
    if(!isset($uid) && !isset($idTokenString)){
        $_SESSION['failed'] = "UNAUTHORIZED ACCESS!!";
        header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
        exit();
    }else{
    $tabName = "Passenger Feedback";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';?>

    <div class="container">
        <div class="row">
            <div class="col-3 bg-dark">
                <div class="chats mt-3">
                    <?php
                        include '../system/database/dbcon.php';

                        $ref_table = "feedbacks";
                        $fetch_data = $database->getReference($ref_table)->getValue();
                        if($fetch_data > 0){
                            foreach($fetch_data as $key => $row){  
                    ?>
                        <div class="list-group">
                            <button type="button" class="anon_btn btn btn-dark rounded-0" value="<?= $key ?>"><?= $key ?></button>
                        </div>
                    <?php
                    }
                        }else{
                        ?>
                            <p class="lead text-center mt-5">There are no feedbacks right now.</p>
                        <?php
                            }
                        ?>
                </div>
            </div>

            <!---This is where the messages will appear-->
            <div class="col-9">
                <div class="custom">
                    <div class="card bg-dark rounded-0" style="height: 100%;">
                            <div class="card-header">
                                <h5 class="feedback-id pt-2 fw-semibold text-light">Feedback ID</h5>
                            </div>
                        <div class="card-body">
                            <h5 class="sender-name card-title text-light">Email Address</h5>
                            <h4 class="fw-semibold subject-id text-light"></h4>
                            <p class="message_content card-text text-light">Message</p>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module" >
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-app.js";
        //import { getAnalytics } from "firebase/analytics";
        import { getDatabase, ref, set, child, get } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-database.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
        apiKey: "AIzaSyCZn7iSrDouKS62irDMIv-dejaajbtM91k",
        authDomain: "bustransitsystem-241e3.firebaseapp.com",
        databaseURL: "https://bustransitsystem-241e3-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "bustransitsystem-241e3",
        storageBucket: "bustransitsystem-241e3.appspot.com",
        messagingSenderId: "541686084789",
        appId: "1:541686084789:web:3007df26be8fb513bf7afc",
        measurementId: "G-RL6GDDJEWM"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        //const analytics = getAnalytics(app);
        const db = getDatabase();

        //html elements that contents will be display
        var feedback_id = document.querySelector(".feedback-id");
        var sender_name = document.querySelector(".sender-name");
        var message_content = document.querySelector(".message_content");
        var subject_h3 = document.querySelector('.subject-id');
        
        var buttons = document.querySelectorAll(".anon_btn");
            buttons.forEach(function(button){
            button.addEventListener("click", function(){
                var buttonValue = this.value;
                var dbref = ref(db);
                var feedback_message = [];
                get(child(dbref, "feedbacks/" + buttonValue))
                .then((snapshot)=>{
                    snapshot.forEach(childSnapshot =>{
                        feedback_message.push(childSnapshot.val());
                    });
                    var email = feedback_message[0];
                    var message = feedback_message[1];
                    var subject = feedback_message[2]
                    var datetime = feedback_message[3];
                    message = message.replace(/<br\s*\/?>/mg," ");
                    console.log(message)
                    feedback_id.textContent = `Feedback ID: ${buttonValue} received on: ${datetime}`
                    sender_name.textContent = `${email}`
                    subject_h3.textContent =   `${subject}`
                    message_content.textContent = `${message}`
                })
                .catch((error=>{
                    console.log(error);
                }))
            });
        });
    </script>
<?php include '../admin/assets/includes/footer.php'; }?>