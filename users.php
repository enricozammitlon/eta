<?php 
session_start();
  include_once('header.php');
  if($_SESSION['isAdmin']){
  ?>
	<div class="all-content">
	    <div class="left-admin-menu">
	    <?php include_once('admin-menu.php');?>
	    </div>
	    <div class="main-content">
        <h2>All Items</h2>
		<?php
			$sql = 'SELECT * FROM users ';
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
              <th>User ID</th>
              <th>Name</th>
              <th>Surname</th>
              <th>Position</th>
              <th>Is Admin?</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_assoc($retval)) {
                echo "
                  <tr>
                  <td>{$row['USERID']}</td>
                  <td>{$row['NAME']}</td>
                  <td>{$row['SURNAME']}</td>
                  <td>{$row['POSN']}</td>
                  <td>{$row['ISADMIN']}</td>
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
<?php }
echo "<script type='text/javascript'>alert('Action needs admin account!');</script>";
include_once('footer.php');?>