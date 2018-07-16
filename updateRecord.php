<?php 

include_once('initDB.php');

$sql = 'UPDATE items SET SERIALID = \''.$_POST["serialid"].'\',
    PRODNUM = \''.$_POST["prodid"].'\',
    NAME = \''.$_POST["name"].'\',
    USERID = \''.$_POST["userid"].'\'WHERE SERIALID =\''.$_POST["serialid"].'\' AND PRODNUM = \''.$_POST["prodid"].'\'' ;

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