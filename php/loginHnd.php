<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["usertype"]=="Student"){
        header("location: studentwelcome.php");
        exit;
    }
    if($_SESSION["usertype"]=="Company"){
        header("location: companywelcome.php");
        exit;
    }
    if($_SESSION["usertype"]=="Admin"){

        header("location: adminwelcome.php");
        exit;
    }
    
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $usertype= "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, usertype,email FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $usertype , $email);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; 
                            $_SESSION["usertype"] = $usertype;
                            $_SESSION["email"] = $email;

                            
                            // Redirect user to welcome page
                            if($_SESSION["usertype"]=="Student"){
                                header("location: studentwelcome.php");
                                exit;
                            }
                            if($_SESSION["usertype"]=="Company"){
                                header("location: companywelcome.php");
                                exit;
                            }
                            if($_SESSION["usertype"]=="Admin"){
                                $sql = "SELECT name, mobile, profileurl FROM admindata WHERE username='$username'";
                                $result = mysqli_query($link, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $_SESSION["name"]=$row["name"];
                                $_SESSION["mnumber"] =$row["mobile"]; 
                                $_SESSION["profileurl"]=$row["profileurl"]; 
                                mysqli_close($link);     
                                header("location: adminwelcome.php");
                                exit;}
                            } 
                            else{
                            // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else{
                    // Display an error message if username doesn't exist
                        $username_err = "No account found with that username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
        // Close statement
            mysqli_stmt_close($stmt);
        }
        
    // Close connection
        mysqli_close($link);
    }
    ?>