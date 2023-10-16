
<?php
include 'dbc.php';
 $pagetitle="Staff's Registration Page";
 include "includes/header3.php";

error_reporting(E_ALL ^ E_DEPRECATED);

$err = array();
					 
if(isset($_POST['submit'])) 
{ 
/******************* Filtering Input *****************************
This code filters harmful script code and escapes data of all POST data
from the user submitted form.
*****************************************************************/
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}

 
/************************ SERVER SIDE VALIDATION **************************************/
/********** This validation is useful if javascript is disabled in the browswer ***/

if(empty($data['full_name']) || strlen($data['full_name']) < 4)
{
$err[] = "ERROR - Invalid name. Please enter atleast 3 or more characters for your name";
//header("Location: register1.php?msg=$err");
//exit();
}



// Validate Email
if(!isEmail($data['usr_email'])) {
$err[] = "ERROR - Invalid email address.";
//header("Location: register1.php?msg=$err");
//exit();
}
// Check User Passwords
if (!checkPwd($data['pwd'],$data['pwd2'])) {
$err[] = "ERROR - Invalid Password or mismatch. Enter 5 chars or more";
//header("Location: register1.php?msg=$err");
//exit();
}
	  
$user_ip = $_SERVER['REMOTE_ADDR'];

// stores sha1 of password
$sha1pass = PwdHash($data['pwd']);

// Automatically collects the hostname or domain  like example.com) 
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');


$usr_email = $data['usr_email'];
$user_name = $data['user_name'];

/************ USER EMAIL CHECK ************************************
This code does a second check on the server side if the email already exists. It 
queries the database and if it has any existing email it throws user email already exists
*******************************************************************/

$rs_duplicate = mysqli_query($db,"select count(*) as total from users where user_email='$usr_email' OR user_name='$user_name'") or die(mysqli_error());
list($total) = mysqli_fetch_row($rs_duplicate);

if ($total > 0)
{
$err[] = "ERROR - The username/email already exists. Please try again with different username and email.";
//header("Location: register1.php?msg=$err");
//exit();
}
/***************************************************************************/

if(empty($err)) {

$sql_insert = "INSERT into users
  			(full_name,user_email,pwd,tel,date,users_ip,approved,banned,user_name,program
			)
		    VALUES
		    ('$data[full_name]','$usr_email','$sha1pass','$data[tel]',now(),'$user_ip','1','3','$user_name','$data[program]'
			)
			";
			
mysqli_query($db,$sql_insert) or die("Insertion Failed:" . mysqli_error($db));
$user_id = mysqli_insert_id($db);  
$md5_id = md5($user_id);
mysqli_query($db,"update users set md5_id='$md5_id' where id='$user_id'");
	echo "<h3>Thank You</h3> We received your submission.";


header("Location: thankyou.php");  
  exit();
 }					 

}
?>  
 
     
<div class="container">

               <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 20px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Registration/Sign Up</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
<?php 
	 if (isset($_GET['done'])) { ?>
	  <h2>Thank you</h2> Your registration is now complete and you can <a href="login.php">login here</a>";
	 <?php exit();
	  }
	?>
 <?php	
	 if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "* $e <br>";
	    }
	  echo "</div>";	
	   }
	 ?> 

<div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <p align="center">Registration Form</p></h3>
                    </div>
                    <div class="panel-body">

  <form action="register1.php" method="post" name="regForm" id="regForm"  >
	<div class="form-group">
		<label for="full_name" > Full Name (*)</label>
		<input class="form-control"  required id="full_name" name="full_name" type="text" >
               	</div>
	<div class="form-group">
		<label for="tel" > Phone/Mob. (*)</label>
		<input class="form-control"  required id="tel" name="tel" type="text" >
          	</div>
                	<div class="form-group">
		<label for="user_name" > Employee ID(*)</label></td>
		<td><input class="form-control"  required id="user_name" name="user_name" type="text" >
                	</div>
	<div class="form-group">
		<label for="user_name" > Your SAKEC Email(*)</label></td>
		<td><input class="form-control"  required id="usr_email" name="usr_email" type="email" ><span class="example">** Valid email please..</span>
                	</div>
	<div class="form-group">
            		<label for="program">Program(*)</label>
           		<select  class="form-control" name="program"  required id="program" name="program">
          		<option></option>
           		<option >Computer</option>
           		<option >I.T.</option>
           		<option >EXTC</option>
           		<option >ETRX</option>
          		</select>
          	</div>	
                	<div class="form-group">
                                    <label for="pwd" > Password(*)</label></td>
		<td><input class="form-control"  required id="pwd" name="pwd" type="password" ><span class="example">** 5 chars minimum..</span>
                	</div>
	<div class="form-group">
                                    <label for="pwd" > Retype Password(*)</label></td>
		<td><input class="form-control"  required id="pwd2" name="pwd2" type="password" equalto="#pwd" >
                	</div>                                

                                <button type="sumbit" name="submit" value="register" class="btn btn-lg btn-success btn-block">Register</button>  
                        </form>

	      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<?php include "includes/footer.php"; ?>
