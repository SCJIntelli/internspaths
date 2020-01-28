<?php
session_start();
require_once "../php/config.php";
$id = $_POST["id"];
$target_dir = "../uploads/";
$extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
$name = $id;
$target_file = $target_dir . $name.".".$extension;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
$img_err="";


// Check if image file is a actual image or fake image
if(!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] == UPLOAD_ERR_NO_FILE) {
    header("location: error.php?id=$id & return=editcompany.php & error=No File Selected ");
}
else{
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $img_err.= "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $img_err.="File is not an image.";
            $uploadOk = 0;
        }
    }
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $img_err.=" your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $img_err.=" only JPG, JPEG, PNG, GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $img_err.=" your file was not uploaded.";
    header("location: error.php?id=$id & return=editcompany.php & error=$img_err ");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = "UPDATE company SET profileurl =? WHERE id=?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_profileurl,$param_id);
            $param_id = $id;
            $param_profileurl=$target_file;
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
            } else{
                $img_err.="Error: " . $sql . "<br>" . mysqli_error($link);
                header("location: error.php?id=$id & return=editcompany.php & error=$img_err ");
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);


    // Close connection
        mysqli_close($link);
        header("location: editcompany.php?id=$id");

        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $img_err.="Sorry, there was an error uploading your file.";
        header("location: error.php?id=$id & return=editcompany.php & error=$img_err ");
    }
}}
?>