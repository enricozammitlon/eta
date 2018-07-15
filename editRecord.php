	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
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
                     <div class='row margin'>
                        <div class='input-field col s12'>
                          <i class='mdi-social-person-outline prefix'></i>
                          <input id='serialid' type='text' class='validate' value='{$row['SERIALID']}'>
                          <label for='serialid' class='center-align'>Serial ID</label>
                        </div>
                      </div>
                      <div class='row margin'>
                        <div class='input-field col s12'>
                          <i class='mdi-communication-email prefix'></i>
                          <input id='prodid' type='text' class='validate' value='{$row['PRODNUM']}'>
                          <label for='prodid' class='center-align'>Product ID</label>
                        </div>
                      </div>
                      <div class='row margin'>
                        <div class='input-field col s12'>
                          <i class='mdi-action-lock-outline prefix'></i>
                          <input id='name' type='text' class='validate' value='{$row['NAME']}'>
                          <label for='name'>Name</label>
                        </div>
                      </div>
                      <div class='row margin'>
                        <div class='input-field col s12'>
                          <i class='mdi-action-lock-outline prefix'></i>
                          <input id='userid' type='text' value='{$row['USERID']}'>
                          <label for='userid'>User ID</label>
                        </div>
                      </div>
                      <input type='submit' value='Save'/>
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