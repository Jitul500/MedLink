<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../../Views/patientlogin.php");
    exit();
}

require_once "../../Controllers/doctorController.php";

$doctors = getDoctorsController();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
    <link rel="stylesheet" href="../../Assets/list_DOC_PT.css">
</head>
<body>

<div class="page-wrapper">

    <header class="page-header">
        <h1>Doctors</h1>
        <a href="../patient/dashboard.php" class="back-btn">Back</a>
    </header>


    
   

    <div class="card2">
        <input type="text" id="searchInput" placeholder="Search patient...">

        <div class="patient-list">

   <?php foreach ($doctors as $doctor): ?>
    <div class="patient-card">

        <div class="avatar">
            <?php echo strtoupper(substr($doctor['name'], 0, 1)); ?>
        </div>

        <div class="patient-details">
            <h4><?php echo $doctor['name']; ?></h4>
            <p><?php echo $doctor['email']; ?></p>
            <p><?php echo $doctor['phone']; ?></p>
            <p><?php echo $doctor['specialty']; ?></p>

            <a href="viewDoctor.php?id=<?php echo $doctor['id']; ?>" class="view-btn">
                View Profile
            </a>
        </div>

    </div>
<?php endforeach; ?>





</div>

    </div>

</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    let value = this.value.toLowerCase();
    document.querySelectorAll(".patient-card").forEach(card => {
        card.style.display = card.textContent.toLowerCase().includes(value)
            ? "inline-block"
            : "none";
    });
});
</script>


</body>
</html>
