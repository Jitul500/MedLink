<?php
require_once('db.php');

function login($user)
{
  $con = getConnection();

  $sql = "select * from users where username='{$user['username']}' and password='{$user['password']}'";
  $result = mysqli_query($con, $sql);
  
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  } else {
    return false;
  }
}

function addUser($user)
{
  $con = getConnection();

  $specialty = isset($user['specialty']) ? $user['specialty'] : '';
  $profile_pic = isset($user['profile_pic']) ? $user['profile_pic'] : 'default.png';

  $sql = "insert into users (username, name, email, phone, gender, password, role, specialty, profile_pic) 
            values('{$user['username']}', '{$user['name']}', '{$user['email']}', '{$user['phone']}', '{$user['gender']}', '{$user['password']}', '{$user['role']}', '$specialty', '$profile_pic')";

  if (mysqli_query($con, $sql)) {
    return true;
  } else {
    return false;
  }
}

function getUsersByRole($role)
{
  $con = getConnection();
  $sql = "select * from users where role='$role'";
  $result = mysqli_query($con, $sql);
  $users = [];
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($users, $row);
  }
  return $users;
}

function getUserById($id)
{
  $con = getConnection();
  $sql = "select * from users where id='$id'";
  $result = mysqli_query($con, $sql);
  return mysqli_fetch_assoc($result);
}

function updateUser($user)
{
  $con = getConnection();
  $specialty = isset($user['specialty']) ? $user['specialty'] : '';

  $imageUpdate = "";
  if (isset($user['profile_pic']) && !empty($user['profile_pic'])) {
    $imageUpdate = ", profile_pic='{$user['profile_pic']}'";
  }

  $sql = "UPDATE users SET 
            username='{$user['username']}', 
            name='{$user['name']}', 
            email='{$user['email']}', 
            phone='{$user['phone']}', 
            gender='{$user['gender']}', 
            password='{$user['password']}',
            specialty='$specialty'
            $imageUpdate 
            WHERE id='{$user['id']}'";

  if (mysqli_query($con, $sql)) {
    return true;
  } else {
    return false;
  }
}

function deleteUser($id)
{
  $con = getConnection();
  $sql = "DELETE FROM users WHERE id='$id'";
  if (mysqli_query($con, $sql)) {
    return true;
  } else {
    return false;
  }
}
?>