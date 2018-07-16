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
                <?php
                  if($row = mysqli_fetch_assoc($retval)) {
                    echo "
                    <form action='updateRecord.php' method='post'>
                      <div class='row'>
                        <input id='serialid' type='text' class='left-align' value='{$row['SERIALID']}'>
                        <label for='serialid' class='left-align'>Serial ID</label>
                      </div>
                      <div class='row'>
                        <input id='prodid' type='text' class='left-align' value='{$row['PRODNUM']}'>
                        <label for='prodid' class='left-align'>Product ID</label>
                      </div>
                      <div class='row'>
                        <input id='name' type='text' class='left-align' value='{$row['NAME']}'>
                        <label for='name' class='left-align'>Name</label>
                      </div>
                      <div class='row'>
                        <input id='userid' type='text' class='left-align' value='{$row['USERID']}'>
                        <label for='userid' class='left-align'>User ID</label>
                      </div>
                      <input type='submit' value='Save'/>
                      </form>
                      ";
                  }
                ?>
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
            <input type='hidden' name='serialid'/>
            <input type='hidden' name='productid'/>
            <input type='hidden' name='name'/>
            <input type='hidden' name='userid'/>
            <input type='submit' value='Save'/>
            </form>
            </tr>
          </tbody>
        </table>
      <?php }?>
	    </div>
	  </div>

	<?php include_once('footer.php');?>