<?php

$edit_state = false;
$name = "";
$organ = "";
$blood = "";
$gender = "";
$urgency = "Normal";
$status = "Waiting";
$id = 0;


if (isset($_POST['save_recipient'])) {
    $con = getConnection();
    $name = $_POST['name'];
    $organ = $_POST['organ'];
    $blood = $_POST['blood'];
    $gender = $_POST['gender'];
    $urgency = $_POST['urgency'];
    $status = $_POST['status'];

    $sql = "INSERT INTO organ_recipients (name, organ_needed, blood_type, gender, urgency, status) 
            VALUES ('$name', '$organ', '$blood', '$gender', '$urgency', '$status')";
    
    mysqli_query($con, $sql);
    header('Location: Organ_Donation.php'); 
    exit();
}


if (isset($_POST['update_recipient'])) {
    $con = getConnection();
    $id = $_POST['id'];
    $name = $_POST['name'];
    $organ = $_POST['organ'];
    $blood = $_POST['blood'];
    $gender = $_POST['gender'];
    $urgency = $_POST['urgency'];
    $status = $_POST['status'];

    $sql = "UPDATE organ_recipients SET 
            name='$name', organ_needed='$organ', blood_type='$blood', 
            gender='$gender', urgency='$urgency', status='$status' 
            WHERE id=$id";
    
    mysqli_query($con, $sql);
    header('Location: Organ_Donation.php');
    exit();
}


if (isset($_GET['del'])) {
    $con = getConnection();
    $id = $_GET['del'];
    mysqli_query($con, "DELETE FROM organ_recipients WHERE id=$id");
    header('Location: Organ_Donation.php');
    exit();
}


if (isset($_GET['edit'])) {
    $con = getConnection();
    $id = $_GET['edit'];
    $edit_state = true;
    
    $rec = mysqli_query($con, "SELECT * FROM organ_recipients WHERE id=$id");
    $record = mysqli_fetch_array($rec);
    
    $name = $record['name'];
    $organ = $record['organ_needed'];
    $blood = $record['blood_type'];
    $gender = $record['gender'];
    $urgency = $record['urgency'];
    $status = $record['status'];
    $id = $record['id'];
}


function getRecipients() {
    $con = getConnection();
    $sql = "SELECT * FROM organ_recipients"; 
    $result = mysqli_query($con, $sql);
    
    $recipients = [];
    while($row = mysqli_fetch_assoc($result)) {
        $recipients[] = $row;
    }
    return $recipients;
}

$recipient_list = getRecipients();
?>