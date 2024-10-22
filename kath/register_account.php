<?php
//Call connection string
include('database/connection.php');

if(isset($_POST['register']))
{
   //Prepare all the variables 
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   //Sanitized username
   $username = $conn->real_escape_string($_POST['username']);
   $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
   $role = "client";

   //Check if username is already exist
   $check_sql = "SELECT username FROM users WHERE username='$username'";
   //Execute SQL
   $result = $conn->query($check_sql);
   
   if($result->num_rows > 0)
   {
        header("Location: register.php?message=Username is already exist, please choose another one");
   }
   else
   {
        //Username is available proceed to registration
        $sql = "INSERT INTO users (`ID`, `firstname`, `lastname`, `username`, `password`, `role`)
        VALUES (null, '$firstname', '$lastname', '$username', '$password', '$role')";

        if($conn->query($sql) === TRUE)
        {
            header('Location: index.php');
        }
        else{
            echo "Error ".$sql."<br>".$conn->error;
        }
   }
}

?>