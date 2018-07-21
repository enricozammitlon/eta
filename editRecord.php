  <?php include_once('header.php');?>
	  <div class="all-content">
	    <div class="left-admin-menu">
	    <?php include_once('admin-menu.php');?>
	    </div>
	    <div class="main-content">
	    <?php 
		    if($_SERVER["REQUEST_METHOD"] == "POST"){
          session_start();
          if($_SESSION['isAdmin']){
            $sql = 'SELECT * FROM items WHERE SERIALID =\''.$_POST["serialid"].'\' AND PRODNUM = \''.$_POST["prodnum"].'\'';  
          }
          else{
    			 $sql = 'SELECT * FROM items WHERE SERIALID =\''.$_POST["serialid"].'\' AND PRODNUM = \''.$_POST["prodnum"].'\' AND USERID=\''.$_SESSION["userID"].'\'';
          }
    			$retval = mysqli_query($conn,$sql);
    			if(! $retval ) {
    			  die('Could not get data: '.mysqli_error());
    			}
    			else {?>
                <?php
                  if($row = mysqli_fetch_assoc($retval)) {
                    echo "
                    <div class='table-edit'>
                    <form action='updateRecord.php' method='post'>
                      <div class='first-half'>
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
                          <input name='location' type='text' class='left-align' value='{$row['LOCATION']}'>
                          <label for='location' class='left-align'>Location</label>
                        </div>
                        <div class='row description'>
                          <input name='description' type='text' class='left-align' value='{$row['DESCRIPTION']}'>
                          <label for='description' class='left-align'>Description</label>
                        </div>
                        <div class='row'>
                          <input name='status' type='text' class='left-align' value='{$row['STATUS']}'>
                          <label for='status' class='left-align'>Status</label>
                        </div>
                        <input class='saveB' type='submit' value='Save'/>
                      </div>
                      <div class='second-half'>
                        <div id='drop_zone'>Drop files here</div>
                        <output id='list'></output>
                      </div>
                      <input name='date' type='hidden' value='{$row['FAULTDATE']}'>            
                      <input type='hidden' name='prevserialid' value='{$row['SERIALID']}'/>
                      <input type='hidden' name='prevprodnum' value='{$row['PRODNUM']}'/>
                      </form>
                      </div>
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
              <input name='location' type='text' class='left-align' value=''>
              <label for='location' class='left-align'>Location</label>
            </div>
            <div class='row'>
              <input name='description' type='text' class='left-align' value=''>
              <label for='description' class='left-align'>Description</label>
            </div>
            <div class='row'>
              <input name='status' type='text' class='left-align' value=''>
              <label for='status' class='left-align'>Status</label>
            </div>
            <input name='new-record' type='hidden' value='1'>
            <input type='submit' value='Save'/>
          </form>
      <?php }?>
	    </div>
	  </div>

<script>
  function handleFileSelect(evt) {
    evt.stopPropagation();
    evt.preventDefault();

    var files = evt.dataTransfer.files; // FileList object.

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          output.push('<li><strong>', escape(e.target.result), '</strong> </li>');
        };
      })(f);
    }
    var list = document.getElementById('list');
    var newcontent = document.createElement('ul');
    newcontent.innerHTML = output.join('');

    while (newcontent.firstChild) {
        list.appendChild(newcontent.firstChild);
    }
  }

  function handleDragOver(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
  }

  // Setup the dnd listeners.
  var dropZone = document.getElementById('drop_zone');
  dropZone.addEventListener('dragover', handleDragOver, false);
  dropZone.addEventListener('drop', handleFileSelect, false);
</script>
	<?php include_once('footer.php');?>