
<?php
include 'dbc.php';
 $pagetitle="Log In Page";
 include "includes/header3.php";

error_reporting(E_ALL ^ E_DEPRECATED);

$err = array();

foreach($_GET as $key => $value) {
	$get[$key] = filter($value); //get variables are filtered.
}

 if (isset($_POST['submit']))
{

foreach($_POST as $key => $value) {
	$data[$key] = filter($value); // post variables are filtered
}


$user_email = $data['username'];
$pass = $data['password'];


if (strpos($user_email,'@') === false) {
    $user_cond = "user_name='$user_email'";
} else {
      $user_cond = "user_email='$user_email'";
    
}

	
$result = mysqli_query($db,"SELECT `id`,`pwd`,`full_name`,`approved`,`user_level`,`program` FROM users WHERE $user_cond AND (`banned` = '0' OR `banned` = '2') ") or die (mysqli_error($con)); // `banned` = '2' for admin
$num = mysqli_num_rows($result);

  // Match row found with more than 1 results  - the user is authenticated. 
    if ( $num > 0 ) { 
	
	list($id,$pwd,$full_name,$approved,$user_level,$program) = mysqli_fetch_row($result);
	
	
	 
		//check against salt
	if ($pwd === PwdHash($pass,substr($pwd,0,9))) { 
	if(empty($err)){			

     // this sets session and logs user in  
       session_start();
	   session_regenerate_id (true); //prevent against session fixation attacks.

	   // this sets variables in the session 
		$_SESSION['user_id']= $id;  
		$_SESSION['user_name'] = $full_name;
		$_SESSION['user_level'] = $user_level;
		$_SESSION['user_program'] = $program;
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
		$_SESSION['year'] = 2020;
		
		//update the timestamp and key for cookie
		$stamp = time();
		$ckey = GenKey();
		mysqli_query($db,"update users set `ctime`='$stamp', `ckey` = '$ckey' where id='$id'") or die(mysqli_error($con));
		
		header("Location: stm_institute_homepage.php");
		 }
		}
		else
		{
		//$msg = urlencode("Invalid Employee ID and password");
		$err[] = "Invalid Employee ID and password";
		//header("Location: login.php?msg=$msg");
		}
	} else{$result = mysqli_query($db,"SELECT `id`,`pwd`,`full_name`,`approved`,`user_level` FROM users WHERE $user_cond AND (`banned` = '1' OR `banned` = '3')"); // `banned` = '3' for new user
$num = mysqli_num_rows($result);

  // Match row found with more than 1 results  - the user is authenticated. 
    if ( $num > 0 ) {
	$err[] = "Please contact to Admin for Approve your Login.";
	}
		else {
		$err[] = "Invalid login. No such user exists";
	}	}	
}
					 
					 

?>
<div class="container">

               <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 30px;" >
                        <div class="text-center">
                         <p align="center"><h2>Welcome to Departmental Information Management System<h2>
                           </p>
                        </div>
                    </div>
                </div>
 </div>
     <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
          
 						<div class="panel-body">
                        <form role="form" method="post" action="login.php">
                                <div class="form-group">
								<?php
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages 
	  **************************************************************************/
	  if(!empty($err))  {
	  
	  foreach ($err as $e) {
	    echo "<h4>$e</h4>";
	    }
	  
	   }
	  /******************************* END ********************************/	  
	  ?>
                                    <input class="form-control" placeholder="Employee ID" required name="username" type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" required name="password" type="password" value="">
                                </div>
                               <button type="submit" name="submit" value="login" class="btn btn-lg btn-success btn-block">Login</button> <br>
<div class="form-group">
		 <p><a href="register1.php" class="btn btn-lg btn-unsuccess btn-block"> Register Me</a>
	<!--	 </font> <a href="forgot.php">Forgot Password</a> <font color="#FF6600">   -->
                  </font></p>
</div>
	            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
          
 <?php include "includes/footer.php"; ?>