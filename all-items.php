<?php include_once('header.php');?>
	<div class="all-content">
	    <div class="left-admin-menu">
	    <?php include_once('admin-menu.php');?>
	    </div>
	    <div class="main-content">
		<?php
			$sql = 'SELECT * FROM items ';
			$retval = mysqli_query($conn,$sql);

			if(! $retval ) {
			  die('Could not get data: ' . mysqli_error());
			  echo '<p>Error: Could not get data </p>';
			}

			else{
				while($row = mysqli_fetch_assoc($retval)) {
				  echo "Serial ID :{$row['SERIALID']} <br> ".
				     "Product ID: {$row['PRODNUM']} <br> ".
             "Name: {$row['NAME']} <br> ".
             "User ID of Reporter: {$row['USERID']} <br> ".
				     "--------------------------------<br>";
				}
				echo "Fetched data successfully\n";
			}
		?>
	  </div>
	</div>
<?php include_once('footer.php'); ?>