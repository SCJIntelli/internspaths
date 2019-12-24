<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";


// Define variables and initialize with empty values
$username = $email= $name= $mnumber="";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = trim($_SESSION["id"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $name = trim($_POST["name"]);
    $mnumber = trim($_POST["mnumber"]);


    ///////search for user name
    $sql = "SELECT id FROM admindata WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
        $param_username = $username;
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
                $sql = "UPDATE admindata SET name =?, mobile=? WHERE username=?";
                if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sss", $param_name,$param_mnumber,$param_username);

            // Set parameters
                    $param_username = $username;
                    $param_email = $email;
                    $param_name = $name;
                    $param_mnumber=$mnumber;
                    $param_id=$id;


            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                        $_SESSION["name"]=$name;
                        $_SESSION["mnumber"]=$mnumber;
                        header("location: adminwelcome.php");

                    } else{
                        echo "Error: " . $sql . "<br>" . mysqli_error($link);
                    }
                }

        // Close statement
                mysqli_stmt_close($stmt);


    // Close connection
                mysqli_close($link);

            }
            else{
                $sql = "INSERT INTO admindata (id,username,email,name,mobile) VALUES (?, ?,?,?,?)";

                if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "issss", $param_id, $param_username,$param_email,$param_name,$param_mnumber);

            // Set parameters
                    $param_username = $username;
                    $param_email = $email;
                    $param_name = $name;
                    $param_mnumber=$mnumber;
                    $param_id=$id;


            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                        $_SESSION["name"]=$name;
                        $_SESSION["mnumber"]=$mnumber;
                        header("location: adminwelcome.php");

                    } else{
                        echo "Error: " . $sql . "<br>" . mysqli_error($link);
                    }
                }

        // Close statement
                mysqli_stmt_close($stmt);
            }

    // Close connection
            mysqli_close($link);

        }

    }
}
?>