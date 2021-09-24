<?php
  session_start();
  session_regenerate_id(true);
  if(!isset($_SESSION['AdminLoginId'])){
      header("location:admin.php");
  }
  ?>
  <?php
  include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/7450de4497.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles1.css">
    
    <title>Sri Maruthi Pharma</title>
    <style type="text/css">
		body {
  font-family: "Lato", sans-serif;
}

    </style>
    </head>
    <body class="sectionuser">

      <nav class="nav main-nav myheader sticky" id="myheader1">
      <ul>
      <li style="float:left;"> <img src="tielogo.jpg" alt="Not Connected" width="45px" ></li>
      <li style="padding-right:27px;"><?php echo $_SESSION['AdminLoginId']?></li>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
      <li><button name="Back" style="font-size:20px; padding:10px; border-radius:10px; " class="logout">Logout <i class="fa fa-arrow-right"></i></button></li>
            </form>
			      
        </ul>
    </nav>
    <br><br><br><br>
<section >

    <div class="srch">
		<form class="navbar-form" method="post" name="user-form">
			
				<input class ="form-control" type="text" name="search" placeholder="Search User" required="">
				<button  type="submit" name="submit" class="btn btn-default">
				<span class="glyphicon glyphicon-search">Search</span>	
					
				</button>
			
			</form>
			<form class="navbar-form1" method="post" name="form1">
			
				<input class ="form-control" type="text" name="ID" placeholder="Enter ID" required="">
				<button  type="submit" name="submit1" class="btn1 btn-default">Delete	
					
				</button>
			<br>
			</form>
	</div>

        <h2 style="text-align:center; color:white;">LIST OF USERS</h2>
        <br>
       <div class="users"> <?php
        	if(isset($_POST['submit']))
            {
                $q=mysqli_query($db,"SELECT * from `contactus` where FullName like '%$_POST[search]%' ");
                if(mysqli_num_rows($q)==0)
                {
                    echo "Sorry! User not found. try searching again.";
                }
                else{

                    echo "<table border-color:1px solid black;width:100%'>";
                    echo "<tr >";
                    echo "<th>"; echo "ID"; echo "</th>";
                    echo "<th>"; echo "FullName"; echo "</th>";
                    echo "<th>"; echo "PhoneNumber"; echo "</th>";
                    echo "<th>"; echo "Email"; echo "</th>";
                    echo "<th>"; echo "Message"; echo "</th>";
                    echo "</tr>";
                    while($row=mysqli_fetch_assoc($q))
                    {
                        echo "<tr>";
                        echo "<td>"; echo $row['ID']; echo "</td>";
                        echo "<td>"; echo $row['FullName']; echo "</td>";
                        echo "<td>"; echo $row['PhoneNumber']; echo "</td>";
                        echo "<td>"; echo $row['Email']; echo "</td>";
                        echo "<td>"; echo $row['Message']; echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                }

            }
            /*if button is pressed*/
            else{
                 $res=mysqli_query($db,"SELECT * FROM `contactus`  ORDER BY `contactus`.`FullName` ASC;");
        echo "<table border-color:2px solid black;width:100%'>";
        echo "<tr style='background-color:#2e964ce6;'>";
        echo "<th>"; echo "ID"; echo "</th>";
        echo "<th>"; echo "FullName"; echo "</th>";
        echo "<th>"; echo "PhoneNumber"; echo "</th>";
        echo "<th>"; echo "Email"; echo "</th>";
        echo "<th>"; echo "Message"; echo "</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($res))
        {
            echo "<tr>";
            echo "<td>"; echo $row['ID']; echo "</td>";
            echo "<td>"; echo $row['FullName']; echo "</td>";
            echo "<td>"; echo $row['PhoneNumber']; echo "</td>";
            echo "<td>"; echo $row['Email']; echo "</td>";
            echo "<td>"; echo $row['Message']; echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    if(isset($_POST['submit1']))
        {
            
                mysqli_query($db,"DELETE FROM `contactus` WHERE `ID`= '$_POST[ID]';");
                ?>
                   <script type="text/javascript">
                    alert("Delete Successful.");
                   </script>
                <?php
            }
       
  ?>
  
  <?php
  if(isset($_POST['Back']))
  {
      session_destroy();
      header("location:index.html");
  }
  ?>
   </div>
    </section>

       
    
    </body>
    </html>