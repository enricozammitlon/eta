<?php include_once('header.php');?>
	<div class="all-content">
	    <div class="left-admin-menu">
	    <?php include_once('admin-menu.php');?>
	    </div>
	    <div class="main-content">
		<?php
			$sql = 'SELECT * FROM items ';

		   $retval = mysql_query( $sql, $conn );
		   
		   if(! $retval ) {
		      die('Could not get data: ' . mysql_error());
		      echo '<p>Error: Could not get data </p>';
		   }

		   while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
		      echo "Product ID :{$row['SERIALID']} <br> ".
		         "Name: {$row['NAME']} <br> ".
		         "--------------------------------<br>";
		   }
		   echo "Fetched data successfully\n";
		?>
	    </div>
	  </div>
<?php include_once('footer.php'); ?>