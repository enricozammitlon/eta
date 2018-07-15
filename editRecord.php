	<?php include_once('header.php');?>
	  <div class="all-content">
	    <div class="left-admin-menu">
	    <?php include_once('admin-menu.php');?>
	    </div>
	    <div class="main-content">
	    <?php 
		    if($_SERVER["REQUEST_METHOD"] == "POST"){
    			$sql = 'SELECT * FROM items WHERE SERIALID =\''.$_POST["serialid"].'\' AND PRODNUM = \''.$_POST["prodnum"].'\'';
    			$retval = mysqli_query($conn,$sql);
    			if(! $retval ) {
    			  die('Could not get data: '.mysqli_error());
    			}
    			else {?>
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
                      <form action='updateRecord.php' method='post'>
                      <tr>
                      <td contenteditable><input name='serialid'/>{$row['SERIALID']}</td>
                      <td contenteditable><input name='prodid'/>{$row['PRODNUM']}</td>
                      <td contenteditable><input name='name'/>{$row['NAME']}</td>
                      <td contenteditable><input name='userid'/>{$row['USERID']}</td>
                      <td><input type='submit' value='Save'/></td>
                      </tr>
                      </form>
                      ";
                  }
                ?>
              </tbody>
            </table>
    				<?php
    			}
        }
        elseif($_SERVER["REQUEST_METHOD"] == "GET"){?>
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
            <tr>
            <form action='updateRecord.php' method='post'>
            <td contenteditable><input name='serialid'/></td>
            <td contenteditable><input name='productid'/></td>
            <td contenteditable><input name='name'/></td>
            <td contenteditable><input name='userid'/></td>
            <input type='submit' value='Save'/>
            </form>
            </tr>
          </tbody>
        </table>
      <?php }?>
	    </div>
	  </div>

	<?php include_once('footer.php');?>