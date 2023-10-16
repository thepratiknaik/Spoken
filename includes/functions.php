   <?php 

$dbHost='localhost';
$dbUsername='root';
$dbPassword='';
$dbName='dims_db';


$conn=new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
	
if($conn->connect_error){
die("conection failed:".$conn->connect_error);
}

     Class db1{

/**********************/
//Students Entry
/*********************/
 function std_entry($conn,$std_id,$studentName,$email,$s_phone,$p_phone,$mentor,$smart_card_no,$admission_year,$program,$admission_type,$registration_no){
	try{
		
		$query = "INSERT INTO student_table SET std_id = ?, student_name = ?, email= ? , s_phone = ?,  p_phone = ?, mentor = ?, smart_card_no = ?, admission_year = ?,Program = ?, admission_type = ?, registration_no = ?";

		$entry = $conn->prepare($query);
		$entry->bind_Param('issiississi', $std_id, $studentName, $email, $s_phone, $p_phone, $mentor, $smart_card_no, $admission_year, $program, $admission_type, $registration_no);
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register ".$studentName."! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}

/**********************/
//Update Students Entry
/*********************/
 function std_update_entry($db,$studentrollno,$studentName,$email,$s_phone,$p_phone,$mentor,$program,$division,$sem_id,$semester,$batch){
	try{
		
		$query = "UPDATE student_table SET student_name = ?, email= ? , s_phone = ?,  p_phone = ?, mentor = ? WHERE std_roll_no = ? AND sem_id = ? ";

		$entry = $db->prepare($query);
		$entry->bindValue(1, $studentName);
		$entry->bindValue(2, $email);
		$entry->bindValue(3, $s_phone);
		$entry->bindValue(4, $p_phone);
		$entry->bindValue(5, $mentor);
		$entry->bindValue(6, $studentrollno);
		$entry->bindValue(7, $sem_id);
		
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
	
	
		/**********************/
		//Gettintg all records
		/*********************/

function get_all_std($db,$table,$limit){

			try {
				$query = "SELECT * FROM {$table} ORDER BY  std_roll_no LIMIT {$limit}";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }

		/**********************/
		//Gettintg Dvision wise records
		/*********************/

function get_div_std($db,$table,$sem_id,$batch,$limit){
IF($batch == "All"){
			try {
				$query = "SELECT * FROM {$table} WHERE sem_id = '$sem_id'";
					$stmt = $db->prepare( $query );
					// $stmt->bindParam(1, $program);
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}}
ELSE{
			try {
				$query = "SELECT * FROM {$table} WHERE sem_id = '$sem_id' AND batch='$batch'";
					$stmt = $db->prepare( $query );
					// $stmt->bindParam(1, $program);
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}
}
	      }


	      /*********************************/
		//Getting single record for editing
		/***********************************/

function get_single_std($db,$table,$id,$sem_id)
	{
		
		try {

			$query = "SELECT * FROM {$table} WHERE std_roll_no ={$id} AND sem_id={$sem_id}";
			$stmt = $db->prepare($query);
			// $stmt->bindParam(1, $id);
			$stmt->execute();
			return $stmt->fetchAll();

			
		} catch (Exception $e) {
			return "Error : ". $e->getMessage();	
		}
	}

		/**********************/
		//delete single record
		/*********************/

function delete_std($db,$table,$id){

			try {
				$query = "DELETE  FROM {$table} WHERE std_roll_no={$id}";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					
					
			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	}

	 	/*****************************/
		//Update single Student Record
		/****************************/

	function update_std($db,$studentName,$email,$s_phone,$p_phone,$mentor,$program,$year,$semester,$rollno){
	try{
		
		$query = "UPDATE  student_table SET student_name = ?, email = ?, s_phone = ?, p_phone = ?, mentor = ? , Program = ?, division = ?, semester = ? WHERE std_roll_no = ?";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $studentName);
		$stmt->bindParam(2, $email);
		$stmt->bindParam(3, $s_phone);
		$stmt->bindParam(4, $p_phone);
		$stmt->bindParam(5, $mentor);
		$stmt->bindParam(6, $program);
		$stmt->bindParam(7, $year);
		$stmt->bindParam(8, $semester);
		$stmt->bindParam(9, $rollno);
		if($stmt->execute()){
			return "Record was Updated.";
			die();
		}else{
			 return "Unable to Update Record";
			
		}
	}

		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	/*************************/
	//Teachers Registration
	/*************************/
function teacher_entry($db,$teacher_id,$name,$program,$phone,$email,$password){
	try{
		
		$query = "INSERT INTO teacher_table SET teacher_id = ?, name = ?, program = ?, phone = ?, email = ?, password = ?";

		$entry = $db->prepare($query);
		$entry->bindValue(1, $teacher_id);
		$entry->bindValue(2, $name);
		$entry->bindValue(3, $program);
		$entry->bindValue(4, $phone);
		$entry->bindValue(5, $email);
		$entry->bindValue(6, $password);
		
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}

        /*****************************/
		//Fetching Teachers Records
		/****************************/ 


	function get_all_teacher($conn,$table,$limit){
	       try {
				$query = "SELECT * FROM {$table} ORDER BY  user_name LIMIT {$limit}";
				$stmt = $conn->query( $query );
					return $stmt->fetch_all(MYSQLI_ASSOC);

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }

       /*****************************/
		//Fetching Program Teachers Records
		/****************************/ 


	function get_all_teacher_program($conn,$table,$program,$limit){
	       try {
				$query = "SELECT * FROM {$table} WHERE program = '{$program}' ORDER BY  user_name LIMIT {$limit}";
				$stmt = $conn->query( $query );
					return $stmt->fetch_all(MYSQLI_ASSOC);

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }


		    /*****************************/
		//Fetching Pending Approval Teachers Records
		/****************************/ 


	function get_pending_teacher($conn,$table,$program,$limit){
	       try {
				$query = "SELECT * FROM {$table} where banned = 3 AND program = '{$program}' ORDER BY  user_name LIMIT {$limit}";
					$stmt = $conn->query( $query );
					return $stmt->fetch_all(MYSQLI_ASSOC);

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }

		  
       /***************************************************/
		  //Fetching teacher's single record for Editing
	   /*************************************************/ 

function get_single_teacher($db,$table,$teacher_id)
	{
		
		try {

			$query = "SELECT * FROM {$table} WHERE teacher_id ={$teacher_id} ";
			$stmt = $db->prepare($query);
			// $stmt->bindParam(1, $teacher_id );
			$stmt->execute();
			return $stmt->fetchAll();

			
		} catch (Exception $e) {
			return "Error : ". $e->getMessage();	
		}
	}


 /***************************************************/
		  //Fetching teacher's name fro dropbox
	   /*************************************************/ 

function get_teacher($db,$table)
	{
		
		try {

			$query = "SELECT name FROM {$table}";
			$stmt = $db->prepare($query);
			
			$stmt->execute();
			return $stmt->fetchAll();

			
		} catch (Exception $e) {
			return "Error : ". $e->getMessage();	
		}
	}



    /******************************/
	//Deleting Teacher's Record
	/*****************************/

function delete_teacher($db,$table,$id){

			try {
				$query = "DELETE  FROM {$table} WHERE teacher_id={$id}";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					
					
			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	}
	
	
     /******************************/
	//Approve Teacher's Record
	/*****************************/

function approval_teacher($conn,$table,$id,$approval){
if($approval == 1 ){
			try{
		
		$query = "UPDATE  users SET banned = 0 WHERE user_name = ?";
		$stmt = mysqli_prepare($conn, $query);
		 mysqli_stmt_bind_param($stmt,'s', $id);
			mysqli_stmt_execute($stmt);

		
		if($stmt){
			return "Record was Updated.";
			die();
		}else{
			 return "Unable to Update Record";
			
		}
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}

}else{
	try{
		
		$query = "UPDATE  users SET banned = 1 WHERE user_name = ?";
		$stmt = mysqli_prepare($conn, $query);
		 mysqli_stmt_bind_param($stmt,'s', $id);
			mysqli_stmt_execute($stmt);

		
		if($stmt->execute()){
			return "Record was Updated.";
			die();
		}else{
			 return "Unable to Update Record";
			
		}
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
}
	}
	
		

 /******************************/
	//Updating Teacher's Record
	/*****************************/

	function update_teacher($db,$name,$phone,$email,$program,$teacher_id){
	try{
		
		$query = "UPDATE  teacher_table SET name = ?, phone = ?, email = ?, program = ?,  WHERE teacher_id = ?";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $name);
		$stmt->bindParam(2, $phone);
		$stmt->bindParam(3, $email);
		$stmt->bindParam(4, $program);
		$stmt->bindParam(5, $teacher_id);
		
		if($stmt->execute()){
			return "Record was Updated.";
			die();
		}else{
			 return "Unable to Update Record";
			
		}
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	 /*****************************/
	// Subject Entry
	/****************************/ 

	function subject_entry($db,$subject_no,$subject_name,$program_id,$program,$year_id,$year,$div_id,$division,$sem_id,$semester){
	try{
		
		$query = "INSERT INTO subject_table SET subject_no=?,subject_name=?, program_id =? , program = ? , year_id = ? , year = ? , div_id = ? ,division = ? , sem_id = ? ,semester =?";

		$entry = $db->prepare($query);
		$entry->bindValue(1, $subject_no);
		$entry->bindValue(2, $subject_name);
		$entry->bindValue(3, $program_id);
		$entry->bindValue(4, $program);
		$entry->bindValue(5, $year_id);
		$entry->bindValue(6, $year);
		$entry->bindValue(7, $div_id);
		$entry->bindValue(8, $division);
		$entry->bindValue(9, $sem_id);
		$entry->bindValue(10, $semester);
		if($entry->execute())
		{
			return "Successfully saved.";
			die();
		}
		else{
			return "Unable to save ! please try again.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}

/*****************************/
	//Elective Subject Entry
	/****************************/ 

	function elec_subject_entry($db,$subject_no,$subject_name,$sem_id,$batch1,$batch2,$batch3,$batch4){
	try{
		
		$query = "INSERT INTO elective_subject SET subject_no=?,subject_name=?, sem_id = ? ,batch1=?,batch2=?,batch3=?,batch4=?";

		$entry = $db->prepare($query);
		$entry->bindValue(1, $subject_no);
		$entry->bindValue(2, $subject_name);
		$entry->bindValue(3, $sem_id);
		$entry->bindValue(4, $batch1);
		$entry->bindValue(5, $batch2);
		$entry->bindValue(6, $batch3);
		$entry->bindValue(7, $batch4);

		
		if($entry->execute())
		{
			return "Successfully saved.";
			die();
		}
		else{
			return "Unable to save ! please try again.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}

		/**********************/
		//Gettintg all subject
		/*********************/

function get_all_subject($conn,$table,$limit){

			try {
				$query = "SELECT * FROM {$table} ORDER BY  subject_no LIMIT {$limit}";
					$stmt = $conn->query( $query );
					return $stmt->fetch_all(MYSQLI_ASSOC);

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }
		  
		 /**********************/
		//Gettintg semester subject
		/*********************/

function get_semester_subject($conn,$table,$semester1,$AY,$limit){

			try {
				$query = "SELECT * FROM {$table} WHERE sem_id = {$semester1} AND ac_year = {$AY} ORDER BY  subject_no LIMIT {$limit}";
					$stmt = $conn->query( $query );
					return $stmt->fetch_all(MYSQLI_ASSOC);

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }

		  /**********************/
		//Gettintg  subject
		/*********************/

function get_subject_detail($db,$table,$subject,$semester,$limit){

			try {
				$query = "SELECT * FROM {$table} WHERE subject_no = '$subject' AND sem_id = '$semester' ORDER BY  subject_no LIMIT {$limit}";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }
		  
		
		  
/****************************/
//Updating Subject Record/Allotement of subject
/*****************************/

	function update1_sub($db,$teacher_id,$teacher_name,$subject,$semester){
	try{
		
		
		   
		$query = "UPDATE subject_table SET teacher1_id = ?, teacher1_name = ? WHERE subject_no = ? AND sem_id = ? ";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $subject);
		$stmt->bindParam(4, $semester);
		   
		
		if($stmt->execute()){
			return "Subject was Added.";
			die();
		}else{
			 return "Unable to Add Subject";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	function update2_sub($db,$teacher_id,$teacher_name,$subject,$semester){
	try{
		
		
		   
		$query = "UPDATE subject_table SET teacher2_id = ?, teacher2_name = ? WHERE subject_no = ? AND sem_id = ? ";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $subject);
		$stmt->bindParam(4, $semester);
		   
		
		if($stmt->execute()){
			return "Subject was Added.";
			die();
		}else{
			 return "Unable to Add Subject";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}
	
	
function update3_sub($db,$teacher_id,$teacher_name,$subject,$semester){
	try{
		
		
		   
		$query = "UPDATE subject_table SET teacher3_id = ?, teacher3_name = ? WHERE subject_no = ? AND sem_id = ? ";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $subject);
		$stmt->bindParam(4, $semester);
		   
		
		if($stmt->execute()){
			return "Subject was Added.";
			die();
		}else{
			 return "Unable to Add Subject";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}


	  /**********************/
		//Gettintg subject for teacher
		/*********************/

function get_subject($db,$teacher_id){

			try {
				$query = "SELECT * FROM subject_table WHERE teacher1_id = '$teacher_id' OR teacher2_id = '$teacher_id' OR teacher3_id = '$teacher_id'";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }
 
	
	    /**********************/
		//Gettintg all semester
		/*********************/

function get_all_term($db,$table,$limit){

			try {
				$query = "SELECT * FROM {$table} ORDER BY  semester_no LIMIT {$limit}";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }
 
 	 /*****************************/
	// semester Entry
	/****************************/ 

	function term_entry($db,$semesterNo,$subject){
	try{
		
		$query = "INSERT INTO semester_table SET semester_no=?, subject = ?";

		$entry = $db->prepare($query);
		$entry->bindValue(1, $semesterNo);
		$entry->bindValue(2, $subject);	
		if($entry->execute())
		{
			return "Successfully saved.";
			die();
		}
		else{
			return "Unable to save ! please try again.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}

	    //###################
		// Get Single User ##
		//###################

	function get_single_user($db,$table,$id)
	{
		
		try {

			$query = "SELECT * FROM {$table} WHERE id ={$id} ";
			$stmt = $db->prepare($query);
			// $stmt->bindParam(1, $user_id);
			$stmt->execute();
			return $stmt->fetchAll();

			
		} catch (Exception $e) {
			return "Error : ". $e->getMessage();	
		}
	}
//####################
//Get User ##
//####################
 function get_user($db,$table){
				
		try {

				$query = "SELECT * FROM {$table}";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}



		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	


//####################
//## defauletr list ##
//####################
      
function def_entry($db,$def_list,$frdate,$todate){
	try{
		
		$query = "INSERT INTO defaulter SET def_list = ?, frdate = ?, todate = ?,  percentage = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $def_list);
		$entry->bindValue(2, $frdate);
		$entry->bindValue(3, $todate);
		$entry->bindValue(4, "75");
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to Enter! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}

//####################
//## Attendance     ##
//####################
	
	
	function att_entry_new($db,$table,$c,$sem_id,$subject_no,$teacher,$ondate,$time,$att,$roll_no,$student_name){
	try{
		
		$query = "INSERT INTO {$table} SET attID = ?, sem_id = ?, subject_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?, std_roll_no= ?, student_name = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $subject_no);
		$entry->bindValue(4, $teacher);
		$entry->bindValue(5, $ondate);
		$entry->bindValue(6, $time);
		$entry->bindValue(7, $att);
		$entry->bindValue(8, $roll_no);
		$entry->bindValue(9, $student_name);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
		}
	
	function att_entry($db,$semester,$c,$sem_id,$subject1,$teacher,$ondate,$time,$att){
		if($semester == "4"){
	try{
		
		$query = "INSERT INTO attendance_se SET attID = ?, sem_id = ?, subject_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $subject1);
		$entry->bindValue(4, $teacher);
		$entry->bindValue(5, $ondate);
		$entry->bindValue(6, $time);
		$entry->bindValue(7, $att);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
	else {
			if($semester == "6"){
	try{
		
		$query = "INSERT INTO attendance_te SET attID = ?, sem_id = ?, subject_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $subject1);
		$entry->bindValue(4, $teacher);
		$entry->bindValue(5, $ondate);
		$entry->bindValue(6, $time);
		$entry->bindValue(7, $att);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
	
	else{
			if($semester == "8"){
	try{
		
		$query = "INSERT INTO attendance_be SET attID = ?, sem_id = ?, subject_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $subject1);
		$entry->bindValue(4, $teacher);
		$entry->bindValue(5, $ondate);
		$entry->bindValue(6, $time);
		$entry->bindValue(7, $att);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
	}}
}
	
	
	function update_att($db,$semester,$std_roll_no,$student_name,$c,$sem_id,$subject1,$ondate,$time){
		
		if($semester == "4"){
			try{
		$query = "UPDATE attendance_se SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND subject_no = ? AND ondate = ? AND time = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $subject1);
		$entry->bindParam(6, $ondate);
		$entry->bindParam(7, $time);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
		}
		else{
		if($semester == "6"){
			try{
		$query = "UPDATE attendance_te SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND subject_no = ? AND ondate = ? AND time = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $subject1);
		$entry->bindParam(6, $ondate);
		$entry->bindParam(7, $time);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
		}
	
	else{
		if($semester == "8"){
			try{
		$query = "UPDATE attendance_be SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND subject_no = ? AND ondate = ? AND time = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $subject1);
		$entry->bindParam(6, $ondate);
		$entry->bindParam(7, $time);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
		}
	}}
	}

//####################
//## Additional Att	##
//####################

function get_std_att($db,$table,$sem_id,$subject,$std_roll_no)
	{
		
		try {

			$query = "SELECT count(`attendance`) FROM {$table} WHERE `sem_id`= '$sem_id' and `subject_no` = '$subject' AND `std_roll_no` = '$std_roll_no' and `attendance` = '1'";
			$stmt = $db->prepare($query);
			// $stmt->bindParam(1, $user_id);
			$stmt->execute();
			return $stmt->fetchAll();

			
		} catch (Exception $e) {
			return "Error : ". $e->getMessage();	
		}
	}

//####################
//## Additional Att	##
//####################

function addatt($db,$table,$sem_id,$std_roll_no,$user_name,$frdate,$todate,$remark){
	try{
		
		$query = "INSERT INTO {$table} SET sem_id = ?, std_roll_no = ?,  enterby = ?, frdate = ?,  todate = ? , remark =?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $sem_id);
		$entry->bindValue(2, $std_roll_no);
		$entry->bindValue(3, $user_name);
		$entry->bindValue(4, $frdate);
		$entry->bindValue(5, $todate);
		$entry->bindValue(6, $remark);
				
		if($entry->execute())
		{
			return "Inserted.";
		}
		else{
			return "Unable to Insert! Try again please.";
		}
	
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	
}
	
//####################
//## Additional Att	date##
//####################
function addatt_entry_date($db,$table,$sem_id,$std_roll_no,$date1,$id)
{
	try{
		
		$query = "INSERT INTO {$table} SET sem_id = ?, std_roll_no = ?, abdate = ? ,detail_id = ? ";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $sem_id);
		$entry->bindValue(2, $std_roll_no);
		$entry->bindValue(3, $date1);
		$entry->bindValue(4, $id);
		
				
		if($entry->execute())
		{
			return "Inserted.";
		}
		else{
			return "Unable to Insert! Try again please.";
		}
	
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	
}	

//####################
//## Topic Entry	##
//####################

 	
function topic_entry($db,$sem_id,$subject,$teacher,$ondate,$time,$topic){
		
	try{
		
		$query = "INSERT INTO topic_tbl SET topic = ?, sem_id = ?, subject_name = ?, user_name = ?, ondate = ?,  time = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $topic);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $subject);
		$entry->bindValue(4, $teacher);
		$entry->bindValue(5, $ondate);
		$entry->bindValue(6, $time);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}


//####################
//## Class Teacher  ##
//####################
function add_class_teacher($db,$teacher_id,$teacher_name,$semester,$division)
{
	try{
		
		
		   
		$query = "INSERT INTO class_teacher SET  teacher_id = ?, teacher_name = ?, sem_id = ? , div_id=?";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $semester);
		$stmt->bindParam(4, $division);
				   
		if($stmt->execute()){
			return "class teacher was Added.";
			die();
		}else{
			 return "Unable to Add class teacher";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
}
	
	
//####################
//## Column no for Additional att  ##
//####################
function add_column_no($db,$teacher_id,$teacher_name,$division,$semester,$column_no)
{
	try{
		
		
		   
		$query = "INSERT INTO addatt_loc SET  teacher_id = ?, teacher_name = ?, sem_id = ?, column_no = ? , div_id = ?";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $semester);
		$stmt->bindParam(4, $column_no);
		$stmt->bindParam(5, $division);
		   
		if($stmt->execute()){
			return "column was Added.";
			die();
		}else{
			 return "Unable to Add column";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
}	
	
	
//####################
//## IA    			##
//####################
	
	function IA_entry($db,$table,$c,$sem_id,$subject1,$teacher,$marks,$roll_no){
	try{
			$sql ="SELECT * FROM `student_table` WHERE `sem_id` = '$sem_id' AND `std_roll_no` = '$roll_no' ORDER BY `std_roll_no`";
			$Update = mysql_query($sql);
			$key1 = mysql_fetch_array($Update) ;
			$student_name = $key1['student_name'];
			
		$query = "INSERT INTO tbl_ia SET IAID = ?, sem_id = ?, subject_no = ?, user_name = ?, ia1marks = ?, std_roll_no = ?, student_name = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $subject1);
		$entry->bindValue(4, $teacher);
		$entry->bindValue(5, $marks);
		$entry->bindValue(6, $roll_no);
		$entry->bindValue(7, $student_name);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
	


function get_div_IA($db,$table,$sem_id,$subject1){
			try {
				$query = "SELECT * FROM {$table} WHERE `sem_id` = ? AND `subject_no`= ? ORDER BY `std_roll_no`";
			
					$entry = $db->prepare($query);
		
		$entry->bindParam(1, $sem_id);
		$entry->bindParam(2, $subject1);
					$entry->execute();
					return $entry->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}
	      }
	
function laterupdate_IA($db,$table,$sem_id,$subject1,$marks,$c){
	try{
		
		
		   
		$query = "UPDATE tbl_ia SET IA1marks = ? WHERE sem_id = ? AND subject_no = ? AND IAID = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $marks);
		$entry->bindParam(2, $sem_id);
		$entry->bindParam(3, $subject1);
		$entry->bindParam(4, $c);

		   
		
		if($entry->execute()){
			return "Marks was Updated.";
			die();
		}else{
			 return "Unable to update Marks";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}	
		


function IAdefaulter($db,$c,$sem_id,$ch){
	try{
		
		$query = "INSERT INTO ia_defaulter SET ID = ?, sem_id = ?,  status= ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $ch);
				
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
	
	function update_IAdefaulter($db,$std_roll_no,$student_name,$count,$sem_id){
	try{
		$query = "UPDATE ia_defaulter SET std_roll_no = ?, student_name = ? WHERE ID = ? AND sem_id = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $count);
		$entry->bindParam(4, $sem_id);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}
	
function get_def_std($db,$table,$sem_id){

			try {
				$query = "SELECT * FROM {$table} WHERE sem_id = '$sem_id'";
					$stmt = $db->prepare( $query );
					// $stmt->bindParam(1, $program);
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}
	      }

function lateralupdate_IAdefaulter($db,$ch,$c,$sem_id){
	try{
			   
		$query = "UPDATE ia_defaulter SET status = ? WHERE ID = ? AND sem_id = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $ch);
		$entry->bindParam(2, $c);
		$entry->bindParam(3, $sem_id);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}		  
		  
		  function IA2_entry($db,$c,$sem_id,$subject1,$teacher,$marks){
	try{
		
		$query = "INSERT INTO tbl_ia2 SET IAID = ?, sem_id = ?, subject_no = ?, user_name = ?, marks = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $subject1);
		$entry->bindValue(4, $teacher);
		$entry->bindValue(5, $marks);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
	
	
	function update_IA2($db,$std_roll_no,$student_name,$c,$sem_id,$subject1){
	try{
		
		
		   
		$query = "UPDATE tbl_ia2 SET std_roll_no = ?, student_name = ? WHERE IAID = ? AND sem_id = ? AND subject_no = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $subject1);

		   
		
		if($entry->execute()){
			return "Marks was Updated.";
			die();
		}else{
			 return "Unable to update Marks";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}
	
	function laterupdate_IA2($db,$sem_id,$subject1,$marks,$c){
	try{
		
		
		   
		$query = "UPDATE tbl_ia2 SET marks = ? WHERE sem_id = ? AND subject_no = ? AND IAID = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $marks);
		$entry->bindParam(2, $sem_id);
		$entry->bindParam(3, $subject1);
		$entry->bindParam(4, $c);

		   
		
		if($entry->execute()){
			return "Marks was Updated.";
			die();
		}else{
			 return "Unable to update Marks";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}
	
	 /*****************************/
	// Lab Entry
	/****************************/ 
	

	function lab_entry($db,$lab_no,$lab_name,$year_id,$year,$div_id,$division,$sem_id,$semester,$batch){
	try{
		
		$query = "INSERT INTO lab_table SET lab_no=?,lab_name=?,year_id = ? ,year = ?,div_id =?, division = ?, sem_id = ? ,semester =? ,batch = ?";

		$entry = $db->prepare($query);
		$entry->bindValue(1, $lab_no);
		$entry->bindValue(2, $lab_name);
		$entry->bindValue(3, $year_id);
		$entry->bindValue(4, $year);
		$entry->bindValue(5, $div_id);
		$entry->bindValue(6, $division);
		$entry->bindValue(7, $sem_id);
		$entry->bindValue(8, $semester);
		$entry->bindValue(9, $batch);
		if($entry->execute())
		{
			return "Successfully saved.";
			die();
		}
		else{
			return "Unable to save ! please try again.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}


		/**********************/
		//Gettintg all lab
		/*********************/

function get_all_lab($db,$table,$limit){

			try {
				$query = "SELECT * FROM {$table} ORDER BY  lab_no LIMIT {$limit}";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }

		
		  
/****************************/
//Updating lab Record/Allotement of lab
/*****************************/

	function update1_lab($db,$teacher_id,$teacher_name,$lab,$semester,$batch){
	try{						
		
		
		   
		$query = "UPDATE lab_table SET teacher1_id = ?, teacher1_name = ?  WHERE  batch = ? AND lab_no = ? AND sem_id = ? ";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $batch);
		$stmt->bindParam(4, $lab);
		$stmt->bindParam(5, $semester);
		   
		
		if($stmt->execute()){
			return "Subject was Added.";
			die();
		}else{
			 return "Unable to Add Subject";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	function update2_lab($db,$teacher_id,$teacher_name,$lab,$semester,$batch){
	try{
		
		
		   
		$query = "UPDATE lab_table SET teacher2_id = ?, teacher2_name = ? WHERE batch = ? AND lab_no = ? AND sem_id = ? ";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $batch);
		$stmt->bindParam(4, $lab);
		$stmt->bindParam(5, $semester);
		   
		
		if($stmt->execute()){
			return "Subject was Added.";
			die();
		}else{
			 return "Unable to Add Subject";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}
	
	



	  /**********************/
		//Gettintg lab for teacher
		/*********************/

function get_lab($db,$teacher_id){

			try {
				$query = "SELECT * FROM lab_table WHERE teacher1_id = '$teacher_id' OR teacher2_id = '$teacher_id'";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }
		  
		  
//####################
//## Lab Attendance ##
//####################

	function attlab_entry_new($db,$table,$c,$sem_id,$lab_no,$teacher,$ondate,$time,$att,$roll_no,$student_name,$batch){
	try{
		
		$query = "INSERT INTO {$table} SET attID = ?, sem_id = ?, batch = ? , lab_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ? , std_roll_no = ?, student_name = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $batch);
		$entry->bindValue(4, $lab_no);
		$entry->bindValue(5, $teacher);
		$entry->bindValue(6, $ondate);
		$entry->bindValue(7, $time);
		$entry->bindValue(8, $att);
		$entry->bindValue(9, $roll_no);
		$entry->bindValue(10, $student_name);
		
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
		}
	
	
	function attlab_entry($db,$c,$division,$sem_id,$batch,$lab1,$teacher,$ondate,$time,$att){
		if($division == "SE3" || $division == "SE4" || $division == "SED"){
			try{
		
		$query = "INSERT INTO lab_attendance_se SET attID = ?, sem_id = ?, batch = ? , lab_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $batch);
		$entry->bindValue(4, $lab1);
		$entry->bindValue(5, $teacher);
		$entry->bindValue(6, $ondate);
		$entry->bindValue(7, $time);
		$entry->bindValue(8, $att);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
		}
	else{
		if($division == "TE3" || $division == "TE4" || $division == "TED"){
			try{
		
		$query = "INSERT INTO lab_attendance_te SET attID = ?, sem_id = ?, batch = ? , lab_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $batch);
		$entry->bindValue(4, $lab1);
		$entry->bindValue(5, $teacher);
		$entry->bindValue(6, $ondate);
		$entry->bindValue(7, $time);
		$entry->bindValue(8, $att);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
		}
		else{
			if($division == "BE3" || $division == "BE4" || $division == "BED"){
			try{
		
		$query = "INSERT INTO lab_attendance_be SET attID = ?, sem_id = ?, batch = ? , lab_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $batch);
		$entry->bindValue(4, $lab1);
		$entry->bindValue(5, $teacher);
		$entry->bindValue(6, $ondate);
		$entry->bindValue(7, $time);
		$entry->bindValue(8, $att);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
		}
		}
	}
	}
	
	
	function update_attlab($db,$std_roll_no,$student_name,$c,$division,$sem_id,$batch,$lab1,$ondate,$time){
		if($division == "SE3" || $division == "SE4" || $division == "SED"){
			try{
		
		
		   
		$query = "UPDATE lab_attendance_se SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND batch = ? AND lab_no = ? AND ondate = ? AND time = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $batch);
		$entry->bindParam(6, $lab1);
		$entry->bindParam(7, $ondate);
		$entry->bindParam(8, $time);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
		}
		else{
			if($division == "TE3" || $division == "TE4" || $division == "TED"){
			try{
		
		
		   
		$query = "UPDATE lab_attendance_te SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND batch = ? AND lab_no = ? AND ondate = ? AND time = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $batch);
		$entry->bindParam(6, $lab1);
		$entry->bindParam(7, $ondate);
		$entry->bindParam(8, $time);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
		}
		else
		{
			if($division == "BE3" || $division == "BE4" || $division == "BED"){
			try{
		
		
		   
		$query = "UPDATE lab_attendance_be SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND batch = ? AND lab_no = ? AND ondate = ? AND time = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $batch);
		$entry->bindParam(6, $lab1);
		$entry->bindParam(7, $ondate);
		$entry->bindParam(8, $time);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
		}
		}
		}
	
	}
	
//####################
//##IA questionwise Marks Entry ##
//####################

function add_examiner($db,$teacher_id,$teacher_name,$subject,$semester)
{
	try{
		
		
		   
		$query = "UPDATE subject_table SET examiner_id = ?, examiner_name = ? WHERE subject_no = ? AND sem_id = ? ";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $subject);
		$stmt->bindParam(4, $semester);
		   
		
		if($stmt->execute()){
			return "Examiner was Added.";
			die();
		}else{
			 return "Unable to Add Examiner";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
}


function get_std_ia($db,$table,$sem_id,$subject1,$IA,$teacher,$limit){
	try {
				$query = "SELECT * FROM `ia_quewisemarks` WHERE `sem_id` = '$sem_id'  AND `subject_no` = '$subject1' AND `ia_no` = '$IA' AND `user_name` = '$teacher' ";
					$stmt = $db->prepare( $query );
					// $stmt->bindParam(1, $program);
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}
}


function IAatt_entry($db,$table,$c,$sem_id,$subject_no,$teacher,$att,$roll_no,$IA){
		try{	

		$sql ="SELECT * FROM `student_table` WHERE `sem_id` = '$sem_id' AND `std_roll_no` = '$roll_no' ORDER BY `std_roll_no`";
			$Update = mysql_query($sql);
			$key1 = mysql_fetch_array($Update) ;
			$student_name = $key1['student_name'];
			
	

				
		$query = "INSERT INTO {$table} SET sem_id = ?, user_name = ?, ia_no = ?,subject_no = ?, std_roll_no = ?, student_name = ?, iaatt = ? ";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $sem_id);
			$entry->bindValue(2, $teacher);
			$entry->bindValue(3, $IA);
			$entry->bindValue(4, $subject_no);
			//$entry->bindValue(5, $division);
			$entry->bindValue(5, $roll_no);
			$entry->bindValue(6, $student_name);
			$entry->bindValue(7, $att);
				
			
			if($entry->execute()){
				return "Successfully registered.";
				die();
			}else{
				return "Unable to register! Try again please.";
			}
			
		
}
catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
}
	

function IA_quemarksentry($db,$table,$sem_id,$teacher,$IA,$subject_no,$roll_no,$q1a,$q1b,$q1c,$q1d,$q1e,$q1f,$q2a,$q2b,$q3a,$q3b,$q1,$q2,$q3,$t){ 
try{	

	

				
		$query = "UPDATE {$table} SET `q1a`= ? ,`q1b`= ? ,`q1c`= ? ,`q1d`= ? ,`q1e`= ? ,`q1f`= ? ,`q2a`= ? ,`q2b`= ? ,`q3a`= ? ,`q3b`= ? ,`q1`= ?,`q2`= ?,`q3`= ?,`total`= ? WHERE sem_id = ? AND user_name = ? AND ia_no = ? AND subject_no = ? AND std_roll_no = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $q1a);
			$entry->bindValue(2, $q1b);
			$entry->bindValue(3, $q1c);
			$entry->bindValue(4, $q1d);
			$entry->bindValue(5, $q1e);
			$entry->bindValue(6, $q1f);
			$entry->bindValue(7, $q2a);
			$entry->bindValue(8, $q2b);
			$entry->bindValue(9, $q3a);
			$entry->bindValue(10, $q3b);
			$entry->bindValue(11, $q1);
			$entry->bindValue(12, $q2);
			$entry->bindValue(13, $q3);
			$entry->bindValue(14, $t);
			$entry->bindValue(15, $sem_id);
			$entry->bindValue(16, $teacher);
			$entry->bindValue(17, $IA);
			$entry->bindValue(18, $subject_no);
			//$entry->bindValue(5, $division);
			$entry->bindValue(19, $roll_no);
			
				
			
			if($entry->execute()){
				return "Successfully Inserted.";
				die();
			}else{
				return "Unable to Insert! Try again please.";
			}
			
		
}
catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
}

function IAatt_entry_med($db,$table,$c,$sem_id,$subject_no,$teacher,$att,$roll_no,$IA){ 
try{	

	

				
		$query = "UPDATE {$table} SET `iaatt`= ? WHERE sem_id = ? AND user_name = ? AND ia_no = ? AND subject_no = ? AND std_roll_no = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $att);
			$entry->bindValue(2, $sem_id);
			$entry->bindValue(3, $teacher);
			$entry->bindValue(4, $IA);
			$entry->bindValue(5, $subject_no);
			//$entry->bindValue(5, $division);
			$entry->bindValue(6, $roll_no);
			
				
			
			if($entry->execute()){
				return "Successfully Inserted.";
				die();
			}else{
				return "Unable to Insert! Try again please.";
			}
			
		
}
catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
}

//####################
//##IA EXCEL  questionwise Marks Entry ##
//####################

function IA_quemarks_excel_entry($db,$table,$sem_id,$teacher,$IA,$subject_no,$roll_no,$student_name,$q1a,$q1b,$q1c,$q1d,$q1e,$q1f,$q2a,$q2b,$q3a,$q3b,$q1,$q2,$q3,$t){ 
try{	

	if($t == 'ab' || $q1a == 'ab' || $q1b== 'ab' || $q1c == 'ab' || $q1d == 'ab' || $q1e == 'ab' || $q1f == 'ab' || $q2a == 'ab' || $q2b == 'ab' || $q3a == 'ab' || $q3b == 'ab' || $q1 == 'ab' || $q2 == 'ab' || $q3 == 'ab' || $t == 'AB' || $q1a == 'AB' || $q1b== 'AB' || $q1c == 'AB' || $q1d == 'AB' || $q1e == 'AB' || $q1f == 'AB' || $q2a == 'AB' || $q2b == 'AB' || $q3a == 'AB' || $q3b == 'AB' || $q1 == 'AB' || $q2 == 'AB' || $q3 == 'AB')
	{
		$query = "INSERT INTO {$table} SET sem_id =  ? ,  user_name = ? , ia_no = ? , subject_no = ? , std_roll_no = ? ,student_name = ? , iaatt = 0 , `q1a`= 'AB' ,`q1b`= 'AB' ,`q1c`= 'AB' ,`q1d`= 'AB' ,`q1e`= 'AB' ,`q1f`= 'AB' ,`q2a`= 'AB' ,`q2b`= 'AB' ,`q3a`= 'AB' ,`q3b`= 'AB' ,`q1`= 'AB' ,`q2`= 'AB' ,`q3`=  'AB' ,`total`= 'AB' ";
				$entry = $db->prepare($query);
			$entry->bindValue(1, $sem_id);
			$entry->bindValue(2, $teacher);
			$entry->bindValue(3, $IA);
			$entry->bindValue(4, $subject_no);
			$entry->bindValue(5, $roll_no);
			$entry->bindValue(6, $student_name);
	}
else{	
		$query = "INSERT INTO {$table} SET sem_id = ? ,  user_name = ? , ia_no = ? , subject_no = ? , std_roll_no = ?,  iaatt = 1 , student_name = ? , `q1a`= ? ,`q1b`= ? ,`q1c`= ? ,`q1d`= ? ,`q1e`= ? ,`q1f`= ? ,`q2a`= ? ,`q2b`= ? ,`q3a`= ? ,`q3b`= ? ,`q1`= ?,`q2`= ?,`q3`= ?,total = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $sem_id);
			$entry->bindValue(2, $teacher);
			$entry->bindValue(3, $IA);
			$entry->bindValue(4, $subject_no);
			//$entry->bindValue(5, $division);
			$entry->bindValue(5, $roll_no);
			$entry->bindValue(6, $student_name);
			$entry->bindValue(7, $q1a);
			$entry->bindValue(8, $q1b);
			$entry->bindValue(9, $q1c);
			$entry->bindValue(10, $q1d);
			$entry->bindValue(11, $q1e);
			$entry->bindValue(12, $q1f);
			$entry->bindValue(13, $q2a);
			$entry->bindValue(14, $q2b);
			$entry->bindValue(15, $q3a);
			$entry->bindValue(16, $q3b);
			$entry->bindValue(17, $q1);
			$entry->bindValue(18, $q2);
			$entry->bindValue(19, $q3);
			$entry->bindValue(20, $t);
			
}	
				
			
			if($entry->execute()){
				return "Successfully Inserted.";
				die();
			}else{
				return "Unable to Insert! Try again please.";
			}
			
		
}
catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
}

	 /*****************************/
	// tut Entry
	/****************************/ 

	function tut_entry($db,$tut_no,$tut_name,$year_id,$year,$div_id,$division,$sem_id,$semester,$batch){
	try{
		
		$query = "INSERT INTO tut_table SET tut_no=?,tut_name=?,year_id = ? ,year = ?,div_id =?, division = ?, sem_id = ? ,semester =? ,batch = ?";

		$entry = $db->prepare($query);
		$entry->bindValue(1, $tut_no);
		$entry->bindValue(2, $tut_name);
		$entry->bindValue(3, $year_id);
		$entry->bindValue(4, $year);
		$entry->bindValue(5, $div_id);
		$entry->bindValue(6, $division);
		$entry->bindValue(7, $sem_id);
		$entry->bindValue(8, $semester);
		$entry->bindValue(9, $batch);
		if($entry->execute())
		{
			return "Successfully saved.";
			die();
		}
		else{
			return "Unable to save ! please try again.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}


		/**********************/
		//Gettintg all tut
		/*********************/

function get_all_tut($db,$table,$limit){

			try {
				$query = "SELECT * FROM {$table} ORDER BY  tut_no LIMIT {$limit}";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }

		
		  
/****************************/
//Updating tut Record/Allotement of tut
/*****************************/

	function update1_tut($db,$teacher_id,$teacher_name,$tut,$semester,$batch){
	try{						
		
		
		   
		$query = "UPDATE tut_table SET teacher1_id = ?, teacher1_name = ?  WHERE  batch = ? AND tut_no = ? AND sem_id = ? ";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $batch);
		$stmt->bindParam(4, $tut);
		$stmt->bindParam(5, $semester);
		   
		
		if($stmt->execute()){
			return "Subject was Added.";
			die();
		}else{
			 return "Unable to Add Subject";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	function update2_tut($db,$teacher_id,$teacher_name,$tut,$semester,$batch){
	try{
		
		
		   
		$query = "UPDATE tut_table SET teacher2_id = ?, teacher2_name = ? WHERE batch = ? AND tut_no = ? AND sem_id = ? ";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $teacher_id);
		$stmt->bindParam(2, $teacher_name);
		$stmt->bindParam(3, $batch);
		$stmt->bindParam(4, $tut);
		$stmt->bindParam(5, $semester);
		   
		
		if($stmt->execute()){
			return "Subject was Added.";
			die();
		}else{
			 return "Unable to Add Subject";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}
	
	



	  /**********************/
		//Gettintg tut for teacher
		/*********************/

function get_tut($db,$teacher_id){

			try {
				$query = "SELECT * FROM tut_table WHERE teacher1_id = '$teacher_id' OR teacher2_id = '$teacher_id'";
					$stmt = $db->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }
		  
		  
//####################
//## tut Attendance ##
//####################


	      	function atttut_entry_new($db,$c,$sem_id,$tut_no,$teacher,$ondate,$time,$att,$roll_no,$student_name){
	try{
		
		$query = "INSERT INTO tut_attendance SET attID = ?, sem_id = ? , tut_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ? , std_roll_no = ?, student_name = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $tut_no);
		$entry->bindValue(4, $teacher);
		$entry->bindValue(5, $ondate);
		$entry->bindValue(6, $time);
		$entry->bindValue(7, $att);
		$entry->bindValue(8, $roll_no);
		$entry->bindValue(9, $student_name);
		
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
		}

		
	
	function atttut_entry($db,$c,$division,$sem_id,$batch,$tut1,$teacher,$ondate,$time,$att){
		if($division == "SE3" || $division == "SE4" || $division == "SED"){
			try{
		
		$query = "INSERT INTO tut_attendance_se SET attID = ?, sem_id = ?, batch = ? , tut_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $batch);
		$entry->bindValue(4, $tut1);
		$entry->bindValue(5, $teacher);
		$entry->bindValue(6, $ondate);
		$entry->bindValue(7, $time);
		$entry->bindValue(8, $att);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
		}
	else{
		if($division == "TE3" || $division == "TE4" || $division == "TED"){
			try{
		
		$query = "INSERT INTO tut_attendance_te SET attID = ?, sem_id = ?, batch = ? , tut_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $batch);
		$entry->bindValue(4, $tut1);
		$entry->bindValue(5, $teacher);
		$entry->bindValue(6, $ondate);
		$entry->bindValue(7, $time);
		$entry->bindValue(8, $att);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
		}
		else{
			if($division == "BE3" || $division == "BE4" || $division == "BED"){
			try{
		
		$query = "INSERT INTO tut_attendance_be SET attID = ?, sem_id = ?, batch = ? , tut_no = ?, user_name = ?, ondate = ?,  time = ?, attendance = ?";
		$entry = $db->prepare($query);
		$entry->bindValue(1, $c);
		$entry->bindValue(2, $sem_id);
		$entry->bindValue(3, $batch);
		$entry->bindValue(4, $tut1);
		$entry->bindValue(5, $teacher);
		$entry->bindValue(6, $ondate);
		$entry->bindValue(7, $time);
		$entry->bindValue(8, $att);
				
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
		}
		}
	}
	}
	
	
	function update_atttut($db,$std_roll_no,$student_name,$c,$division,$sem_id,$batch,$tut1,$ondate,$time){
		if($division == "SE3" || $division == "SE4" || $division == "SED"){
			try{
		
		
		   
		$query = "UPDATE tut_attendance_se SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND batch = ? AND tut_no = ? AND ondate = ? AND time = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $batch);
		$entry->bindParam(6, $tut1);
		$entry->bindParam(7, $ondate);
		$entry->bindParam(8, $time);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
		}
		else{
			if($division == "TE3" || $division == "TE4" || $division == "TED"){
			try{
		
		
		   
		$query = "UPDATE tut_attendance_te SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND batch = ? AND tut_no = ? AND ondate = ? AND time = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $batch);
		$entry->bindParam(6, $tut1);
		$entry->bindParam(7, $ondate);
		$entry->bindParam(8, $time);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
		}
		else
		{
			if($division == "BE3" || $division == "BE4" || $division == "BED"){
			try{
		
		
		   
		$query = "UPDATE tut_attendance_be SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND batch = ? AND tut_no = ? AND ondate = ? AND time = ? ";
		$entry = $db->prepare($query);
		$entry->bindParam(1, $std_roll_no);
		$entry->bindParam(2, $student_name);
		$entry->bindParam(3, $c);
		$entry->bindParam(4, $sem_id);
		$entry->bindParam(5, $batch);
		$entry->bindParam(6, $tut1);
		$entry->bindParam(7, $ondate);
		$entry->bindParam(8, $time);
		   
		
		if($entry->execute()){
			return "Attendance was Updated.";
			die();
		}else{
			 return "Unable to update Attendance";
			
		   }
		   
		   
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
		}
		}
		}
	
	}
	
	function outcome_entry($db,$user_name,$semester,$subject_no,$subject_name,$type,$co_nos, $co1_stmt, $co2_stmt, $co3_stmt, $co4_stmt, $co5_stmt, $co6_stmt, $cop1, $cop2, $cop3, $cop4, $cop5, $cop6){
		try{
			$query = "INSERT INTO outcome_details SET user_name = ?, semester = ?, subject_no = ?, subject_name = ?, co_nos = ?, co1_stmt = ?, co2_stmt = ?, co3_stmt = ?, co4_stmt = ?, co5_stmt = ?, co6_stmt = ?, cop1 = ?, cop2 = ?, cop3 = ?, cop4 = ?, cop5 = ?, cop6 = ?, type = ?";
			$entry = $db->prepare($query);
			$x = $co_nos;
			$entry->bindValue(1, $user_name);
			$entry->bindValue(2, $semester);
			$entry->bindValue(3, $subject_no);
			$entry->bindValue(4, $subject_name);
			$entry->bindValue(5, $co_nos);
			$entry->bindValue(6, $co1_stmt);
			$entry->bindValue(7, $co2_stmt);
			$entry->bindValue(8, $co3_stmt);
			$entry->bindValue(9, $co4_stmt);
			$entry->bindValue(10, $co5_stmt);
			$entry->bindValue(11, $co6_stmt);
			$entry->bindValue(12, $cop1);			
			$entry->bindValue(13, $cop2);
			$entry->bindValue(14, $cop3);
			$entry->bindValue(15, $cop4);
			//$x++;
			//if ($x <= 6){
				
				$entry->bindValue(16, $cop5);
			//}else{
				//$entry->bindValue(10, NULL);
				//$entry->bindValue(16, NULL);
			//}
			//$x++;
			//if ($x <= 6){
				
				$entry->bindValue(17, $cop6);
			//}else{
				//$entry->bindValue(11, NULL);
				//$entry->bindValue(17, NULL);
			//}	
			$entry->bindValue(18, $type);
			if($entry->execute()){return "Successfully updated.";die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}

	function labmarks_entry($db,$user_name,$sem_id,$subject_no,$batch,$roll_no,$student_name)
	{
		try{
			$query = "INSERT INTO lab_marks SET user_name = ?, sem_id = ?, subject_no = ?, std_roll_no = ?, student_name = ?, batch = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $user_name);
			$entry->bindValue(2, $sem_id);
			$entry->bindValue(3, $subject_no);
			$entry->bindValue(4, $roll_no);
			$entry->bindValue(5, $student_name);
			$entry->bindValue(6, $batch);
			if($entry->execute()){return "Successfully updated.";die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function labmarks_update($db,$user_name,$sem_id,$subject_no,$batch,$roll_no,$student_name,$e1,$e2,$e3,$e4,$e5,$e6,$e7,$e8,$e9,$e10,$e11,$e12,$e13,$e14,$e15,$e16,$e17,$e18,$e19,$e20){
		try{//$query = "UPDATE lab_attendance_be SET std_roll_no = ?, student_name = ? WHERE attID = ? AND sem_id = ? AND batch = ? AND lab_no = ? AND ondate = ? AND time = ? ";
			$query = "UPDATE lab_marks SET  e1 = ?, e2 = ?, e3 = ?, e4 = ?, e5 = ?, e6 = ?, e7 = ?, e8 = ?, e9 = ?, e10 = ?, e11 = ?, e12 = ?, e13 = ?, e14 = ?, e15 = ?, e16 = ?, e17 = ?, e18 = ?, e19 = ?, e20 = ? WHERE user_name = ? AND sem_id = ? AND subject_no = ? AND std_roll_no = ? AND student_name = ? AND batch = ?";
			$entry = $db->prepare($query);			
			$entry->bindValue(1, $e1);
			$entry->bindValue(2, $e2);
			$entry->bindValue(3, $e3);
			$entry->bindValue(4, $e4);
			$entry->bindValue(5, $e5);
			$entry->bindValue(6, $e6);
			$entry->bindValue(7, $e7);
			$entry->bindValue(8, $e8);
			$entry->bindValue(9, $e9);
			$entry->bindValue(10, $e10);
			$entry->bindValue(11, $e11);
			$entry->bindValue(12, $e12);
			$entry->bindValue(13, $e13);
			$entry->bindValue(14, $e14);
			$entry->bindValue(15, $e15);
			$entry->bindValue(16, $e16);
			$entry->bindValue(17, $e17);
			$entry->bindValue(18, $e18);
			$entry->bindValue(19, $e19);
			$entry->bindValue(20, $e20);
			$entry->bindValue(21, $user_name);
			$entry->bindValue(22, $sem_id);
			$entry->bindValue(23, $subject_no);
			$entry->bindValue(24, $roll_no);
			$entry->bindValue(25, $student_name);			
			$entry->bindValue(26, $batch);
			if($entry->execute()){return "Successfully updated.";die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function tutmarks_update($db,$sem_id,$subject_no,$batch,$roll_no,$student_name,$e1,$e2,$e3,$e4,$e5,$e6,$e7,$e8,$e9,$e10,$e11,$e12,$e13){
		try{
			$query = "UPDATE tut_marks SET  t1 = ?, t2 = ?, t3 = ?, t4 = ?, t5 = ?, t6 = ?, t7 = ?, t8 = ?, t9 = ?, t10 = ?, t11 = ?, t12 = ?, t13 = ? WHERE sem_id = ? AND subject_no = ? AND std_roll_no = ? AND student_name = ? AND batch = ?";
			$entry = $db->prepare($query);			
			$entry->bindValue(1, $e1);
			$entry->bindValue(2, $e2);
			$entry->bindValue(3, $e3);
			$entry->bindValue(4, $e4);
			$entry->bindValue(5, $e5);
			$entry->bindValue(6, $e6);
			$entry->bindValue(7, $e7);
			$entry->bindValue(8, $e8);
			$entry->bindValue(9, $e9);
			$entry->bindValue(10, $e10);
			$entry->bindValue(11, $e11);
			$entry->bindValue(12, $e12);
			$entry->bindValue(13, $e13);			
			$entry->bindValue(14, $sem_id);
			$entry->bindValue(15, $subject_no);
			$entry->bindValue(16, $roll_no);
			$entry->bindValue(17, $student_name);			
			$entry->bindValue(18, $batch);
			if($entry->execute()){return "Successfully updated.";die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	
	function tutmarks_entry($db,$sem_id,$subject_no,$batch,$roll_no,$student_name){//,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11,$t12,$t13){
		try{
			$query = "INSERT INTO tut_marks SET batch = ?, sem_id = ?, subject_no = ?, std_roll_no = ?, student_name = ?";//, t1 = ?, t2 = ?, t3 = ?, t4 = ?, t5 = ?, t6 = ?, t7 = ?, t8 = ?, t9 = ?, t10 = ?, t11 = ?, t12 = ?, t13 = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $batch);
			$entry->bindValue(2, $sem_id);
			$entry->bindValue(3, $subject_no);
			$entry->bindValue(4, $roll_no);
			$entry->bindValue(5, $student_name);/*
			$entry->bindValue(6, $t1);
			$entry->bindValue(7, $t2);
			$entry->bindValue(8, $t3);
			$entry->bindValue(9, $t4);
			$entry->bindValue(10, $t5);
			$entry->bindValue(11, $t6);
			$entry->bindValue(12, $t7);
			$entry->bindValue(13, $t8);
			$entry->bindValue(14, $t9);
			$entry->bindValue(15, $t10);
			$entry->bindValue(16, $t11);
			$entry->bindValue(17, $t12);
			$entry->bindValue(18, $t13);		*/	
			if($entry->execute()){return "Successfully updated.";die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	//get_std_lab($db,$user_name,$sem_id,$lab1,$batch,100);
	
	
	
	function pi_teacher($db,$sem_id,$div,$subject_no,$subject_name,$pi_type,$pi_type_no,$teacher)
	{	try{$query = "INSERT INTO asst_quiz_teachers SET sem_id = ?, division = ?, subject_no = ?, subject_name = ?, pi_type = ?, pi_type_no = ?, teacher = ?";	
			$entry = $db->prepare($query);
			$entry->bindValue(1, $sem_id);
			$entry->bindValue(2, $div);
			$entry->bindValue(3, $subject_no);
			$entry->bindValue(4, $subject_name);
			$entry->bindValue(5, $pi_type);
			$entry->bindValue(6, $pi_type_no);
			$entry->bindValue(7, $teacher);	
			
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function co_pi_entry($db,$user_name,$program_id,$year_id,$semester,$subject_no,$subject_name,$ia,$ese,$assts,$tuts,$quiz,$ces)
	{	try{$query = "INSERT INTO co_pi_select SET user_name = ?, program_id = ?, year_id = ?, semester = ?, subject_no = ?, subject_name = ?, ia = ?, ese = ?, assignments = ?, tutorials = ?, quiz = ?, ces = ?";	
			$entry = $db->prepare($query);
			$entry->bindValue(1, $user_name);
			$entry->bindValue(2, $program_id);
			$entry->bindValue(3, $year_id);
			$entry->bindValue(4, $semester);
			$entry->bindValue(5, $subject_no);
			$entry->bindValue(6, $subject_name);
			$entry->bindValue(7, $ia);
			$entry->bindValue(8, $ese);
			$entry->bindValue(9, $assts);
			$entry->bindValue(10, $tuts);
			$entry->bindValue(11, $quiz);
			$entry->bindValue(12, $ces);		
			
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}

	function co_pi_teacher($db,$sem_id,$subject_no,$subject_name,$pi_type,$teacher1,$teacher2)
	{	try{$query = "INSERT INTO asst_quiz_teacher SET sem_id = ?, subject_no = ?, subject_name = ?, pi_type = ?, teacher1 = ?, teacher2 = ?";	
			$entry = $db->prepare($query);
			$entry->bindValue(1, $sem_id);			
			$entry->bindValue(2, $subject_no);
			$entry->bindValue(3, $subject_name);
			$entry->bindValue(4, $pi_type);
			$entry->bindValue(5, $teacher1);
			$entry->bindValue(6, $teacher2);
			
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function lo_pi_entry($db,$user_name,$program_id,$year_id,$semester,$subject_no,$subject_name,$practs,$tw,$ese,$miniproject,$les,$assignments,$quiz,$seminar)
	{	try{$query = "INSERT INTO lo_pi_select SET user_name = ?, program_id = ?, year_id = ?, semester = ?, subject_no = ?, subject_name = ?, practs = ?, tw = ?, ese = ?, miniproject = ?, les = ?, assignments = ?, quiz = ?, seminar = ?";	
			$entry = $db->prepare($query);
			$entry->bindValue(1, $user_name);
			$entry->bindValue(2, $program_id);
			$entry->bindValue(3, $year_id);
			$entry->bindValue(4, $semester);
			$entry->bindValue(5, $subject_no);
			$entry->bindValue(6, $subject_name);
			$entry->bindValue(7, $practs);
			$entry->bindValue(8, $tw);
			$entry->bindValue(9, $ese);
			$entry->bindValue(10, $miniproject);
			$entry->bindValue(11, $les);
			$entry->bindValue(12, $assignments);
			$entry->bindValue(13, $quiz);	
			$entry->bindValue(14, $seminar);
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	
	function get_std_lab($db,$user_name,$sem_id,$subject_no,$batch,$limit){
		try {
			$query = "SELECT * FROM lab_marks WHERE user_name = '$user_name' and sem_id = '$sem_id'  AND subject_no = '$subject_no' AND batch = '$batch'";
			$stmt = $db->prepare( $query );			
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (Exception $e) {return "ERROR". $e->getMessage();}
	}
	
	function get_std_tut($db,$sem_id,$subject_no,$batch,$limit){
		try {
			$query = "SELECT * FROM tut_marks WHERE sem_id = '$sem_id'  AND subject_no = '$subject_no' AND batch = '$batch'";
			$stmt = $db->prepare( $query );			
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (Exception $e) {return "ERROR". $e->getMessage();}
	}
	
function asstmarks_entry($db,$asst_no,$sem_id,$subject_no,$std_roll_no,$student_name)
	{	try{$query = "INSERT INTO assignment_marks SET asst_no = ?, sem_id = ?, subject_no = ?, std_roll_no = ?, student_name = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $asst_no);
			$entry->bindValue(2, $sem_id);
			$entry->bindValue(3, $subject_no);
			$entry->bindValue(4, $std_roll_no);
			$entry->bindValue(5, $student_name);
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	//asstmarks_update($db,$asst_no,$sem_id,$subject_no,$roll_no[$x],$student_name,$m1,$m2,$m3,$m4,$total);
	function asstmarks_update($db,$asst_no,$sem_id,$subject_no,$roll_no,$student_name,$m1,$m2,$m3,$m4,$total){ 
	try{					
		$query = "UPDATE assignment_marks SET m1 = ? ,m2 = ? ,m3 = ? ,m4 = ? ,total= ? WHERE asst_no = ? AND sem_id = ? AND subject_no = ? AND std_roll_no = ? AND student_name = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $m1);
			$entry->bindValue(2, $m2);
			$entry->bindValue(3, $m3);
			$entry->bindValue(4, $m4);			
			$entry->bindValue(5, $total);
			$entry->bindValue(6, $asst_no);
			$entry->bindValue(7, $sem_id);			
			$entry->bindValue(8, $subject_no);
			$entry->bindValue(9, $roll_no);	
			$entry->bindValue(10, $student_name);	
			
			if($entry->execute()){				return "Successfully Inserted.";				die();
			}else{				return "Unable to Insert! Try again please.";			}
			}catch(PDOException $e){			return "Error: " . $e->getMessage();		}
	}
	
	function clearances($db,$mentor,$semester,$division,$batch,$std_roll_no,$student_name,$info,$undertaking,$marksheets,$co_cur,$extra_cur,$leaves,$membership,$internship,$score_card,$placement,$entreprener,$exits,$flag)
	{	try{
		$query = "INSERT INTO clearance SET mentor = ?, semester = ?, division = ?, batch = ?, std_roll_no = ?, student_name = ?, student_info = ?, undertaking = ?, marksheets = ?, co_cur = ?, extra_cur = ?, leaves = ?, membership = ?, internship = ?, score_card = ?, placement = ?, entreprener = ?, survey = ?, flag = ?";

			$entry = $db->prepare($query);
			$entry->bindValue(1, $mentor);
			$entry->bindValue(2, $semester);
			$entry->bindValue(3, $division);
			$entry->bindValue(4, $batch);
			$entry->bindValue(5, $std_roll_no);
			$entry->bindValue(6, $student_name);
			$entry->bindValue(7, $info);
			$entry->bindValue(8, $undertaking);
			$entry->bindValue(9, $marksheets);
			$entry->bindValue(10, $co_cur);
			$entry->bindValue(11, $extra_cur);
			$entry->bindValue(12, $leaves);
			$entry->bindValue(13, $membership);
			$entry->bindValue(14, $internship);
			$entry->bindValue(15, $score_card);
			$entry->bindValue(16, $placement);
			$entry->bindValue(17, $entreprener);
			$entry->bindValue(18, $exits);
			$entry->bindValue(18, $flag);
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function results_update($db, $mentor, $student_name, $sem1, $sem2, $sem3, $sem4, $sem5, $sem6, $sem7, $sem8, $msem1, $msem2, $msem3, $msem4, $msem5, $msem6, $msem7, $msem8, $ktlive, $ktdead, $pass_out){ 
	try{					
		$query = "UPDATE results SET sem1 = ?, sem2 = ?, sem3 = ?, sem4 = ?, sem5 = ?, sem6 = ?, sem7 = ?, sem8 = ?, msem1 = ?, msem2 = ?, msem3 = ?, msem4 = ?, msem5 = ?, msem6 = ?, msem7 = ?, msem8 = ?, ktlive = ?, ktdead = ?, pass_out = ? WHERE mentor = ? AND student_name = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $sem1);
			$entry->bindValue(2, $sem2);
			$entry->bindValue(3, $sem3);
			$entry->bindValue(4, $sem4);			
			$entry->bindValue(5, $sem5);
			$entry->bindValue(6, $sem6);
			$entry->bindValue(7, $sem7);
			$entry->bindValue(8, $sem8);
			$entry->bindValue(9, $msem1);
			$entry->bindValue(10, $msem2);
			$entry->bindValue(11, $msem3);
			$entry->bindValue(12, $msem4);
			$entry->bindValue(13, $msem5);
			$entry->bindValue(14, $msem6);
			$entry->bindValue(15, $msem7);
			$entry->bindValue(16, $msem8);
			$entry->bindValue(17, $ktlive);
			$entry->bindValue(18, $ktdead);			
			$entry->bindValue(19, $pass_out);
			$entry->bindValue(20, $mentor);			
			$entry->bindValue(21, $student_name);	
			
			if($entry->execute()){				return "Successfully Inserted.";				die();
			}else{				return "Unable to Insert! Try again please.";			}
			}catch(PDOException $e){			return "Error: " . $e->getMessage();		}
	}
	
	function results_entry($db,$mentor,$student_name,$pass_out)
	{	try{$query = "INSERT INTO results SET mentor = ?, student_name = ?, pass_out = ?, flag = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $mentor);
			$entry->bindValue(2, $student_name);
			$entry->bindValue(3, $pass_out);
			$flag = 0;
			$entry->bindValue(4, $flag);
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function clearance_entry($db,$mentor,$semester,$division,$batch,$std_roll_no,$student_name,$flag,$exam)
	{	try{
			$query = "INSERT INTO clearance SET mentor = ?, semester = ?, division = ?, batch = ?, std_roll_no = ?, student_name = ?, flag = ?, exam = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $mentor);
			$entry->bindValue(2, $semester);
			$entry->bindValue(3, $division);
			$entry->bindValue(4, $batch);
			$entry->bindValue(5, $std_roll_no);
			$entry->bindValue(6, $student_name);
			$entry->bindValue(7, $flag);
			$entry->bindValue(8, $exam);
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function clearance_update($db,$mentor,$semester,$division,$batch,$std_roll_no,$student_name,$info,$undertaking,$marksheets,$co_cur,$extra_cur,$leaves,$membership,$internship,$score_card,$placement,$entreprener,$exits,$flag,$exam)
	{	try{
		$query = "UPDATE clearance SET student_info = ?, undertaking = ?, marksheets = ?, co_cur = ?, extra_cur = ?, leaves = ?, membership = ?, internship = ?, score_card = ?, placement = ?, entreprener = ?, survey = ?, flag = ? where mentor = ? and semester = ? and division = ? and batch = ? and std_roll_no = ? and student_name = ? and exam = ?";

			$entry = $db->prepare($query);
			$entry->bindValue(1, $info);
			$entry->bindValue(2, $undertaking);
			$entry->bindValue(3, $marksheets);
			$entry->bindValue(4, $co_cur);
			$entry->bindValue(5, $extra_cur);
			$entry->bindValue(6, $leaves);
			$entry->bindValue(7, $membership);
			$entry->bindValue(8, $internship);
			$entry->bindValue(9, $score_card);
			$entry->bindValue(10, $placement);
			$entry->bindValue(11, $entreprener);
			$entry->bindValue(12, $exits);
			$entry->bindValue(13, $flag);			
			$entry->bindValue(14, $mentor);
			$entry->bindValue(15, $semester);
			$entry->bindValue(16, $division);
			$entry->bindValue(17, $batch);
			$entry->bindValue(18, $std_roll_no);
			$entry->bindValue(19, $student_name);
			$entry->bindValue(20, $exam);
			
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function mentee_update($db,$mentor,$semester,$division,$batch,$std_roll_no,$student_name)
	{	try{
		$query = "UPDATE student_table SET mentor = ? where semester = ? and division = ? and batch = ? and std_roll_no = ? and student_name = ?";

			$entry = $db->prepare($query);
			$entry->bindValue(1, $mentor);
			$entry->bindValue(2, $semester);
			$entry->bindValue(3, $division);
			$entry->bindValue(4, $batch);
			$entry->bindValue(5, $std_roll_no);
			$entry->bindValue(6, $student_name);
			
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
function book_issue1($db,$user_name,$book_no,$book_name,$staff_id,$staff_name,$date1,$status)
	{
		try{
			$query = "INSERT INTO books_issued SET user_name = ?, book_no = ?, book_title = ?, staff_id = ?, staff_name = ?, date1 = ?, status = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $user_name);
			$entry->bindValue(2, $book_no);
			$entry->bindValue(3, $book_name);
			$entry->bindValue(4, $staff_id);
			$entry->bindValue(5, $staff_name);
			$entry->bindValue(6, $date1);		
			$entry->bindValue(7, $status);
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function book_issue2($db,$book_no,$book_name,$availability)
	{
		try{
			$query = "UPDATE books SET availability = ? where book_no = ? and book_title = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $availability);
			$entry->bindValue(2, $book_no);
			$entry->bindValue(3, $book_name);	
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function book_return1($db,$user_name,$book_no,$book_name,$staff_id,$staff_name,$date2,$status)
	{
		try{
			$query = "UPDATE books_issued SET user_name2 = ?, date2 = ?, status = ? where book_no = ? and book_title = ? and staff_id = ? and staff_name = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $user_name);
			$entry->bindValue(2, $date2);
			$entry->bindValue(3, $status);
			$entry->bindValue(4, $book_no);
			$entry->bindValue(5, $book_name);
			$entry->bindValue(6, $staff_id);
			$entry->bindValue(7, $staff_name);
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
	function book_return2($db,$book_no,$book_name,$availability)
	{
		try{
			$query = "UPDATE books SET availability = ? where book_no = ? and book_title = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $availability);
			$entry->bindValue(2, $book_no);
			$entry->bindValue(3, $book_name);	
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	function book_add($db,$user_name,$domain_no,$domain_name,$book_no,$book_name,$author,$publication,$availability,$deleted){
		try{
			$query = "INSERT INTO books SET domain_no = ?, domain_name = ?, book_no = ?, book_title = ?, author = ?, publication = ?, availability = ?, deleted = ?, user_name = ?";
			$entry = $db->prepare($query);
			$entry->bindValue(1, $domain_no);
			$entry->bindValue(2, $domain_name);
			$entry->bindValue(3, $book_no);
			$entry->bindValue(4, $book_name);
			$entry->bindValue(5, $author);
			$entry->bindValue(6, $publication);
			$entry->bindValue(7, $availability);
			$entry->bindValue(8, $deleted);
			$entry->bindValue(9, $user_name);
			if($entry->execute()){
				return "Successfully updated.";
				die();
			}else{return "Unable to update! Try again please.";}
		}catch(PDOException $e){return "Error: " . $e->getMessage();}
	}
	
}?>



