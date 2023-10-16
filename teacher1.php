
 <?php 
include 'dbc.php';
page_protect();
   $pagetitle="Staff Profile";
  include "includes/header2.php"; 
 $db1 = new db1(); ?>

     
<div class="container">
   
        <?php 
            $query=$db->query("select * from users where id='$_SESSION[user_id]'");
			
        ?>
          <?php while($key=$query->fetch_assoc()) {?>


                <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Staff Profile</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
                <?php if (isset($status)): ?>

      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              
      </div>


    <?php endif ?> 

<div class="form-container">

    <form method="post" role="form" action="teacher12.php?user_name=<?php echo $key['user_name']; ?>">
       <div class="container">
       <div class="row">
           <div class="col-lg-4">
           <div class="form-group">
            <label for="user_name"> Employee ID </label>
            <input type="text" name="user_name" class="form-control"  value="<?php echo $key['user_name']; ?>" required id="user_name" disabled=disabled >
          </div>
          </div>
           
	   <div class="col-lg-4">
           <div class="form-group">
            <label for="full_name"> Staff Name</label>
            <input type="text" name="full_name" class="form-control"  value="<?php echo $key['full_name']; ?>" id="full_name" disabled >
          </div>
          </div>
		</div>
        </div> <!-- col-container-->
       
	   
	   <div class="container">
       <div class="row">
           <div class="col-lg-4">
          <div class="form-group">
            <label for="user_email">Email ID</label>
            <input type="email" name="user_email" class="form-control" value="<?php echo $key['user_email']; ?>" id="user_email" disabled >
          </div>
          </div>
        
         <div class="col-lg-4">
          <div class="form-group">
            <label for="tel">Phone/Mob. No. </label>
            <input type="text" name="tel" class="form-control" value="<?php echo $key['tel']; ?>"  id="tel" disabled>
          </div>
          </div>

          <div class="col-lg-4">
          <div class="form-group">
            <label for="program">Program </label>
            <input type="text" name="program" class="form-control" value="<?php echo $key['program']; ?>" id="program" disabled>
          </div>
          </div>

     </div>
     </div><!-- col-container-->



<div class="container">
<div class="row">
          <div "form-actions"> <br><br>
         
          <a href="home.php" type="submit" class="ui mini button" name="back">Back</a>
          </div>
          </div>
	  </div>
          </div>
          </div><!-- col-container-->

       </form>
   <?php } ?>
          </div>
     </div><!--container-->	 
<?php include "includes/footer.php"; ?>