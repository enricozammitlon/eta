<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){?>
	<?php include_once('header.php');?>
	  <div class="all-content">
	    <div class="left-admin-menu">
	    <?php include_once('admin-menu.php');?>
	    </div>
	    <div class="main-content">
	      <h1> <?php echo $_POST["id"] ?></h1>
	    </div>
	  </div>

	<?php include_once('footer.php'); }?>