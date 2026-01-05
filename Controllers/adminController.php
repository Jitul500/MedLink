<?php
session_start();
require_once '../Models/userModel.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../Views/doctor-admin-login.php");
  exit();
}

function uploadProfilePic()
{

  if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {

    $fileName = $_FILES['profile_pic']['name'];
    $tmpName = $_FILES['profile_pic']['tmp_name'];
    $extArray = explode('.', $fileName);
    $fileExt = strtolower(end($extArray));
    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExt, $allowed)) {
      $newFileName = time() . '.' . $fileExt;
      if (move_uploaded_file($tmpName, '../uploads/' . $newFileName)) {
        return $newFileName; 
      }
    }
  }
  return null; 
}

$doctors = getUsersByRole('doctor');
$patients = getUsersByRole('patient');


if (isset($_POST['add_doctor'])) {

  $pic = uploadProfilePic();
  $final_pic = ($pic != null) ? $pic : 'default.png';

  $new_doctor = [
    'username' => $_POST['username'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'gender' => $_POST['gender'],
    'specialty' => $_POST['specialty'],
    'password' => $_POST['password'],
    'role' => 'doctor',
    'profile_pic' => $final_pic 
  ];

  if (addUser($new_doctor)) {
    header("Location: ../Views/admindashboard.php?page=doctors");
  } else {
    echo "Failed to add doctor!";
  }
  exit();
}

if (isset($_POST['update_doctor'])) {

  $pic = uploadProfilePic();

  $updated_doctor = [
    'id' => $_POST['id'],
    'username' => $_POST['username'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'gender' => $_POST['gender'],
    'specialty' => $_POST['specialty'],
    'password' => $_POST['password']
  ];

  if ($pic != null) {
    $updated_doctor['profile_pic'] = $pic;
  }

  updateUser($updated_doctor);
  header("Location: ../Views/admindashboard.php?page=doctors");
  exit();
}

if (isset($_POST['update_patient'])) {

  $pic = uploadProfilePic();

  $updated_patient = [
    'id' => $_POST['id'],
    'username' => $_POST['username'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'gender' => $_POST['gender'],
    'password' => $_POST['password'],
    'specialty' => ''
  ];

  if ($pic != null) {
    $updated_patient['profile_pic'] = $pic;
  }

  updateUser($updated_patient);
  header("Location: ../Views/admindashboard.php?page=patients");
  exit();
}

if (isset($_GET['action']) && isset($_GET['id'])) {
  $id = $_GET['id'];
  $type = $_GET['action'];

  if ($type == 'delete_doc' || $type == 'delete_pat') {
    deleteUser($id);
  }

  $redirect_page = ($type == 'delete_doc') ? 'doctors' : 'patients';
  header("Location: ../Views/admindashboard.php?page=" . $redirect_page);
  exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$edit_data = null;
if (isset($_GET['edit']) && isset($_GET['id'])) {
  $id = $_GET['id'];
  $edit_data = getUserById($id);
}
?>