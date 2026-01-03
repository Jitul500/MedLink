<?php
session_start();
require_once '../Models/userModel.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../Views/doctor-admin-login.php");
  exit();
}

$doctors = getUsersByRole('doctor');
$patients = getUsersByRole('patient');

if (isset($_POST['add_doctor'])) {
  $new_doctor = [
    'username' => $_POST['username'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'gender' => $_POST['gender'],
    'specialty' => $_POST['specialty'],
    'password' => $_POST['password'],
    'role' => 'doctor'
  ];

  if (addUser($new_doctor)) {
    header("Location: ../Views/admindashboard.php?page=doctors");
  } else {
    echo "Failed to add doctor!";
  }
  exit();
}

if (isset($_POST['update_doctor'])) {
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
  updateUser($updated_doctor);
  header("Location: ../Views/admindashboard.php?page=doctors");
  exit();
}

if (isset($_POST['update_patient'])) {
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