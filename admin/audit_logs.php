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
    $tabName = "Audit Logs";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-3">
                <p class="fs-2 fw-bold text-center">Audit Trails</p>
                <div class="chats">
                    <?php
                        include '../system/database/dbcon.php';

                        $ref_table = "audit_logs";
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
                    <p class="lead text-light text-center mt-5">There are no audit logs right now.</p>
                <?php
                    }
                ?>
            </div>
        </div>

            <!---This is where the messages will appear-->
            <div class="col-9">
                <div class="custom">
                    <div class="card rounded-0 bg-dark" style="height: 100%;">
                            <div class="card-header">
                                <h5 class="log-id pt-2 fw-semibold text-light">Log ID: </h5>
                            </div>
                        <div class="card-body">
                            <h4 class="action-log fw-semibold text-light">Action</h4>
                            <h5 class="desc-log card-title text-light">Description</h5>                   
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
        var log_id = document.querySelector(".log-id");
        var action = document.querySelector(".action-log");
        var desc = document.querySelector(".desc-log");
        
        var buttons = document.querySelectorAll(".anon_btn");
            buttons.forEach(function(button){
            button.addEventListener("click", function(){
                var buttonValue = this.value;
                var dbref = ref(db);
                var audit_array = [];
                get(child(dbref, "audit_logs/" + buttonValue))
                .then((snapshot)=>{
                    snapshot.forEach(childSnapshot =>{
                        audit_array.push(childSnapshot.val());
                    });
                    var accountID = audit_array[0];
                    var action_D = audit_array[1]
                    var date_time = audit_array[2];
                    var action_desc = audit_array[3];

                    log_id.textContent = `Audit Log ID: ${buttonValue}  received on: ${date_time}`
                    action.textContent = `${action_D} Account ID: ${accountID}`
                    desc.textContent = `${action_desc}`
                })
                .catch((error=>{
                    console.log(error);
                }))
            });
        });
    </script>
<?php include '../admin/assets/includes/footer.php'; }?>