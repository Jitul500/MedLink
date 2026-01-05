<?php
$host = '127.0.0.1';
$dbname = "medlink"; 
$dbuser = "root";
$dbpass = "";

function getConnection()
{
  global $host;
  global $dbname;
  global $dbuser;

  $con = mysqli_connect($host, $dbuser, $GLOBALS['dbpass'], $dbname);
  return $con;
}
?>
