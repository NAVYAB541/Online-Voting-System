<?php
	include 'includes/session.php';
	include '../library/php-excel-reader/excel_reader2.php';
	include '../library/SpreadsheetReader.php';

	if(isset($_POST['add'])){
		$uploadFilePath = 'uploads/'.basename($_FILES['excel']['name']);
		move_uploaded_file($_FILES['excel']['tmp_name'], $uploadFilePath);
		$Reader = new SpreadsheetReader($uploadFilePath);
		$totalSheet = count($Reader->sheets());
	
		$sql = '';
		/* For Loop for all sheets */
		for($i=0;$i<$totalSheet;$i++){
			$Reader->ChangeSheet($i);
			foreach ($Reader as $Row){
				if(isset($Row[0]) && !empty($Row[0]) && $Row[0] != 'First Name'){
					$firstname = isset($Row[0]) ? $Row[0] : '';
					$lastname = isset($Row[1]) ? $Row[1] : '';
					$password = isset($Row[2]) ?  password_hash($Row[2], PASSWORD_DEFAULT) : '';
					$voter = isset($Row[3]) ? $Row[3] : '';
					$grade = isset($Row[4]) ? $Row[4] : '';
					$sql = "INSERT INTO voters (voters_id, password, firstname, lastname, grade) VALUES ('$voter', '$password', '$firstname', '$lastname', '$grade')";
					if($conn->query($sql)){
						$_SESSION['success'] = 'Voters added successfully';
					}
					else{
						$_SESSION['error'] = $conn->error;
					}
			
				}
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: voters.php');
?>