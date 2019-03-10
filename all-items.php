<?php include_once('header.php');?>
	<div class="all-content">
	    <div class="left-admin-menu">
	    <?php 
      if($_SESSION['isAdmin']){
       include_once('admin-menu.php');
    }
    else{
      include_once('user-menu.php');
    }
    ?>
	    </div>
	    <div class="main-content">
        <h2>All Items</h2>
		<?php
      if($_SESSION['isAdmin']){
        $sql = 'SELECT * FROM items ';
      }
      else{
       $sql = 'SELECT * FROM items WHERE USERID=\''.$_SESSION["userID"].'\'';
      }
			$retval = mysqli_query($conn,$sql);

			if(! $retval ) {
			  die('Could not get data: ' . mysqli_error());
			  echo '<p>Error: Could not get data </p>';
			}

			else{
        if(isset($_GET['result'])) {
          $color="green";
          if($_GET['result']!="Your file was uploaded successfully."){
            $color="orange";
          }

          ?>
          <p style="color:<?php echo $color ?>;font-weight: bold;"><br><br><?php print_r($_GET['result'])?></p>
        <?php } ?>
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
                  <td style='border:none;'>
                  <form action='editRecord.php' method='post'>
                  <input type='hidden' name='serialid' value=\"{$row['SERIALID']}\" />
                  <input type='hidden' name='prodnum' value=\"{$row['PRODNUM']}\" />
                  <input type='hidden' name='userid' value=\"{$row['USERID']}\" />
                  <input type='submit' value='Edit' style='width:100%;'/>
                  </form>
                  </td>
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