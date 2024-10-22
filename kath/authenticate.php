<?php
//include database connection file
include('database/connection.php');
//start a session to manage user data
session_start();
//check if the form is submitted using login button
if(isset($_POST['login']))
{
    //sanitize the username input to prevent sql injection
    $username=$conn->real_escape_string($_POST['username']);
    //get password (note:not yet encrypted)
    $password=$_POST['password'];
    //SQL query to select username from database
    $sql_username="SELECT * FROM users WHERE username='$username'";
    //execute query
    $result=$conn->query($sql_username);

    //check if the query returned any results
    if($result->num_rows >0){
        //fetch all associated records base on username
        $row= $result->fetch_assoc();
        //verify the provided password against hash password
        if(password_verify($password, $row['password'])){
            //password is incorrect, set session variables
            $_SESSION['username']=$username;
            $_SESSION['role']=$row['role'];
            //redirect the user to appropriate dashboard
            if($row['role']=='admin'){
                header("Location:admin_dashboard.php");
            }
            else if($row['role']=='client'){
                header("Location:client_dashboard.php");
            }
        }
        else{
        header("Location: index.php?incorrect");   //babalik sa location kapag nag false
        }
    }
    else{
        header("Location: index.php?incorrect");
    }
}
else
{
    header("Location: index.php");
}
?>