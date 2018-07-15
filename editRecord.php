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
                  <th>Product ID</th>/editRecord.php
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
                      <input name='serialid'/>{$row['SERIALID']}
                      <input name='prodid'/>{$row['PRODNUM']}
                      <input name='name'/>{$row['NAME']}
                      <input name='userid'/>{$row['USERID']}
                      <input type='submit' value='Save'/>
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