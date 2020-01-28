<?php
require_once "../php/config.php";
$error= trim($_GET["error"]);  
$id= trim($_GET["id"]);  
$return= trim($_GET["return"]);    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
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
                        <h1>Error</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype='multipart/form-data'>
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value=""/>
                            <p>An Error Occured <br> Error : <?php echo ($error);?></p><br>
                            <p>
                                
                                <a href="<?php echo ($return);?> ?id=<?php echo ($id);?>" class="btn btn-danger">Back</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>