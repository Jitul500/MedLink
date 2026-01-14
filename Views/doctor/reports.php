<?php 
session_start();
require_once "../../Controllers/patientController.php";
require_once "../../Controllers/reportController.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
    echo "Unauthorized! <a href='../../Views/patientlogin.php'>Login</a>";
    exit();
}

if (isset($_GET['delete'])) {
    $report_id = intval($_GET['delete']);
    if (deleteReportController($report_id)) {
        header("Location: reports.php?msg=deleted");
        exit();
    } else {
        header("Location: reports.php?msg=error");
        exit();
    }
}

$patients = getPatientsController();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['report_file'])){
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_SESSION['id'];   
    $file = $_FILES['report_file'];

    $uploadDir = "../../Uploads/";
    if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $filename = time() . ".pdf"; 
    $destination = $uploadDir . $filename;

    if(move_uploaded_file($file['tmp_name'], $destination)){
        $date = date("Y-m-d");
        if(addReport($patient_id, $doctor_id, $filename, $date)){
            $msg = "Report uploaded successfully!";
        } else {
            $msg = "Database error!";
        }
    } else {
        $msg = "Failed to move file!";
    }
}


$reports = getReportsController(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Reports</title>
    <link rel="stylesheet" href="../../Assets/reports.css">
</head>
<body>
<div class="page-wrapper">

    <header class="page-header">
        <h2>Medical Reports</h2>
        <a href="../doctor/dashboard.php" class="back-btn">&lt; Back</a>
    </header><h2>Upload Report</h2>

<?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>

<form method="post" enctype="multipart/form-data">
    <select name="patient_id" required>
        <option value="">Select Patient</option>
        <?php foreach($patients as $p): ?>
            <option value="<?= $p['id'] ?>"><?php echo $p['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <input type="file" name="report_file" accept="application/pdf" required>
    <button type="submit">Upload</button>
</form>

<h3>Uploaded Reports</h3>

<?php if(count($reports) === 0): ?>
    <p>No reports found.</p>
<?php else: ?>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>File</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($reports as $index => $r): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?php echo $r['patient_name'] ?></td>
            <td><?php echo $r['doctor_name'] ?></td>
            <td><?php echo $r['file'] ?></td>
            <td><?php echo $r['date'] ?></td>
            <td>
                <a href="../../Uploads/<?= urlencode($r['file']) ?>" target="_blank" class="view-btn"s>View</a> | 
                <a href="?delete=<?= $r['id'] ?>" onclick="return confirm('Delete this report?')" class="view-btn">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

    </div>
</body>
</html>
