<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'patient') {
    echo "Unauthorized! <a href='../../Views/patientlogin.php'>Login</a>";
    exit();
}


require_once "../../Controllers/doctorController.php";
require_once "../../Controllers/reportController.php";

$patient_id = $_SESSION['id']; 
$reportCount = getReportCount($patient_id);
$totalDoctors = getDoctorCountController(); 
$reports = getReportsByPatientController($patient_id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Patient Dashboard - MedLink</title>
<link rel="stylesheet" href="../../Assets/patient-dashboard-style.css">



</head>
<body>

<aside class="sidebar">
  <h1>MEDLINK</h1>
  <nav class="menu">
    <a class="active" href="#">Dashboard</a>
    <a href="myprofile.php">My Profile</a>
    <a href="listOfDoctors.php">Doctors</a>
    <a href="appointments.php">Appointments</a>
    <a href="medicalRecords.php">Medical Records</a>
    <a href="../../Views/patientlogin.php?logout=1">Logout</a>
  </nav>
</aside>

<main class="main-content">

<header>
  <h1>Welcome, <?php echo $_SESSION['name']; ?> </h1>
  <p>Your personal health dashboard</p>
</header>

<div class="dashboard-cards">

  <div class="card highlight">
    <h3>Next Appointment</h3>
    <p>12 Jan, 4:00 PM</p>
    <span>Dr. Rahman</span>
  </div>

  <div class="card" onclick="location.href='medicalRecords.php'">
    <h3>Medical Reports</h3>
    <p><?php echo $reportCount; ?></p>
    <span>Uploaded by doctors</span>
  </div>

    <div class="card" onclick="location.href='listOfDoctors.php'">
    <h3>Available Doctors</h3>
    <p><?php echo $totalDoctors; ?></p>
    <span>Doctors available now</span>
  </div>

 
  <div class="card action" onclick="location.href='book-appointment.php'">
    <h3>Book Appointment</h3>
    <p>+</p>
    <span>Schedule now</span>
  </div>

</div>


<section class="data-section">
  <h3>🏥 Available Doctors</h3>

  <table id="doctorTable" border="1" style="width: 100%; border-collapse: collapse;">
    <thead>
      <tr style="background-color: #007bff; height:50px; color: #fff;">
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Specialty</th>
      </tr>
    </thead>
    <tbody>
      <tr style="text-align: center;  height:50px; " >
        <td colspan="5" style="text-align: center;  height:50px; ">Loading doctors...</td>
      </tr>
    </tbody>
  </table>
</section>


<section class="data-section">
  <h3>🏥 Medical Reports</h3>
<?php if(count($reports) === 0): ?>
            <p>No medical reports found.</p>
        <?php else: ?>

<table  id="doctorTable" border="1" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #007bff; height:50px; color: #fff;">
                    <th >Doctor</th>
                    <th>Specialty</th>
                    <th>File</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($reports as $r): ?>
                <tr>
                    <td style="text-align: center;  height:50px; "><?php echo $r['doctor_name'] ?></td>
                    <td style="text-align: center;  height:50px; "><?php echo $r['doctor_specialty'] ?></td>
                    <td style="text-align: center;  height:50px; "><?php echo $r['file'] ?></td>
                    <td style="text-align: center;  height:50px; "><?php echo $r['date'] ?></td>
                    <td style="text-align: center;  height:50px; ">
                        <a href="../../Uploads/<?= urlencode($r['file']) ?>" target="_blank" class="view-butn">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </section>
        <?php endif; ?>


<script>
function loadDoctors() {
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../../Controllers/doctors_api.php", true);
    xhttp.send();

    xhttp.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200){
            let doctors = JSON.parse(this.responseText);
            let tbody = document.querySelector("#doctorTable tbody");
            tbody.innerHTML = ""; 

            doctors.forEach(doctor => {
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td style="text-align: center;  height:50px; ">${doctor.name}</td>
                    <td style="text-align: center;  height:50px; ">${doctor.email}</td>
                    <td style="text-align: center;  height:50px; ">${doctor.phone}</td>
                    <td style="text-align: center;  height:50px; ">${doctor.specialty}</td>
                `;
                tbody.appendChild(row);
            });
        }
    };
}

document.addEventListener("DOMContentLoaded", loadDoctors);
</script>

</body>
</html>
