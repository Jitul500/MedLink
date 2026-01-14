<?php
require_once '../Controllers/authCheck.php';
require_once '../Models/userModel.php';

if ($_SESSION['role'] !== 'admin') {
  header("Location: ../Views/login.php");
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
$receptionists = getUsersByRole('receptionist'); 

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$edit_data = null;

if (isset($_GET['edit']) && isset($_GET['id'])) {
  $id = $_GET['id'];
  $edit_data = getUserById($id);
}

if (isset($_POST['add_doctor'])) {
  $pic = uploadProfilePic();
  $final_pic = ($pic != null) ? $pic : 'default.png';

  $new_user = $_POST;
  $new_user['role'] = 'doctor';
  $new_user['profile_pic'] = $final_pic;

  if (addUser($new_user)) {
    header("Location: ../Views/admindashboard.php?page=doctors");
  } else {
    echo "Failed to add doctor!";
  }
  exit();
}

if (isset($_POST['update_doctor'])) {
  $pic = uploadProfilePic();
  $updated_user = $_POST;

  if ($pic != null) {
    $updated_user['profile_pic'] = $pic;
  }

  updateUser($updated_user);
  header("Location: ../Views/admindashboard.php?page=doctors");
  exit();
}

if (isset($_POST['add_receptionist'])) {
  $pic = uploadProfilePic();
  $final_pic = ($pic != null) ? $pic : 'default.png';

  $new_recep = $_POST;
  $new_recep['role'] = 'receptionist'; 
  $new_recep['specialty'] = ''; 
  $new_recep['profile_pic'] = $final_pic;

  if (addUser($new_recep)) {
    header("Location: ../Views/admindashboard.php?page=receptionists");
  } else {
    echo "Failed to add receptionist!";
  }
  exit();
}

if (isset($_POST['update_receptionist'])) {
  $pic = uploadProfilePic();
  $updated_recep = $_POST;
  $updated_recep['specialty'] = '';

  if ($pic != null) {
    $updated_recep['profile_pic'] = $pic;
  }

  updateUser($updated_recep);
  header("Location: ../Views/admindashboard.php?page=receptionists");
  exit();
}

if (isset($_POST['update_patient'])) {
  $pic = uploadProfilePic();
  $updated_patient = $_POST;
  $updated_patient['specialty'] = '';

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

  if (in_array($type, ['delete_doc', 'delete_pat', 'delete_recep'])) {
    deleteUser($id);
  }

  if ($type == 'delete_doc')
    $redirect = 'doctors';
  elseif ($type == 'delete_recep')
    $redirect = 'receptionists';
  else
    $redirect = 'patients';

  header("Location: ../Views/admindashboard.php?page=" . $redirect);
  exit();
}
?>