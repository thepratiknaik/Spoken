<?php 
include 'dbc.php';
page_protect();

 $pagetitle="Home Page";

	  
/*********************** MYACCOUNT MENU ****************************
This code shows my account menu only to logged in users. 
Copy this code till END and place it in a new html or php where
you want to show myaccount options. This is only visible to logged in users
*******************************************************************/
if (isset($_SESSION['user_id'])) {
if(checkAdmin()){ 
include "includes/header.php";
      include "includes/slider.php";
}
else if (isset($_SESSION['user_id'])){
/*******************************END**************************/
include "includes/header2.php";
      include "includes/slider.php";
 } }
?>

    
<?php include "includes/footer.php"; ?>