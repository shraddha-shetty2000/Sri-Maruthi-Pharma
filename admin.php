<?php
require("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<style>
    *{
        padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;  
    }
    body{
        background-color: #5e5e5e;
    }
</style>
<body>
    <div class="containeer">
        <div class="myform1">
            <form method="POST" action="<?php echo htmlspecialchars(  $_SERVER['PHP_SELF'])?>">
                <h2 style="padding-left: 53px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">ADMIN LOGIN</h2>
                <input type="text" placeholder="Admin Name" style="text-align: center;" name="AdminName">
                <input type="password" placeholder="Password" style="text-align: center;" name="AdminPassword">
                <button type="Submit" name="Login">LOGIN</button>
             </form>

        </div>
       <div class="myimage">
           <img src="https://cdn1.macworld.co.uk/cmsdata/features/3535328/mbp_2016_lifestyle05_thumb800.jpg" alt="Not Connected" width="518px" height="400px" style="border-radius: 10px;">

       </div>
   
    </div>
<?php
function input_filter($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
} 
if(isset($_POST['Login']))
{
   $AdminName=input_filter($_POST['AdminName']);
   $AdminPassword=input_filter($_POST['AdminPassword']);
  $AdminName= mysqli_real_escape_string($db,$AdminName);
  $AdminPassword= mysqli_real_escape_string($db,$AdminPassword);
   $query="SELECT * FROM `admin` WHERE Admin_Name=? AND Admin_Password=?";
 if( $stmt= mysqli_prepare($db,$query) )
 {
    mysqli_stmt_bind_param($stmt,"ss",$AdminName,$AdminPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt)==1)
    {
     session_start();
     $_SESSION['AdminLoginId']=$AdminName;
     header("location:user.php");
    }
    else{
        echo "<script> alert('Invalid Admin Name or Password');</script>";
    }
    mysqli_stmt_close($stmt);
 }
 else{
     echo "<script>alert('SQL Query cannot be prepared');</script>";
 }
}
?>
</body>
</html>