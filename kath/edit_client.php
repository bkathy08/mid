<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['role']!='admin'){
   
    header("Location: index.php"); 
    exit();
}
   //include connection string
   include ('database/connection.php');
   //check if client ID  is provided in the URL

   if(isset($_GET['ID']))
   {

      $client_ID = $_GET['ID'];
      //fetch the current client data 
      $sql  = "SELECT * FROM users WHERE ID =  '$client_ID'";
      $result = $conn->query($sql);
      //check if the client is exists
      if($result->num_rows > 0)
      {

        $row = $result->fetch_assoc();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $role = $row['role'];
      }
   }
   else 
   {       //No Client ID redirect to admin dashboard
            header("Location: admin_dashboard.php"); 
   }

   //UPDATAE FUNCTION 
   if(isset($_POST['update']))
   {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];
    //update the user data in the db
    $update_sql="UPDATE users SET
    firstname = '$firstname',
    lastname = '$lastname',
    role = '$role'
    WHERE ID = '$client_ID'";
    if($conn->query($update_sql) === TRUE)
    {
     header("Location: admin_dashboard.php?ClientUpdateSucccess");

    }
    else{
        echo "Error Updating Client: ".$conn->error;
    }

   }

      ?>

      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>Document</title>
      </head>
      <body>
             <h2>Edit Client Information</h2>
             <form action="" method="post">
                Firstname
                <input type="text" name="firstname" id="" 
                required value="<?php echo $firstname; ?>"> <br>
                Lastname
                <input type="text" name="lastname" id="" 
                required value="<?php echo $lastname; ?>"> <br>
                Role
                  <select name="role" id="">
                      <option value="admin" <?php if($role == 'admin') 
                       echo 'selected';?>>Admin</option> <br>
                        <option value="client" <?php if($role == 'client') 
                       echo 'selected';?>>Client</option> <br>
                       </select> <br> <br>
                       <input type="submit" value="Update Record" name="update">
                       <br> <br>
                       
                </form>
                <a href="admin_dashboard.php">Back to Admin Dashboard</a>
      </body>
      </html>