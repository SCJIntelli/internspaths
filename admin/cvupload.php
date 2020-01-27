<?php
// Process delete operation after confirmation
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);

    require_once "../php/config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
$param_cvurl="#";
$target_dir = "../cvuploads/";
$extension = pathinfo($_FILES["cvToUpload"]["name"], PATHINFO_EXTENSION);
$fname = 2;
$target_file = $target_dir . $fname.".".$extension;
$uploadOk = 1;
$pdf_error="";
$pdfFileType = strtolower(pathinfo($_FILES["cvToUpload"]["name"], PATHINFO_EXTENSION));


// if ($_FILES["fileToUpload"]["size"] > 9000000) {
//     $pdf_error= + "Sorry, your file is too large.";
//     $uploadOk = 0;
// }

// if($pdfFileType != "pdf" && $pdfFileType != "docx" ) {
//     $pdf_error= +"Sorry, only PDF & Docx files are allowed.";
//     $uploadOk = 0;
// }

//////////////////////////////upload PDF //////////////////////////
if ($uploadOk == 0) {
    echo $pdf_error;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["cvToUpload"]["tmp_name"], $target_file)) {
        $param_cvurl=$target_file;
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        // $uploadOk=0;
        echo $pdf_error;
        
    }
}
       } 
    // Prepare a delete statement
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Upload CV</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype='multipart/form-data'>
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value=""/>
                            <div class="item form-group">
    <label class="col-form-label col-md-3 col-sm-3 label-align" >Upload CV <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 ">
     <input type="file" name="cvToUpload" id="cvToUpload">
 </div>
</div>
                            <p>Are you sure you want to add this CV?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="manageadmin.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>