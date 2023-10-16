<?php 
require_once('dbc.php');

//Ajax call for year where values are going to be fetch by program_id
if(isset($_POST['program_id'])&&!empty($_POST['program_id'])){
//echo $_POST['program_id'];exit;

$query = $db->query("SELECT * FROM intake WHERE program_id = ".$_POST['program_id']." GROUP BY year_id ASC");
$rowCount= $query->num_rows;

if($rowCount>0){
echo '<option value="">Select year</option>';
while($row=$query->fetch_assoc()){

echo '<option value="'.$row['year_id'].'">'.$row['year'].'</option>';


}

}
else{

echo '<option value"">Year Not Available</option>';

}
}



//Ajax call for city where values are going to be fetch by year_id
if(isset($_POST['year_id'])&&!empty($_POST['year_id'])){

$query=$db->query("SELECT * FROM intake WHERE year_id=".$_POST['year_id']." GROUP BY division ASC");
$rowCount=$query->num_rows;

if($rowCount>0){
echo '<option value="">Select division</option>';
while($row=$query->fetch_assoc()){

echo '<option value="'.$row['div_id'].'">'.$row['division'].'</option>';

}

}
else{

echo '<option value"">Division Not Available</option>';

}
}



if(isset($_POST['div_id'])&&!empty($_POST['div_id'])){

$query=$db->query("SELECT * FROM intake WHERE div_id=".$_POST['div_id']." ORDER BY semester ");
$rowCount=$query->num_rows;

if($rowCount>0){
echo '<option value="">Select Semester</option>';
while($row=$query->fetch_assoc()){

echo '<option value="'.$row['sem_id'].'">'.$row['semester'].'</option>';

}

}
else{

echo '<option value"">Semester Not Available</option>';

}
}

if(isset($_POST['sem_id'])&&!empty($_POST['sem_id'])){

$query=$db2->query("SELECT * FROM subject_table WHERE sem_id=".$_POST['sem_id']." ORDER BY subject_name ");
$rowCount=$query->num_rows;

if($rowCount>0){
echo '<option value="">Select Subject</option>';
while($row=$query->fetch_assoc()){

echo '<option value="'.$row['subject_no'].'">'.$row['subject_name'].'</option>';

}

}
else{

echo '<option value"">Subject Not Available</option>';

}
}

//Ajax call for Feedback
if(isset($_POST['year_id_feed'])&&!empty($_POST['year_id_feed'])){

$query=$db->query("SELECT * FROM intake WHERE year_id=".$_POST['year_id_feed']." GROUP BY semester ASC");
$rowCount=$query->num_rows;

if($rowCount>0){
echo '<option value="">Select Semester</option>';
while($row=$query->fetch_assoc()){

echo '<option value="'.$row['semester'].'">'.$row['semester'].'</option>';

}

}
else{

echo '<option value"">Semester Not Available</option>';

}
}

		
?>