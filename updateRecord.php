<?php 

include_once('initDB.php');
session_start();

if(isset($_POST["new-record"])){
  $sql = 'INSERT INTO items VALUES (\''.$_POST["serialid"].'\',
    \''.$_POST["name"].'\',
    \''.$_POST["prodid"].'\',
    \''.$_SESSION["userID"].'\',
    \''.$_POST["location"].'\',
    \''.$_POST["date"].'\',
    \''.$_POST["status"].'\')';

}

else{

  $sql1 = 'DELETE FROM items WHERE SERIALID =\''.$_POST["prevserialid"].'\' AND PRODNUM = \''.$_POST["prevprodnum"].'\';';
  $retval = mysqli_query($conn,$sql1);

  if(! $retval ) {
    die('Could not get data: ' . mysqli_error());
    echo '<p>Error: Could not get data </p>';
  }

  $sql = 'INSERT INTO items VALUES (\''.$_POST["serialid"].'\',
  \''.$_POST["name"].'\',
  \''.$_POST["prodid"].'\',
  \''.$_SESSION["userID"].'\',
  \''.$_POST["location"].'\',
  \''.$_POST["date"].'\',
  \''.$_POST["status"].'\')';

  }

$retval = mysqli_query($conn,$sql);

if(! $retval ) {
  die('Could not get data: ' . mysqli_error());
  echo '<p>Error: Could not get data </p>';
}

else{
  echo 'Successfully updated';
  header("location: all-items.php");
}

?>