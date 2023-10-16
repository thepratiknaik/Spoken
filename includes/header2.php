<?php 
require_once('dbc.php');
require_once "functions.php"; 
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.dropdown-menu > li.kopie > a {
    padding-left:5px;
}
 
.dropdown-submenu {
    position:relative;
}
.dropdown-submenu>.dropdown-menu {
   top:0;left:100%;
   margin-top:-6px;margin-left:-1px;
   -webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;
 }
  
.dropdown-submenu > a:after {
  border-color: transparent transparent transparent #333;
  border-style: solid;
  border-width: 5px 0 5px 5px;
  content: " ";
  display: block;
  float: right;  
  height: 0;     
  margin-right: -10px;
  margin-top: 5px;
  width: 0;
}
 
.dropdown-submenu:hover>a:after {
    border-left-color:#555;
	background-color: #afafaf
 }

.dropdown-menu > li > a:hover, .dropdown-menu > .active > a:hover {
  text-decoration: none;
  background-color: #afafaf
}  
  
@media (max-width: 767px) {

  .navbar-nav  {
     display: inline;
  }
  .navbar-default .navbar-brand {
    display: inline;
  }
  .navbar-default .navbar-toggle .icon-bar {
    background-color: #fff;
  }
  .navbar-default .navbar-nav .dropdown-menu > li > a {
    color: red;
    background-color: #ccc;
    border-radius: 4px;
    margin-top: 2px;   
  }
   .navbar-default .navbar-nav .open .dropdown-menu > li > a {
     color: #333;
   }
   .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
   .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
     background-color: #ccc;
   }

   .navbar-nav .open .dropdown-menu {
     border-bottom: 1px solid white; 
     border-radius: 0;
   }
  .dropdown-menu {
      padding-left: 10px;
  }
  .dropdown-menu .dropdown-menu {
      padding-left: 20px;
   }
   .dropdown-menu .dropdown-menu .dropdown-menu {
      padding-left: 30px;
   }
   li.dropdown.open {
    border: 0px solid red;
   }

}
 
@media (min-width: 768px) {
  ul.nav li:hover > ul.dropdown-menu {
    display: block;
  }
  #navbar {
    text-align: center;
  }
}  
</style>

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
	  }$teacher_name = $_SESSION['user_name']; 
	  	  
	  ?><br></br>
	              <li><a href="home.php" class="external-link">Home</a></li>
				  <li><a href="teacher1.php" class="external-link">Staff Profile</a></li>
		   		  <li><a href="logout.php" class="external-link" >Log Out</a></li>
                    </ul>         
                        </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </div><!--/.navbar -->
            </div> <!-- /container -->
        </div>
		


