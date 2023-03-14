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
    $tabName = "Incident Logs";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';?>

    <div class="container">
        <div class="row">
            <div class="col-3">
                <p class="fs-2 fw-bold text-center">Incidents Logs</p>
                <div class="chats">
                    <?php
                        include '../system/database/dbcon.php';

                        $ref_table = "incident_logs";
                        $fetch_data = $database->getReference($ref_table)->getValue();
                        if($fetch_data > 0){
                            foreach($fetch_data as $key => $row){  
                    ?>
                        <div class="list-group">
                            <button type="button" class="anon_btn btn btn-dark rounded-0 text-start" value="<?= $key ?>"><?= $key ?></button>
                        </div>
                    <?php
                    }
                }else{
                ?>
                    <p class="fw-bold text-light text-center mt-5">There are no incident logs right now.</p>
                <?php
                    }
                ?>
                </div>
            </div>

            <!---This is where the messages will appear-->
            <div class="col-9">
                <div class="custom">
                    <div class="card rounded-0 bg-dark" style="height: 100%;">
                            <div class="card-header text-center">
                                <div class="fw-bold text-light">Incident Report Form</div>
                            </div>
                        <div class="card-body">
                            <h5 class="il-id fw-semibold text-light">Incident Log ID: submitted at </h5>
                            <p class="il-dt lead text-light">Date and Time of Incident: </p>   
                            <p class="il-el lead text-light">Exact Location: </p>    

                            <h5 class="fw-semibold text-light">Incident Details</h5>  
                            <p class="il-p lead text-light">Incident Priority: </p>    
                            <p class="il-t lead text-light">Incident Type: </p>      
                            <h5 class="fw-semibold text-light">Incident Description</h5>  
                            <p class="il-d lead text-light">Details: </p>

                            <h5 class="fw-semibold text-light">Medical Details</h5>  
                            <p class="il-mr lead text-light">Is immediate medical attention required? </p>    
                            <p class="il-ma lead text-light">What kind of medical attention was administered? </p> 
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
        var il_logID = document.querySelector('.il-id');
        var il_dt = document.querySelector('.il-dt');
        var il_el = document.querySelector('.il-el');
        var il_p = document.querySelector('.il-p');
        var il_t = document.querySelector('.il-t');
        var il_d = document.querySelector('.il-d');
        var il_mr = document.querySelector('.il-mr');
        var il_ma = document.querySelector('.il-ma');

        var buttons = document.querySelectorAll(".anon_btn");
            buttons.forEach(function(button){
            button.addEventListener("click", function(){
                var buttonValue = this.value;
                var dbref = ref(db);
                var incident_log = [];
                get(child(dbref, "incident_logs/" + buttonValue))
                .then((snapshot)=>{
                    snapshot.forEach(childSnapshot =>{
                        incident_log.push(childSnapshot.val());
                    });
                    var datetime_incident = incident_log[0];
                    const date = new Date(datetime_incident);
                    const options = {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                    };
                    const newFormat = date.toLocaleString('en-US', options);

                    var datetime_submitted = incident_log[1];
                    var exact_location = incident_log[2];
                    var incident_desc = incident_log[3];
                    incident_desc = incident_desc.replace(/<br\s*\/?>/mg," ");
                    var incident_priority = incident_log[4];
                    var incident_type = incident_log[5];
                    var med_administered = incident_log[6];
                    var medical_attention = incident_log[7];

                    il_logID.textContent = `Incident Log ID: ${buttonValue} received at ${datetime_submitted}`
                    il_dt.textContent = `Date and Time of Incident: ${newFormat}`
                    il_el.textContent = `Exact Location: ${exact_location}`
                    il_p.textContent = `Incident Priority: ${incident_priority}`
                    il_t.textContent = `Incident Type: ${incident_type}`
                    il_d.textContent = `${incident_desc}`
                    il_mr.textContent = `Is immediate medical attention required? ${medical_attention}`
                    il_ma.textContent = `What kind of medical attention was administered? ${med_administered}`
                })
                .catch((error=>{
                    console.log(error);
                }))
            });
        });
    </script>

<?php include '../admin/assets/includes/footer.php'; }?>