<?php 
if(!checkAdmin()){ 
header("Location: login.php");
exit();}
 $user_program = $_SESSION['user_program'];
?>
<!DOCTYPE html>
<html lang="en">

    <head>         
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $pagetitle; ?></title>
        
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css'>
        <link href="css/semantic.min.css" rel="stylesheet">
        <link href="css/templatemo_style.css"  rel='stylesheet' type='text/css'>
        <link href="css/mystyle.css"  rel='stylesheet' type='text/css'> 
        <link rel="icon" type="image/jpeg" href="logo.jpeg">
       
    </head>   
    <body style="background-color: #80bfff;">
        <div class="templatemo-top-menu">
            <div class="container">
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
                                <a href="home.php" class="navbar-brand"><img src="image/logo.jpeg" alt="SAKEC" title=" SAKEC HOME" /></a>
				
                        </div>
                        <div class="navbar-collapse collapse" id="templatemo-nav-bar" class="external-link">
                            <ul class="nav navbar-nav navbar-nav navbar-nav navbar-right" style="margin-top: 40px;"  role="menu" aria-labelledby="dropdownMenu" aria-expanded="false">
                                 <li><h3 class="titlehdr">Login as:<?php echo $_SESSION['user_name'];?></h3> </li>
	  <?php	
      if (isset($_GET['msg'])) {
	  echo "<div class=\"error\">$_GET[msg]</div>";
	  }
	  	  
	  ?><br></br>
								<li><a href="home.php" class="external-link">Home</a></li>
                                <li><a href="student.php" class="external-link">Students</a></li>
                                <li><a href="teacher.php" class="external-link">Teachers</a></li>
                                <li><a href="logout.php" class="external-link" >Log Out</a></li>
                             </ul>
                        </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </div><!--/.navbar -->
            </div> <!-- /container -->
        </div>