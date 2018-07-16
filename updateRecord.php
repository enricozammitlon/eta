<?php 

include_once('initDB.php');

if(isset($_POST["new-record"])){
  $sql = 'INSERT INTO items VALUES (\''.$_POST["serialid"].'\',
    \''.$_POST["name"].'\',
    \''.$_POST["prodid"].'\',
    \''.$_POST["userid"].'\')';

}

else{

  $sql = 'DELETE FROM items WHERE SERIALID =\''.$_POST["prevserialid"].'\' AND PRODNUM = \''.$_POST["prevprodid"].'\';';


  $sql = $sql.'INSERT INTO items VALUES (\''.$_POST["serialid"].'\',
  \''.$_POST["name"].'\',
  \''.$_POST["prodid"].'\',
  \''.$_POST["userid"].'\')';

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