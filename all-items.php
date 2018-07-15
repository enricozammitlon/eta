<?php include_once('header.php');?>
	<div class="all-content">
	    <div class="left-admin-menu">
	    <?php include_once('admin-menu.php');?>
	    </div>
	    <div class="main-content">
        <h2>All Items</h2>
		<?php
			$sql = 'SELECT * FROM items ';
			$retval = mysqli_query($conn,$sql);

			if(! $retval ) {
			  die('Could not get data: ' . mysqli_error());
			  echo '<p>Error: Could not get data </p>';
			}

			else{
        ?>
        <table border="1" style="width:100%">
          <thead>
            <tr>
              <th>Serial ID</th>
              <th>Product ID</th>
              <th>Name</th>
              <th>User ID of Reporter</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_assoc($retval)) {
                echo "
                  <tr>
                  <td>{$row['SERIALID']}</td>
                  <td>{$row['PRODNUM']}</td>
                  <td>{$row['NAME']}</td>
                  <td>{$row['USERID']}</td>
                  <form action='editItem.php' method='post/get'>
                  <input type='hidden' name='id' value='<?php echo {$row['SERIALID']}.{$row['PRODNUM']} ?>' />
                  <input type='submit' value='Edit'/>
                  </form>
                  </tr>";
              }
            ?>
          </tbody>
        </table>
				<?php
			}
		?>
	  </div>
	</div>
<?php include_once('footer.php'); ?>