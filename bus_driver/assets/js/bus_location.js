  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-app.js";
  //import { getAnalytics } from "firebase/analytics";
  import { getDatabase, ref, update, get, child} from "https://www.gstatic.com/firebasejs/9.4.0/firebase-database.js";
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

  let targetLocations = [];
  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  //const analytics = getAnalytics(app);
  let db = getDatabase();
  getTargetLocations();

  var watchId;
  var startTrackingBtn = document.getElementById("startTracking");
  var stopTrackingBtn = document.getElementById("stopTracking");
  var location_id = document.getElementById("location_id").value;
  var round_trip_count = 0;
  startTrackingBtn.addEventListener("click", startTracking);
  stopTrackingBtn.addEventListener("click", stopTracking);
  
  function startTracking() {
    if (navigator.geolocation) {
      watchId = navigator.geolocation.watchPosition(position => {
        const userCoords = {
          latitude: position.coords.latitude,
          longitude: position.coords.longitude
        };
        startTrackingBtn.disabled = true;
        stopTrackingBtn.disabled = false;
        for (let i = 0; i < targetLocations.length; i++) {
          const distance = haversineDistance(userCoords, targetLocations[i]);
          if (distance < 50) { // Within 50 meters
            let currentTime = new Date();
            let hours = currentTime.getHours();
            let minutes = currentTime.getMinutes();
            let seconds = currentTime.getSeconds();
            let ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            seconds = seconds < 10 ? '0'+seconds : seconds;
            let formattedTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
            
            update(ref(db, "bus_location/"+location_id+"/"),{
              arrived_at: targetLocations[i].stop_name,
              arrived_time: "Time Arrived: " + formattedTime
            }).catch((error)=>{
              console.log(error)
            });
            break;
          }else{
            update(ref(db, "bus_location/"+location_id+"/"),{
              arrived_at: "Next Stop",
              arrived_time: "Please Wait"
            }).catch((error)=>{
              console.log(error)
            });
          }
        }
      }, error => {
        console.error(error);
      }, {
        enableHighAccuracy: true,
        timeout: 30000, // 30 seconds
      }); 
    } else {  
      console.log("Geolocation is not supported by this browser.");
    }
  }

  function stopTracking() {
    navigator.geolocation.clearWatch(watchId);
    startTrackingBtn.disabled = false;
    stopTrackingBtn.disabled = true;

    update(ref(db, "bus_location/"+location_id+"/"),{
      arrived_at: "Temporarily Unavailable",
      arrived_time: "Temporarily Unavailable"
    }).catch((error)=>{
      console.log(error)
    });
  }

  function getTargetLocations() {
    targetLocations = [];
    // Retrieve the coordinates and names from the Firebase Realtime Database
    // const locationsRef = db.ref('locations');
    var dbref = ref(db);
    get(child(dbref,"bus_stop")).then((snapshot)=>{
      snapshot.forEach(childSnapshot=>{
        targetLocations.push({
          stop_name: childSnapshot.val().stop_name,
          latitude: childSnapshot.val().latitude,
          longitude: childSnapshot.val().longitude
        });
      })
    })
    .catch((error=>{
      console.log(error);
    }))
  }

  function haversineDistance(coords1, coords2){ 
    const radius = 6371e3; // Earth's radius in meters
    const lat1 = coords1.latitude * (Math.PI / 180);
    const lat2 = coords2.latitude * (Math.PI / 180);
    const latDelta = (coords2.latitude - coords1.latitude) * (Math.PI / 180);
    const lonDelta = (coords2.longitude - coords1.longitude) * (Math.PI / 180);
  
    const a = Math.sin(latDelta / 2) * Math.sin(latDelta / 2) +
              Math.cos(lat1) * Math.cos(lat2) *
              Math.sin(lonDelta / 2) * Math.sin(lonDelta / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return radius * c;
  }