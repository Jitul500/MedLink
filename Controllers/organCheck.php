<?php
// ডাটাবেস কানেকশন
require_once '../Models/db.php';

function getRecipients() {
    $con = getConnection();
    // শুধু যাদের স্ট্যাটাস 'Waiting', তাদের ডাটা আনব
    $sql = "SELECT * FROM organ_recipients WHERE status = 'Waiting'";
    $result = mysqli_query($con, $sql);
    
    $recipients = [];
    while($row = mysqli_fetch_assoc($result)) {
        $recipients[] = $row;
    }
    return $recipients;
}

// ফাংশন কল করে ডাটা ভেরিয়েবলে রাখা হলো
$recipient_list = getRecipients();
?>