  <?php

  $pagetitle="Student data"; 
include 'dbc.php';
page_protect();
include "includes/header.php"; 

?>
  <?php// $db = new db(); 
  ?>
<head>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script>
$(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'Downloaded_Stdent_List' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
</script>
<script src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{  

$('#program').on('change',function()
{
var programID =$(this).val();
if(programID)

{
$.ajax
({
type:'POST',
url:'ajax.php',
data:'program_id='+programID,
success:function(html)
{

$('#year').html(html);
$('#division').html('<option value="">Select Year First</option>');
$('#semester').html('<option value="">Select Year First</option>');

}


});
}else
{
$('#year').html('<option value="">Select Program First</option>');
$('#division').html('<option value="">Select Year First</option>');
$('#semester').html('<option value="">Select Semester First</option>');

}

	})

$('#year').on('change',function()
	{
var yearID =$(this).val();
if(yearID)

{
$.ajax
({
type:'POST',
url:'ajax.php',
data:'year_id='+yearID,
success:function(html)
{
	
$('#division').html(html);
$('#semester').html('<option value="">Select Division First</option>');

}


});
}else
{
$('#division').html('<option value="">Select Year First</option>');
$('#semester').html('<option value="">Select Semester First</option>');

}

	})

$('#division').on('change',function()
	{
var divisionID =$(this).val();
if(divisionID)

{
$.ajax
({
type:'POST',
url:'ajax.php',
data:'div_id='+divisionID,
success:function(html)
{
	
$('#semester').html(html);

}


});
}else
{
$('#semester').html('<option value="">Select Division First</option>');

}

	})		
	

});
</script>
</head>
<?php
$year = $_SESSION['year']; ?>
<div class="form-container"> 
<div class="container">
<form action="#" method="post" role="form">
<?php if (isset($_POST['std_roll_no'])) {
            $id = $_POST['std_roll_no'];

            if($db->delete_std($conn,'student_table',$id)){
              echo "Record was Deleted";
            }
          }
?>
            
              <div class="row">
              <div class="templatemo-line-header" style="margin-top: 0px;" >
              <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Student's Records</span>
                            <hr class="team_hr team_hr_right hr_gray" />
               </div>
               </div>
               </div>


<?php 
$query=$db->query("Select * From intake Where program = '$user_program' GROUP BY year order by year_id");
$rowcount=$query->num_rows;

							?>

      <div class="row">
          <div class="col-lg-2">
          <div class="form-group">
            <label for="year" >Year</label>
           <select  class="form-control" name="year"  required id="year" >
          
								<option value="">Select Year</option>
								<?php 
								if($rowcount>0){

									while($row=$query->fetch_assoc()){
										echo '<option value="'.$row['year_id'].'">'.$row['year'].'</option>';
									}
									
								}
else{
                                        echo '<option value="">Year Not Available</option>';

									}
								?>
          </select>
      </div>
      </div>


 	<div class="col-lg-2">
         <div class="form-group">
            <label for="year" >Division</label>
            <select  class="form-control" name="division" required id="division" >
          <option value="">Select Division</option>
           </select>
         </div>
         </div>
 
           <div class="col-lg-2">
          <div class="form-group">
          <label for="semester">Semester</label>
           <select  class="form-control" name="semester"  required id="semester" >
           <option value="">Select Semester</option>
           </select>
          </div>  
          </div>

	      <div class="col-lg-2">
          <div class="form-group">
          <label for="batch"  class="col-sm-2 control-label">Batch</label>
           <select  class="form-control" name="batch"  required id="batch" >
           <option value="">Select Batch</option>
		   <option>All</option>
           <option>A</option>
           <option>B</option>
           <option>C</option> 
           <option>D</option>
           </select>
          </div>  
          </div>
		 
<?php $query1=$db->query("Select * From division_details  GROUP BY year");?>

		 <div class="col-lg-2">
          <div class="form-group">
          <label for="AY"  class="col-sm-2 control-label">Academic_Year</label>
           <select  class="form-control" name="AY"  required id="AY" >
           <option value="">Select Year</option>
	<?php	 while($row=$query1->fetch_assoc()){
				echo '<option value="'.$row['year'].'">'.$row['year'].'</option>';
									} ?>
            </select>
          </div>  
          </div>
		  
          </div>
		

<div class="ui mini buttons col-sm-offset-3 col-sm-3">
          <button type="submit" class="ui mini positive button" name="submit">Submit</button>
          <div class="or"></div>
          <button type="reset" class="ui mini red button" name="back">Clear</button>
</div>

<br> </br>
      
	         
         <?php
		if (isset($_POST['submit'])) {
		
			$sem_id = $_POST['semester'];
			$year = $_POST['AY'];
				$batch= $_POST['batch'];
				$counter = 0;

				$query=$db->query("Select * From intake Where sem_id = '$sem_id'");
           while($post=$query->fetch_assoc()){
			   $division = $post['division'];
			   $semester = $post['semester'];
		   }
				
            $veiw = $db->query("Select * From division_details Where sem_id = '$sem_id' and year = '$year' ORDER BY `std_roll_no` ASC");
			$rowcount=$veiw->num_rows;
			if($rowcount==0)
			{
				echo "<h3> No Students found <h3>";
			}
			else{
			echo '<div>'; 
			echo '<button class="ui mini positive button" id="btnExport">'.'<h4>'.'Download Student List'.'</h4>'.'</button>'; 		  
			echo '</div>';
			echo '<br>';
			?>
			<div class="table-responsive">
                 <table class="ui celled table table table-hover" id="table_wrapper">
                  <thead>
                    <tr>
						<th>Sr. No.</th> 	
						<th>std. No.</th> 	
						<th>Regd. No.</th> 	
                     	<th>Roll No.</th>
                      	<th>Student Name</th>
                      	<th>Email Address</th>
                      	<th>Student Phone Number</th>
                      	<th>Parent Phone Number</th>
						<th>Year/Div</th>
                      	<th>Semester</th>
						<th>Batch</th>
						<th>Name of Mentor</th>
                    </tr>
                  </thead>
     <tbody>
	 <?php
		    echo '</div>';
           while($post1=$veiw->fetch_assoc()){
				$std_id = $post1['std_id'];
				
			$query=$db->query("Select * From student_table Where std_id = '$std_id'");
           while($post2=$query->fetch_assoc()){
			echo '<tr>';
            echo '<td>'. ++$counter . '</td>';
            echo '<td>'. $std_id . '</td>';
            echo '<td>'. $post2['registration_no'] . '</td>';
            echo '<td>'. $post1['std_roll_no'] . '</td>';          
            echo '<td>'. $post2['student_name'] . '</td>';
            echo '<td>'. $post2['email'] . '</td>';
            echo '<td>'. $post2['s_phone'] . '</td>';
            echo '<td>'. $post2['p_phone'] . '</td>';
			echo '<td>'. $division . '</td>';
            echo '<td>'. $semester . '</td>';
			echo '<td>'. $post1['batch'] . '</td>';
			echo '<td>'. $post2['mentor'] . '</td>';
    /*        echo '<td width=150>';
            echo "<div class='ui mini buttons'>";
            echo '<a class="ui mini positive button" href="student_update.php?std_roll_no='.$post['std_roll_no'].'&sem_id='.$post['sem_id'].'"> <i class="glyphicon glyphicon-pencil"></i>Update</a>';
            echo "<div class='or'></div>";    
            echo '<a class="ui mini red button" href="student.php?std_roll_no='.$post['std_roll_no'].'"><i class="glyphicon glyphicon-remove"> </i>Delete</a>';
            echo "</div>";
            echo '</td>';    */
			echo '</tr>';  
		}}}}
           ?>
      </tbody>     
            </table>
            </div><!--table-responsive--> 
</form>    
	    </div><!--form-container-->   
           </div><!--container-->
<?php include "includes/footer.php"; 

?>