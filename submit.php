<?php
	include 'includes/session.php';
	include 'includes/header.php';

	$sql = "SELECT * FROM admin";
	$query = $conn->query($sql);
	$status = 1;
	while($row = $query->fetch_assoc()){
		$can_reg_start_time = $row['can_reg_start_time'];
		$can_reg_end_time = $row['can_reg_end_time'];
	}

	if(strtotime($can_reg_start_time) > strtotime(date('Y-m-d H:i:s'))){
		$_SESSION['error'] = "The registration period has not started, come back later";
		header('location: home.php');
	}elseif(strtotime($can_reg_end_time) < strtotime(date('Y-m-d H:i:s'))){
		$_SESSION['error'] = "Sorry, the registration period has ended.";
		header('location: home.php');
	}

	$sql = "SELECT * FROM candidates where email='".$_POST['email']."'";
	$vquery = $conn->query($sql);
	if($vquery->num_rows > 0){
		$_SESSION['error'] = $_POST['email'].' email already exists.';
		header('location: home.php');
		die;
	}

	if(isset($_POST['add_candidate'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$house = $_POST['house'];
		$position = implode(',',$_POST['position']);
		$merit_achievements = $_POST['merit_achievements'];
		$sports_achievements = $_POST['sports_achievements'];
		$cocurricular_achievements = $_POST['cocurricular_achievements'];
		$description1 = $_POST['description1'];
		$description2 = $_POST['description2'];
		$photoname = $_FILES['photo']['name'];
		if(!empty($photoname)){
			$extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
			$name=rand(100000000000,10000000000000000);
			$photoname = $name.".".$extension;			
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photoname);	
		}
		$merit_evidence = $_FILES['merit_evidence']['name'];
		if(!empty($merit_evidence)){
			$extension = pathinfo($_FILES["merit_evidence"]["name"], PATHINFO_EXTENSION);
			$name=rand(100000000000,10000000000000000);
			$merit_evidence = $name.".".$extension;	
			move_uploaded_file($_FILES['merit_evidence']['tmp_name'], 'images/'.$merit_evidence);	
		}
		$sports_evidence = $_FILES['sports_evidence']['name'];
		if(!empty($sports_evidence)){
			$extension = pathinfo($_FILES["sports_evidence"]["name"], PATHINFO_EXTENSION);
			$name=rand(100000000000,10000000000000000);
			$sports_evidence = $name.".".$extension;				
			move_uploaded_file($_FILES['sports_evidence']['tmp_name'], 'images/'.$sports_evidence);	
		}
		$cocurricular_evidence = $_FILES['cocurricular_evidence']['name'];
		if(!empty($cocurricular_evidence)){
			$extension = pathinfo($_FILES["cocurricular_evidence"]["name"], PATHINFO_EXTENSION);
			$name=rand(100000000000,10000000000000000);
			$cocurricular_evidence = $name.".".$extension;			
			move_uploaded_file($_FILES['cocurricular_evidence']['tmp_name'], 'images/'.$cocurricular_evidence);	
		}

		$voter_id = $voter['id'];
		$sql = "INSERT INTO candidates (position_id, firstname, lastname, photo, email, house, merit_achievements,sports_achievements,cocurricular_achievements,merit_evidence,sports_evidence,cocurricular_evidence,description1,description2,voter_id) VALUES ('$position', '$firstname', '$lastname', '$photoname','$email', '$house', '$merit_achievements','$sports_achievements','$cocurricular_achievements','$merit_evidence','$sports_evidence','$cocurricular_evidence','$description1','$description2','$voter_id')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate added successfully';
			$_SESSION['is_can'] = 1;
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: home.php');
?>