<?php 

include_once('initDB.php');
include_once('upload.php');
session_start();

if(isset($_POST["new-record"])){
  $unixTimestamp = time();
  $mysqlTimestamp = date("Y-m-d", $unixTimestamp);

  $sql = 'INSERT INTO items VALUES (\''.$_POST["serialid"].'\',
    \''.$_POST["name"].'\',
    \''.$_POST["prodid"].'\',
    \''.$_SESSION["userID"].'\',
    \''.$_POST["location"].'\',
    \''.$_POST["description"].'\',
    \''.$mysqlTimestamp.'\',
    \''.$_POST["status"].'\')';

}

else{

  $unixTimestamp = time();
  $mysqlTimestamp = date("Y-m-d", $unixTimestamp);

  $sql1 = 'DELETE FROM items WHERE SERIALID =\''.$_POST["prevserialid"].'\' AND PRODNUM = \''.$_POST["prevprodnum"].'\';';
  $retval = mysqli_query($conn,$sql1);

  if(! $retval ) {
    die('Could not get data: ' . mysqli_error($conn));
    echo '<p>Error: Could not get data </p>';
  }

  $sql = 'INSERT INTO items VALUES (\''.$_POST["serialid"].'\',
    \''.$_POST["name"].'\',
    \''.$_POST["prodid"].'\',
    \''.$_SESSION["userID"].'\',
    \''.$_POST["location"].'\',
    \''.$_POST["description"].'\',
    \''.$mysqlTimestamp.'\',
    \''.$_POST["status"].'\')';

  }

$retval = mysqli_query($conn,$sql);

$resultUpload=testUploadFiles($conn);


if(! $retval ) {
  die('Could not get data: ' . mysqli_error($conn));
  echo '<p>Error: Could not get data </p>';
}

else{
  echo 'Successfully updated';
  header("location: all-items.php");
}

?>