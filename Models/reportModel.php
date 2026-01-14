<?php
require_once "db.php"; 

function addReportModel($patient_id, $doctor_id, $file, $date){
    $conn = getConnection(); 

    $sql = "INSERT INTO reports (patient_id, doctor_id, file, date)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiss", $patient_id, $doctor_id, $file, $date);

    if(mysqli_stmt_execute($stmt)){
        return true;
    } else {
        
        return false;
    }
}

function getAllReports(){
    $conn = getConnection();
    $sql = "
        SELECT r.id, r.file, r.date,
               p.name AS patient_name,
               d.name AS doctor_name,
               d.specialty AS doctor_specialty
        FROM reports r
        JOIN users p ON r.patient_id = p.id
        JOIN users d ON r.doctor_id = d.id
        ORDER BY r.date DESC
    ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getReportsByPatient($patient_id){
    $conn = getConnection();
    $sql = "
        SELECT r.id, r.file, r.date,
               p.name AS patient_name,
               d.name AS doctor_name,
               d.specialty AS doctor_specialty
        FROM reports r
        JOIN users p ON r.patient_id = p.id
        JOIN users d ON r.doctor_id = d.id
        WHERE r.patient_id = ?
        ORDER BY r.date DESC
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $patient_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function deleteReportModel($report_id){
    $conn = getConnection();

    $sql = "SELECT file FROM reports WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $report_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){
        $filename = $row['file'];
        $filePath = "../../Uploads/" . $filename;

        if(file_exists($filePath)){
            unlink($filePath);
        }

        $sqlDel = "DELETE FROM reports WHERE id = ?";
        $stmtDel = mysqli_prepare($conn, $sqlDel);
        mysqli_stmt_bind_param($stmtDel, "i", $report_id);
        return mysqli_stmt_execute($stmtDel);
    }

    return false;
}


function getReportCount($patient_id) {
    $con = getConnection();

    $sql = "SELECT COUNT(*) AS total FROM reports WHERE patient_id = '$patient_id'";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);
    return $row['total']; 
}

?>
