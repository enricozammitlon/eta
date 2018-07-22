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
                        <form action='upload.php' method='post' enctype='multipart/form-data'>
                          <input type='file' id='files' name='files[]' multiple />
                          <output id='list'></output>
                        </form>
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
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {
            // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>
	<?php include_once('footer.php');?>