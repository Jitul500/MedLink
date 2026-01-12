<?php
session_start();



require_once '../Models/userModel.php'; 


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'receptionist') {
    echo "Unauthorized access! <a href='../auth/login.php'>Login</a>";
    exit();
}


$patients = getUsersByRole('patient');
$doctors = getUsersByRole('doctor');   

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receptionist Dashboard - MedLink</title>
  <link rel="stylesheet" href="../Assets/doctor-dashboard-style.css">
  <style>
    .booking-form {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }
    .form-group input, .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .btn-submit {
        background-color: #2c3e50; 
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    .btn-submit:hover {
        background-color: #34495e;
    }
  </style>
</head>
<body>

<aside class="sidebar">
  <h1>MEDLINK ADMIN</h1>
  <nav class="menu">
    <a href="#" class="active">Dashboard</a>
    <a href="#book-appointment">Book Appointment</a>
    <a href="Organ_Donation.php">Organ Donation</a> 
    <a href="../Controllers/logout.php">Logout</a>
  </nav>
</aside>

<main class="main-content">

  <header>
    <h1>Welcome, <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Receptionist'; ?></h1>
    <p>Manage appointments and hospital resources.</p>
  </header>

  <div class="dashboard-cards">
    <div class="card">
      <h3>Doctors Available</h3>
      <p><?php echo count($doctors); ?></p> 
    </div>

    <div class="card">
      <h3>New Appointments</h3>
      <p>8</p>
    </div>

    <div class="card" onclick="location.href='Organ_Donation.php'" style="cursor: pointer;">
      <h3>Organ Requests</h3>
      <p>5</p>
    </div>
  </div>

  <section id="book-appointment" class="panel">
    <h3>📅 Book Doctor Appointment</h3>
    <div class="booking-form">
        <form action="../Controllers/appointmentController.php" method="POST">
            
            <div class="form-group">
                <label for="patient_id">Select Patient</label>
                <select name="patient_id" id="patient_id" required>
                    <option value="">-- Choose a Patient --</option>
                    <?php 
        ে
                    if (!empty($patients)) {
                        foreach ($patients as $patient) {
                            echo '<option value="'.$patient['id'].'">'.$patient['name'].' (ID: '.$patient['id'].')</option>';
                        }
                    } else {
                        echo '<option value="">No patients found</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="doctor_id">Select Doctor</label>
                <select name="doctor_id" id="doctor_id" required>
                    <option value="">-- Choose a Doctor --</option>
                    <?php 
                    ে
                    if (!empty($doctors)) {
                        foreach ($doctors as $doctor) {
                            $specialty = !empty($doctor['specialty']) ? $doctor['specialty'] : 'General';
                            echo '<option value="'.$doctor['id'].'">Dr. '.$doctor['name'].' ('.$specialty.')</option>';
                        }
                    } else {
                        echo '<option value="">No doctors found</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" required>
            </div>

            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" name="time" id="time" required>
            </div>

            <button type="submit" name="book_appointment" class="btn-submit">Confirm Booking</button>
        </form>
    </div>
  </section>

  <section class="panel">
    <h3>Recent Bookings</h3>
    <table>
      <tr>
        <th>Time</th>
        <th>Date</th>
        <th>Doctor</th>
        <th>Patient</th>
        <th>Status</th>
      </tr>
      <tr>
        <td>09:00 AM</td>
        <td>12/01/26</td>
        <td>Dr. Smith</td>
        <td>Rahim Uddin</td>
        <td class="status pending">Pending</td>
      </tr>
      <tr>
        <td>10:30 AM</td>
        <td>12/01/26</td>
        <td>Dr. Sarah</td>
        <td>Karim Khan</td>
        <td class="status completed">Confirmed</td>
      </tr>
    </table>
  </section>

</main>

</body>

</html>
