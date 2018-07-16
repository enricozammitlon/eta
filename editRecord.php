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
                        <input name='serialid' type='text' class='left-align' value='{$row['SERIALID']}'>
                        <label for='serialid' class='left-align'>Serial ID</label>
                      </div>
                      <div class='row'>
                        <input name='prodid' type='text' class='left-align' value='{$row['PRODNUM']}'>
                        <label for='prodid' class='left-align'>Product ID</label>
                      </div>
                      <div class='row'>
                        <input name='name' type='text' class='left-align' value='{$row['NAME']}'>
                        <label for='name' class='left-align'>Name</label>
                      </div>
                      <div class='row'>
                        <input name='userid' type='text' class='left-align' value='{$row['USERID']}'>
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
          <form action='updateRecord.php' method='post'>
            <div class='row'>
              <input name='serialid' type='text' class='left-align' value=''>
              <label for='serialid' class='left-align'>Serial ID</label>
            </div>
            <div class='row'>
              <input name='prodid' type='text' class='left-align' value=''>
              <label for='prodid' class='left-align'>Product ID</label>
            </div>
            <div class='row'>
              <input name='name' type='text' class='left-align' value=''>
              <label for='name' class='left-align'>Name</label>
            </div>
            <div class='row'>
              <input name='userid' type='text' class='left-align' value=''>
              <label for='userid' class='left-align'>User ID</label>
            </div>
            <input name='new-record' type='hidden' value='1'>
            <input type='submit' value='Save'/>
          </form>
      <?php }?>
	    </div>
	  </div>

	<?php include_once('footer.php');?>