<?php 

include_once('header.php');?>
  <div class="all-content">
    <div class="left-admin-menu">
   	<?php 
   		session_start();
   		?><p><?php echo("{$_SESSION['isAdmin']}"."<br />");?></p><?php
   		if($_SESSION['isAdmin']){
   		 include_once('admin-menu.php');
		}?>
    </div>
    <div class="main-content">
      <h1> Here goes the actual content </h1>
    </div>
  </div>

<?php include_once('footer.php'); ?>