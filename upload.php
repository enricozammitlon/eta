<?php

$uploadDir = "/uploads";
$permitted = array('image/jpeg', 'image/jpeg', 'image/png', 'image/gif');               

$fileName  = $_FILES['image']['name'];
$tmpName   = $_FILES['image']['tmp_name'];
$fileSize  = $_FILES['image']['size'];
$fileType  = $_FILES['image']['type'];

// make a new image name
$ext = substr(strrchr($fileName, "."), 1);
// generate the random file name
$randName = md5(rand() * time());

// image name with extension
$myFile = $randName . '.' . $ext;
// save image path
$path = $uploadDir . $myFile;
if (in_array($fileType, $permitted)) 
{
    $result = move_uploaded_file($tmpName, $path);
        if (!$result) 
        {
                echo "Error uploading image file";
                exit;
        } 
        else 
        {                           
            // keep track post values
            $name = $_POST['name'];
            $description = $_POST['description'];
            // update data
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE food set name = ?, image = ?, path = ?, description = ? 
                    WHERE id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($name,$myFile,$path,$description,$id));
                Database::disconnect();
                echo "<code>Information updated!!</code>";
        } 
    }
?>