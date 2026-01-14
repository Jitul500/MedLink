<?php  
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'patient') {
    header("Location: ../../Views/patientlogin.php");
    exit();
}

require_once "../../Controllers/reportController.php";

$patient_id = $_SESSION['id'];
$reports = getReportsByPatientController($patient_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Medical Reports</title>
    <link rel="stylesheet" href="../../Assets/reports.css">
</head>
<body>

<div class="page-wrapper">

    <header class="page-header">
        <h2>My Medical Reports</h2>
        <a href="../patient/dashboard.php" class="back-btn">&lt; Back</a>
    </header>

    <div class="card">
        <h3>Reports</h3>

        <?php if(count($reports) === 0): ?>
            <p>No medical reports found.</p>
        <?php else: ?>

        <table>
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Specialty</th>
                    <th>File</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($reports as $r): ?>
                <tr>
                    <td><?php echo $r['doctor_name'] ?></td>
                    <td><?php echo $r['doctor_specialty'] ?></td>
                    <td><?php echo $r['file'] ?></td>
                    <td><?php echo $r['date'] ?></td>
                    <td>
                        <a href="../../Uploads/<?= urlencode($r['file']) ?>" target="_blank" class="view-btn">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php endif; ?>
    </div>

</div>

</body>
</html>
