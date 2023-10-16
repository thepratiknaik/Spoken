
<?php
	include 'dbc.php';
	page_protect();
	$pagetitle="Staff Records";
	include "includes/header.php"; 
	include "includes/functions.php"; 
	$db1 = new db1(); 
 ?>

<div class="form-container"> 
<div class="container">
<form action="#" method="post" role="form">
<?php if(isset($_GET['user_name'])){
	
       $id = $_GET['user_name'];
	   $approval= $_GET['approval'];
	   $s = $db1->approval_teacher($conn,'users',$id,$approval);
       if($s){
      
            }
               } ?>

              <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Staff Record</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
<div class="row">
 <?php  
   
   $n=0; 
            $view = $db1->get_pending_teacher($conn,'users',$user_program,100);
            foreach ($view as $post) {
			$n = 1;}
		if($n>0)
		{   ?>			

<div class="text-center">
                            <span class="span_blog txt_darkgrey txt_orange"><h3>Approval Pending Staff Record</h3></span><br>
  </div>
                <div class="table-responsive">
                 <table class="ui celled table table table-hover">
                  <thead>
                    <tr>
		      <th>Sr. No.</th> 
                      <th>Employee ID</th>
		      <th>Staff Name</th>
                      <th>Phone/Mob. no.</th>
		      <th>Email address</th>
		      <th>Program</th>
			  <th>Remark</th>
                      
                    </tr>
                  </thead>
     <tbody>
          <?php  
   
   $counter=0; 
       
            foreach ($view as $post) {
		
            $teacher_id = $post['user_name'];
  
          echo '<tr>';
	    echo '<td>'. ++$counter . '</td>';
            echo '<td>'. $post['user_name'] . '</td>';         
            echo '<td>'. $post['full_name'] . '</td>';
            echo '<td>'. $post['tel'] . '</td>';
            echo '<td>'. $post['user_email'] . '</td>';
            echo '<td>'. $post['program'] . '</td>';
            
            
           echo '<td width=150>';
            echo "<div class='ui mini buttons'>";
            echo '<a class="ui positive button" href="teacher.php?user_name='.$post['user_name'].'&approval=1"> Approve</a>';
            echo "<div class='or'></div>";    
            echo '<a class="ui red button" href="teacher.php?user_name='.$post['user_name'].'&approval=0">Reject</a>';
            echo "</div>";
            echo '</td>';  
			echo '</tr>'; 
            echo "</div>";
           
			}
            
           ?>
      </tbody>     
            </table>
            </div><!--table-responsive-->
		<br>
	<?php	} ?>
 <div class="text-center">
                            <span class="span_blog txt_darkgrey txt_orange"><h3>Approved Staff Record</h3></span><br>
  </div>

				<div class="row">

                <div class="table-responsive">
                 <table class="ui celled table table table-hover">
                  <thead>
                    <tr>
		      <th>Sr. No.</th> 
              <th>Employee ID</th>
		      <th>Staff Name</th>
              <th>Phone/Mob. no.</th>
		      <th>Email address</th>
		      <th>Program</th>
                      
                    </tr>
                  </thead>
     <tbody>
          <?php  
   
   $counter=0; 
            $veiw = $db1->get_all_teacher_program($conn,'users',$user_program,100);
            foreach ($veiw as $post) {
			if($post['banned'] == 0){
            $teacher_id = $post['user_name'];
  
          echo '<tr>';
	    echo '<td>'. ++$counter . '</td>';
            echo '<td>'. $post['user_name'] . '</td>';         
            echo '<td>'. $post['full_name'] . '</td>';
            echo '<td>'. $post['tel'] . '</td>';
            echo '<td>'. $post['user_email'] . '</td>';
            echo '<td>'. $post['program'] . '</td>';
            
            
            
            echo "</div>";
            echo '</td>';    
			echo '</tr>'; } 
            }
           ?>
      </tbody>     
            </table>
            </div><!--table-responsive-->
	<br>		
			<?php  
   
   $n=0; 
           
            foreach ($veiw as $post) {
				if($post['banned'] == 1){
			$n = 1;}}
		if($n>0)
		{   ?>			

<div class="text-center">
                            <span class="span_blog txt_darkgrey txt_orange"><h3>Disapprove Staff Record</h3></span><br>
  </div>
                <div class="table-responsive">
                 <table class="ui celled table table table-hover">
                  <thead>
                    <tr>
		      <th>Sr. No.</th> 
                      <th>Employee ID</th>
		      <th>Staff Name</th>
                      <th>Phone/Mob. no.</th>
		      <th>Email address</th>
		      <th>Program</th>
			  <th>Remark</th>
                      
                    </tr>
                  </thead>
     <tbody>
          <?php  
   
   $counter=0; 
       
            foreach ($veiw as $post) {
			if($post['banned'] == 1){
		
            $teacher_id = $post['user_name'];
  
          echo '<tr>';
	    echo '<td>'. ++$counter . '</td>';
            echo '<td>'. $post['user_name'] . '</td>';         
            echo '<td>'. $post['full_name'] . '</td>';
            echo '<td>'. $post['tel'] . '</td>';
            echo '<td>'. $post['user_email'] . '</td>';
            echo '<td>'. $post['program'] . '</td>';
            
            
           echo '<td width=150>';
            echo "<div class='ui mini buttons'>";
            echo '<a class="ui positive button" href="teacher.php?user_name='.$post['user_name'].'&approval=1"> Approve</a>';
            echo "</div>";
            echo '</td>';  
			echo '</tr>'; 
            echo "</div>";
           
			}
            }
           ?>
      </tbody>     
            </table>
            </div><!--table-responsive-->
		<br>
	<?php	} ?>

	
</form>
            </div><!--row-->   
           </div><!--container-->
	  
<?php include "includes/footer.php"; ?>
