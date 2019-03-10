

    <?php

    function testUploadFiles($conn){

        $targetFolder = "uploads";
        $errorMsg = array();
        $successMsg = array();
         

        // Count # of uploaded files in array
        $total = count($_FILES['upload']['name']);

        // Loop through each file
        for( $i=0 ; $i < $total ; $i++ ) {

          //Get the temp file path
          $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

          //Make sure we have a file path
          if ($tmpFilePath != ""){
            //Setup our new file path
            $breakImgName = explode(".",$_FILES['upload']['name'][$i]);
            $imageOldNameWithOutExt = $breakImgName[0];
            $imageOldExt = $breakImgName[1];

            $newFileName = strtotime("now")."-".str_replace(" ","-",strtolower($imageOldNameWithOutExt)).".".$imageOldExt;

            
            $targetPath = $targetFolder."/".$newFileName;
            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $targetPath)) {

              $sql = 'INSERT INTO uploads (location,prodid,serialid) VALUES (\''.$targetPath.'\',
                \''.$_POST["prodid"].'\',
                \''.$_POST["serialid"].'\')'; 

              $rs  = mysqli_query($conn, $sql);

              if($rs)
              {
                  $successMsg[$i] = "Image is uploaded successfully";
              }
              else
              {
                  $errorMsg[$i] = "Unable to save ".$_FILES['upload']['name'][$i]." file ";
              }
            }
          }
        }
      return [$errorMsg,$successMsg];

    }



    // Check if the form was submitted
    function uploadFiles(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            // Check if file was uploaded without errors

            if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){

                $filename = $_FILES["photo"]["name"];

                $filetype = $_FILES["photo"]["type"];

                $filesize = $_FILES["photo"]["size"];

            

                // Verify file extension

                $ext = pathinfo($filename, PATHINFO_EXTENSION);      

                // Verify file size - 5MB maximum

                $maxsize = 5 * 1024 * 1024;

                if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

                    // Check whether file exists before uploading it

                if(file_exists("uploads/" . $_FILES["photo"]["name"])){

                    return $_FILES["photo"]["name"] . " already exists.";

                } else{

                    move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $_FILES["photo"]["name"]);

                    return "Your file was uploaded successfully.";

                } 

            } else{

                return "Error: There was a problem uploading your file. Please try again.";

            }

        }
    }

    ?>

