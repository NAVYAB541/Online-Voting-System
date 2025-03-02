<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Candidates List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Candidates</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            <a href="#addRegistration" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Registration Settings</a>
            <a href="#reset_candidates" data-toggle="modal" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Position</th>
                  <th>Photo</th>
                  <th>Merit Evidence</th>
                  <th>Sports Evidence</th>
                  <th>Co-curricular Evidence</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Create At</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, candidates.id AS canid FROM candidates ORDER BY id DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                      $merit_evidence = (!empty($row['merit_evidence'])) ? '../images/'.$row['merit_evidence'] : '';
                      $sports_evidence = (!empty($row['sports_evidence'])) ? '../images/'.$row['sports_evidence'] : '';
                      $cocurricular_evidence = (!empty($row['cocurricular_evidence'])) ? '../images/'.$row['cocurricular_evidence'] : '';
                      $positions = explode(',',$row['position_id']);
                      $position_name=[];
                      for($j=0;$j<count($positions);$j++){
                        $sql = "SELECT * FROM positions WHERE id = '$positions[$j]'";
                        $query1 = $conn->query($sql);
                        $row1 = $query1->fetch_assoc();
                        $position_name[]=$row1['description'];
                      }
                      
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".implode(',',$position_name)."</td>
                          <td>
                            <img src='".$image."' width='30px' height='30px'>
                            <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='".$row['canid']."'><span class='fa fa-edit'></span></a>
                          </td>
                          <td>
                            <a href='".$merit_evidence."' target='_blank'>Download</a>
                            <a href='#edit_merit_evidence' data-toggle='modal' class='pull-right photo' data-id='".$row['canid']."'><span class='fa fa-edit'></span></a>
                          </td>
                          <td>
                            <a href='".$sports_evidence."' target='_blank'>Download</a>
                            <a href='#edit_sports_evidence' data-toggle='modal' class='pull-right photo' data-id='".$row['canid']."'><span class='fa fa-edit'></span></a>
                          </td>
                          <td>
                            <a href='".$cocurricular_evidence."' target='_blank'>Download</a>
                            <a href='#edit_cocurricular_evidence' data-toggle='modal' class='pull-right photo' data-id='".$row['canid']."'><span class='fa fa-edit'></span></a>
                          </td>
                          <td>".$row['firstname']."</td>
                          <td>".$row['lastname']."</td>
                          <td>".$row['created_at']."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['canid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['canid']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/candidates_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.platform', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'candidates_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      var posi = (response.position_id).split(',');
      for(var i=0;i<posi.length;i++){
        $('#edit_position option[value=' + posi[i] + ']').attr('selected', true);     
      }
      $('.id').val(response.canid);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('.fullname').html(response.firstname+' '+response.lastname);
      $('#edit_exampleInputEmail1').val(response.email);
      $('#edit_exampleInputHouse').val(response.house);
      $('#edit_exampleInputMerit').val(response.merit_achievements);
      $('#edit_exampleInputAchievements').val(response.sports_achievements);
      $('#edit_exampleInputcurricular').val(response.cocurricular_achievements);
      $('#edit_exampleInputcouncil1').html(response.description1);
      $('#edit_exampleInputcouncil2').html(response.description2);
    }
  });
}
</script>
<script type="text/javascript">
    $(function () {
      $('.datetimepicker1').datetimepicker({
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        format: "yyyy-mm-dd hh:ii:ss"
      });
    });

$(document).ready(function() {
  var last_valid_selection = null;
  $('.position').change(function(event) {
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
