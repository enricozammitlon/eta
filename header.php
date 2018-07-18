<?php

// Initialize the session

session_start();

 

// If session variable is not set it will redirect to login page

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){

  header("location: login.php");

  exit;

}
?>

 <html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no">
    <title>ETA</title>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>

  <body>
    <header>
      <div class="title-text">
        <h1>E</h1>
        <p>quipment</p>
        <h1>T</h1>
        <p>racking</p>
        <h1>A</h1>
        <p>pplication</p>
        <br>
        <p><strong>ETA</strong> is an automated tracking system for replacement of faulty or broken parts.</p>
        </br>
      </div>
      <div class="db-status">
        <p>DB Status: </p>
          <strong><?php include_once('initDB.php');?></strong>
      </div>
     </header>      
<?php exit; ?>