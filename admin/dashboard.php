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
    $tabName = "Dashboard";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';?>

    <div class="container">
        <div class="card rounded-0 mb-3 bg-dark">
            <div class="card-body">
                <div class="card-header text-center">
                    <div class="text-light fs-4">Bus en Route</div>
                </div>
                <table class="tb-custom table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Bus' License Plate</th>
                            <th scope="col">Route</th>
                            <th scope="col">Arrived at</th>
                            <th scope="col">Time Arrived</th>
                        </tr>
                    </thead>
                    <tbody id="tbody1">
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card rounded-0 bg-dark">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="text-light fs-4">Employee's Ratings</div>
                        </div>

                        <?php 
                            include '../system/database/dbcon.php';
                            $roles = "account_roles";
                            $rating = "employee_rating";
                            $users = $auth->listUsers();
                            foreach($users as $user) {
                                $fetch_roles = $database->getReference($roles)->getValue();
                                $overall_rating = 0;
                                $total_rate = 0;
                                if($fetch_roles > 0){
                                    foreach($fetch_roles as $key => $row){
                                        $fetch_rating = $database->getReference($rating)->getValue();
                                        if($fetch_rating > 0){
                                            foreach($fetch_rating as $rate_key => $rate_row){
                                                if($user->uid == $rate_row['employee_uid']){
                                                    $overall_rating += $rate_row['efficiency'];
                                                    $total_rate++;
                                                }
                                            }
                                        }
                                        if($user->uid == $row['account_id']){
                                            ?>
                            <div class="card bg-dark">
                                <div class="card-body">
                                    <div class="card-header text-center text-light">
                                        <?php echo $user->displayName; ?>
                                    </div>

                                    <div class="card-text text-light pt-3">
                                        Employee ID: <?= $user->uid ?>
                                    </div>

                                    <div class="card-text text-light pt-3">
                                        Overall Performance Rating: <?php  if($total_rate != 0){echo $average_rating = round($overall_rating/$total_rate);}else{echo 0;} ?> out of 5
                                    </div>
                                </div>
                            </div>
                        <?php
                                        }
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <script type="module">
            // Import the functions you need from the SDKs you need
            import { initializeApp } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-app.js";
            //import { getAnalytics } from "firebase/analytics";
            import { getDatabase, ref, set, child, get, onValue } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-database.js";
            import { getAuth } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-auth.js";
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
            const auth = getAuth();

            var tbody = document.getElementById('tbody1');
            function addItemToTheTable(bus_driver_id,bus_id,route_id,arrived_at,arrived_time){
                let trow = document.createElement("tr");
                let td2 = document.createElement('td');
                let td3 = document.createElement('td');
                let td4 = document.createElement('td');
                let td5 = document.createElement('td');
                let td6 = document.createElement('td');

                const dbref = ref(db);
                get(child(dbref, "routes")).then((snapshot) => {
                    snapshot.forEach(childSnapshot =>{
                        if (childSnapshot.key === route_id) {
                            const route_name = childSnapshot.val().route_name;
                            td4.innerHTML= route_name;
                        }
                    })
                }).catch((err) => {
                    console.log(err)
                });

                get(child(dbref, "bus")).then((snapshot) => {
                    snapshot.forEach(childSnapshot =>{
                        if (childSnapshot.key === bus_id) {
                            const license_plate = childSnapshot.val().license_plate;
                            td3.innerHTML= license_plate;
                        }
                    })
                }).catch((err) => {
                    console.log(err)
                });
                
                td2.innerHTML= bus_driver_id;
                td5.innerHTML= arrived_at;
                td6.innerHTML= arrived_time;

                trow.appendChild(td2);
                trow.appendChild(td3);
                trow.appendChild(td4);
                trow.appendChild(td5);
                trow.appendChild(td6);

                tbody.appendChild(trow);
            }

            function AddAllItemsToTable(AllBusLocation){
                tbody.innerHTML="";
                AllBusLocation.forEach(element =>{
                    addItemToTheTable( element.employee_uid, element.bus_id, element.route_id, element.arrived_at, element.arrived_time);
                });
            }

            function getAllDataOnce(){
                const dbref = ref(db);

                get(child(dbref, "bus_location")).then((snapshot) => {
                    var locations = [];
                    snapshot.forEach(childSnapshot =>{
                        locations.push(childSnapshot.val());
                    });
                    AddAllItemsToTable(locations)
                }).catch((err) => {
                    console.log(err)
                });
            }

            function getAllDataRealtime(){
                const dbref = ref(db, "bus_location");

                onValue(dbref,(snapshot)=>{
                    var locations = [];
                    snapshot.forEach(childSnapshot =>{
                        locations.push(childSnapshot.val());
                    });
                    AddAllItemsToTable(locations)
                }).catch((err)=>{
                    console.log(err)
                });

            }

            window.onload = getAllDataRealtime();
        </script>

    </div>  
<?php include '../admin/assets/includes/footer.php'; }?>