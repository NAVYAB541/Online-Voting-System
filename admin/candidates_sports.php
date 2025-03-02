<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['sports_evidence']['name'];
		if(!empty($filename)){
			$extension = pathinfo($_FILES["sports_evidence"]["name"], PATHINFO_EXTENSION);
			$name=rand(100000000000,10000000000000000);
			$filename = $name.".".$extension;			
			move_uploaded_file($_FILES['sports_evidence']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE candidates SET sports_evidence = '$filename' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Sports evidence updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select candidate to update evidence first';
	}

	header('location: candidates.php');
?>