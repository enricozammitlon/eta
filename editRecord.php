  <?php include_once('header.php');?>
	  <div class="all-content">
	    <div class="left-admin-menu">
	    <?php include_once('admin-menu.php');?>
	    </div>
	    <div class="main-content">
	    <?php 
        $statuses=array(
          'faulty'=>'Faulty',
          'awaitingQuote'=>'Awaiting Quote',
          'sentRepairs'=>'Sent for Repairs',
          'receivedRepairs'=>'Received from Repairs',
          'awaitingTesting'=>'Awaiting Testing',
          'servicible'=>'Servicible',
          'workingInPos'=>'Working In Position'
        );
		    if($_SERVER["REQUEST_METHOD"] == "POST"){
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
                  $output="";
                  if($row = mysqli_fetch_assoc($retval)) {
                    $output.= "
                    <div class='table-edit'>
                    <form action='updateRecord.php' method='post' enctype='multipart/form-data'>
                      <div class='first-half'>
                        <div class='row'>
                          <label for='serialid' class='left-align'>Serial ID</label>
                          <input name='serialid' type='text' class='left-align' value='{$row['SERIALID']}'>
                        </div>
                        <div class='row'>
                          <label for='prodid' class='left-align'>Product ID</label>
                          <input name='prodid' type='text' class='left-align' value='{$row['PRODNUM']}'>
                        </div>
                        <div class='row'>
                          <label for='name' class='left-align'>Name</label>
                          <input name='name' type='text' class='left-align' value='{$row['NAME']}'>
                        </div>
                        <div class='row'>
                          <label for='location' class='left-align'>Location</label>
                          <input name='location' type='text' class='left-align' value='{$row['LOCATION']}'>
                        </div>
                        <div class='row description'>
                          <label for='description' class='left-align'>Description</label>
                          <input name='description' type='text' class='left-align' value='{$row['DESCRIPTION']}'>
                        </div>
                        <div class='row'>
                          <label for='status' class='left-align'>Status</label>
                          <select name='status' class='left-align'>
                            <option value='{$row['STATUS']}' selected='selected'>{$row['STATUS']}</option>";
                            foreach ($statuses as $key => $value) {
                              if($value!=$row['STATUS']){
                                $output.="<option value='$key'>$value</option>";
                              }
                            }
                            $output.="</select> 
                        </div>
                        <input class='saveB' type='submit' value='Save'/>
                      </div>
                      <div class='second-half' id='second-half'>
                        <button type='button' id='reset'>Reset Uploads</button>
                        <input type='file' id='files' name=\"upload[]\" multiple/>
                        <ul>
                        ";
                        $sql = 'SELECT * FROM uploads WHERE serialid =\''.$row['SERIALID'].'\' AND prodid = \''.$row['PRODNUM'].'\';';
                        $retval = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($retval)) {
                          $output.="<li>".$row['location']."</li>";
                        }
                      $output.="</ul><ul id='list'>
                      </ul>
                      </div>
                      <input name='date' type='hidden' value='{$row['FAULTDATE']}'>            
                      <input type='hidden' name='prevserialid' value='{$row['SERIALID']}'/>
                      <input type='hidden' name='prevprodnum' value='{$row['PRODNUM']}'/>
                      </form>
                      </div>
                      ";
                  echo $output;
                  }
                ?>
    				<?php
    			}
        }
        elseif($_SERVER["REQUEST_METHOD"] == "GET"){?>
          <div class='table-edit'>
          <form action='updateRecord.php' method='post'>
            <div class='first-half'>
            <div class='row'>
              <label for='serialid' class='left-align'>Serial ID</label>
              <input name='serialid' type='text' class='left-align' value=''>
            </div>
            <div class='row'>
              <label for='prodid' class='left-align'>Product ID</label>
              <input name='prodid' type='text' class='left-align' value=''>
            </div>
            <div class='row'>
              <label for='name' class='left-align'>Name</label>
              <input name='name' type='text' class='left-align' value=''>
            </div>
            <div class='row'>
              <label for='location' class='left-align'>Location</label>
              <input name='location' type='text' class='left-align' value=''>
            </div>
            <div class='row'>
              <label for='description' class='left-align'>Description</label>
              <input name='description' type='text' class='left-align' value=''>
            </div>
            <div class='row'>
              <label for='status' class='left-align'>Status</label>
              <select name='status' class='left-align'>
              <?php  foreach ($statuses as $key => $value) {?>
                <option value=<?php echo $key ?> > <?php echo $value ?> </option>
                <?php } ?>
              </select>
            </div>
            <input name='new-record' type='hidden' value='1'>
            <input class='saveB' type='submit' value='Save'/>
          </div>
            <div class='second-half' id='second-half'>
              <button type='button' id='reset'>Reset Uploads</button>
              <input type='file' id='files' name=\"upload[]\" multiple/>
              <ul id='list'></ul>
            </div>
          </form>
        </div>
      <?php }?>
	    </div>
	  </div>

<script>
  function handleFileSelect(evt) {
    document.getElementById('list').innerHTML="";
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {
            // Only process image files.
        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onload = (function(theFile) {
          return function(e) {
            // Render thumbnail.
            var span = document.createElement('span');
            span.innerHTML = ['<li>', escape(theFile.name), '</li>'].join('');
            document.getElementById('list').append(span);
          };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
  }
  function resetUploads(evt){
    document.getElementById('list').innerHTML="";
    document.getElementById('files').value = "";
  }
  document.getElementById('files').addEventListener('change', handleFileSelect, false);
  document.getElementById('reset').addEventListener('click', resetUploads, false);

</script>
	<?php include_once('footer.php');?>