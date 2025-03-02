
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php 
$sql = "SELECT * FROM admin";
$query = $conn->query($sql);
$status = 1;
while($row = $query->fetch_assoc()){
	$can_reg_start_time = $row['can_reg_start_time'];
	$can_reg_end_time = $row['can_reg_end_time'];
	$can_reg_grade = $row['can_reg_grade'];
}

$sql = "SELECT * FROM voters WHERE id = '".$voter['id']."'";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
if($row["grade"] != $can_reg_grade){
	$_SESSION['error'] = "You don't belong to the ".$can_reg_grade."th grade.";
	header('location: home.php');
	die;
}

$sql = "SELECT * FROM candidates WHERE voter_id = '".$voter['id']."'";
$vquery = $conn->query($sql);
if($vquery->num_rows > 0){
	$_SESSION['error'] = "You are already registrated as a candidate.";
	header('location: home.php');
	die;
}
if(strtotime($can_reg_start_time) > strtotime(date('Y-m-d H:i:s'))){
	$_SESSION['error'] = "The registration period has not started, come back later";
	header('location: home.php');
	die;
}elseif(strtotime($can_reg_end_time) < strtotime(date('Y-m-d H:i:s'))){
	$_SESSION['error'] = "Sorry, the registration period has ended.";
	header('location: home.php');
	die;
}



?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	      	<?php
	      		$parse = parse_ini_file('admin/election_title.ini', FALSE, INI_SCANNER_RAW);
    			$title = $parse['election_title'];
	      	?>
	      	<h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b></h1>
	        <div class="row">
	        	<div class="col-sm-10 col-sm-offset-1">
	        		<?php
				        if(isset($_SESSION['error'])){
				        	?>
				        	<div class="alert alert-danger alert-dismissible">
				        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        	<ul>
					        		<?php
					        			foreach($_SESSION['error'] as $error){
					        				echo "
					        					<li>".$error."</li>
					        				";
					        			}
					        		?>
					        	</ul>
					        </div>
				        	<?php
				         	unset($_SESSION['error']);

				        }
				        if(isset($_SESSION['success'])){
				          	echo "
				            	<div class='alert alert-success alert-dismissible'>
				              		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				              		<h4><i class='icon fa fa-check'></i> Success!</h4>
				              	".$_SESSION['success']."
				            	</div>
				          	";
				          	unset($_SESSION['success']);
				        }

				    ?>
 
				    <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
		        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        	<span class="message"></span>
			        </div>
						<!-- Voting Ballot -->
						<form method="POST" id="registerForm" action="submit.php" enctype="multipart/form-data">
							<div class="row">
								<div class="box box-solid">
									<div class="box-body">
										<div class="col-xs-6">
											<div class="form-group">
												<label for="exampleInputFirst">First Name</label><span style="color:#ff0000">*</span>
												<input required name="firstname" type="text" class="form-control" id="exampleInputFirst" aria-describedby="emailHelp" placeholder="Enter first Name">
											</div>
											<div class="form-group">
												<label for="exampleInputLast">Last Name</label><span style="color:#ff0000">*</span>
												<input required name="lastname" type="text" class="form-control" id="exampleInputLast" aria-describedby="emailHelp" placeholder="Enter last Name">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Email</label><span style="color:#ff0000">*</span>
												<input required name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
											</div>
											<div class="form-group">
												<label for="exampleInputHouse">House</label><span style="color:#ff0000">*</span>
												<input required name="house" type="text" class="form-control" id="exampleInputHouse" aria-describedby="emailHelp" placeholder="Enter house">
											</div>
											<div class="form-group">
												<label for="photo" class="control-label">Photo</label><span style="color:#ff0000">*</span>
												<input required type="file" id="photo" name="photo" accept="image/jpeg, image/png">
											</div>	
											<div class="form-group">
												<label for="exampleInputEmail1">Positions(You can select three positions only)</label><span style="color:#ff0000">*</span>
												<select required class="form-control" id="position" name="position[]" required multiple>
													<?php
													$sql = "SELECT * FROM positions";
													$query = $conn->query($sql);
													while($row = $query->fetch_assoc()){
														echo "
														<option value='".$row['id']."'>".$row['description']."</option>
														";
													}
													?>
												</select>												
											</div>											
										</div>
										<div class="col-xs-6">
											<div class="form-group">
												<label for="exampleInputMerit">Merit Achievement</label><span style="color:#ff0000">*</span>
												<input required name="merit_achievements" type="text" class="form-control" id="exampleInputMerit" aria-describedby="emailHelp" placeholder="Enter merit achievement">
											</div>																	
											<div class="form-group">
												<label for="merit_evidence" class="control-label">Upload evidence</label><span style="color:#ff0000">*</span>
												<input required type="file" id="evidence" name="merit_evidence" accept=".pdf">
											</div>
											<div class="form-group">
												<label for="exampleInputAchievements">Sports achievements</label><span style="color:#ff0000">*</span>
												<input required name="sports_achievements" type="text" class="form-control" id="exampleInputAchievements" aria-describedby="emailHelp" placeholder="Enter sports achievements">
											</div>
											<div class="form-group">
												<label for="sports_evidence" class="control-label">Upload evidence</label><span style="color:#ff0000">*</span>
												<input required type="file" id="evidence" name="sports_evidence"  accept=".pdf">
											</div>
											<div class="form-group">
												<label for="exampleInputcurricular">Co-curricular achievements</label><span style="color:#ff0000">*</span>
												<input required name="cocurricular_achievements" type="text" class="form-control" id="exampleInputcurricular" aria-describedby="emailHelp" placeholder="Enter co-curricular achievements">
											</div>
											<div class="form-group">
												<label for="cocurricular_evidence" class="control-label">Upload evidence</label><span style="color:#ff0000">*</span>
												<input required type="file" id="evidence" name="cocurricular_evidence" accept=".pdf">
											</div>									
										</div>
										<div class="col-xs-12">
											<div class="form-group">
												<label for="exampleInputcouncil">Why do you aspire to become a part of the student council ? (Minimum words: 50) </label><span style="color:#ff0000">*</span>
												<textarea required name="description1" class="form-control" id="exampleInputcouncil" aria-describedby="emailHelp" placeholder="Description.." rows="5"></textarea>
											</div>
											<div class="form-group">
												<label for="exampleInputcouncil">What changes do you aim to bring in school if you become a part of the Student Council? (Words: 50)</label><span style="color:#ff0000">*</span>
												<textarea required name="description2" class="form-control" id="exampleInputcouncil" aria-describedby="emailHelp" placeholder="Description.." rows="5"></textarea>
											</div>
										</div>	
									</div>	
								</div>							
							</div>							
							<div class="text-center">
								<button type="submit" class="btn btn-primary btn-flat" name="add_candidate"><i class="fa fa-check-square-o"></i> Submit</button>
							</div>
						</form>
						<!-- End Voting Ballot -->
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/ballot_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('.content').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	});

	$(document).on('click', '.reset', function(e){
	    e.preventDefault();
	    var desc = $(this).data('desc');
	    $('.'+desc).iCheck('uncheck');
	});

	$(document).on('click', '.platform', function(e){
		e.preventDefault();
		$('#platform').modal('show');
		var platform = $(this).data('platform');
		var fullname = $(this).data('fullname');
		$('.candidate').html(fullname);
		$('#plat_view').html(platform);
	});

	$('#preview').click(function(e){
		e.preventDefault();
		var form = $('#ballotForm').serialize();
		if(form == ''){
			$('.message').html('You must vote atleast one candidate');
			$('#alert').show();
		}
		else{
			$.ajax({
				type: 'POST',
				url: 'preview.php',
				data: form,
				dataType: 'json',
				success: function(response){
					if(response.error){
						var errmsg = '';
						var messages = response.message;
						for (i in messages) {
							errmsg += messages[i]; 
						}
						$('.message').html(errmsg);
						$('#alert').show();
					}
					else{
						$('#preview_modal').modal('show');
						$('#preview_body').html(response.list);
					}
				}
			});
		}
		
	});

});

$(document).ready(function() {
  var last_valid_selection = null;
  $('#position').change(function(event) {
	if ($(this).val().length > 3) {
	  $(this).val(last_valid_selection);
	} else {
	  last_valid_selection = $(this).val();
	}
  });
});
</script>
</body>
</html>