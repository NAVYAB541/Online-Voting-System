<!-- Description -->
<div class="modal fade" id="reset_candidates">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Reseting...</b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                  <p>RESET CANDIDATES</p>
                  <h4>This will delete all the registered candidates </h4>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <a href="candidates_reset.php" class="btn btn-danger btn-flat"><i class="fa fa-refresh"></i> Reset</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="platform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
                <p id="desc"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Candidate</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="candidates_add.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Positions(You can select three positions only)</label>

                    <div class="col-sm-9">
                      <select class="form-control position" id="position" name="position[]" required multiple>
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
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" accept="image/jpeg, image/png">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input required name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">                    
                    </div>
                </div>                
                <div class="form-group">
                    <label for="exampleInputHouse" class="col-sm-3 control-label">House</label>
                    <div class="col-sm-9">
                        <input required name="house" type="text" class="form-control" id="exampleInputHouse" aria-describedby="emailHelp" placeholder="Enter house">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputMerit" class="col-sm-3 control-label">Merit Achievement</label>
                    <div class="col-sm-9">
                        <input required name="merit_achievements" type="text" class="form-control" id="exampleInputMerit" aria-describedby="emailHelp" placeholder="Enter merit achievement">
                    </div>																	
                </div>
                <div class="form-group">
                    <label for="merit_evidence" class="col-sm-3 control-label">Upload evidence</label>
                    <div class="col-sm-9">
                        <input required type="file" id="evidence" name="merit_evidence" accept=".pdf">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputAchievements" class="col-sm-3 control-label">Sports achievements</label>
                    <div class="col-sm-9">
                        <input required name="sports_achievements" type="text" class="form-control" id="exampleInputAchievements" aria-describedby="emailHelp" placeholder="Enter sports achievements">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sports_evidence" class="col-sm-3 control-label">Upload evidence</label>
                    <div class="col-sm-9">
                        <input required type="file" id="evidence" name="sports_evidence"  accept=".pdf">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputcurricular" class="col-sm-3 control-label">Co-curricular achievements</label>
                    <div class="col-sm-9">
                        <input required name="cocurricular_achievements" type="text" class="form-control" id="exampleInputcurricular" aria-describedby="emailHelp" placeholder="Enter co-curricular achievements">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cocurricular_evidence" class="col-sm-3 control-label">Upload evidence</label>
                    <div class="col-sm-9">
                        <input required type="file" id="evidence" name="cocurricular_evidence" accept=".pdf">
                    </div>									
                </div>
                <div class="form-group">
                    <label for="exampleInputcouncil" class="col-sm-3 control-label">Why do you aspire to become a part of the student council ? (Minimum words: 50) </label>
                    <div class="col-sm-9">
                        <textarea required name="description1" class="form-control" id="exampleInputcouncil" aria-describedby="emailHelp" placeholder="Description.." rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputcouncil" class="col-sm-3 control-label">What changes do you aim to bring in school if you become a part of the Student Council? (Words: 50)</label>
                    <div class="col-sm-9">
                        <textarea required name="description2" class="form-control" id="exampleInputcouncil" aria-describedby="emailHelp" placeholder="Description.." rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Candidate</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="candidates_edit.php" enctype="multipart/form-data">
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_position" class="col-sm-3 control-label">Positions(You can select three positions only)</label>

                    <div class="col-sm-9">
                      <select class="form-control position" id="edit_position" name="position[]" required multiple>
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
                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input required name="email" type="email" class="form-control" id="edit_exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">                    
                    </div>
                </div>                
                <div class="form-group">
                    <label for="exampleInputHouse" class="col-sm-3 control-label">House</label>
                    <div class="col-sm-9">
                        <input required name="house" type="text" class="form-control" id="edit_exampleInputHouse" aria-describedby="emailHelp" placeholder="Enter house">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputMerit" class="col-sm-3 control-label">Merit Achievement</label>
                    <div class="col-sm-9">
                        <input required name="merit_achievements" type="text" class="form-control" id="edit_exampleInputMerit" aria-describedby="emailHelp" placeholder="Enter merit achievement">
                    </div>																	
                </div>
                <div class="form-group">
                    <label for="exampleInputAchievements" class="col-sm-3 control-label">Sports achievements</label>
                    <div class="col-sm-9">
                        <input required name="sports_achievements" type="text" class="form-control" id="edit_exampleInputAchievements" aria-describedby="emailHelp" placeholder="Enter sports achievements">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputcurricular" class="col-sm-3 control-label">Co-curricular achievements</label>
                    <div class="col-sm-9">
                        <input required name="cocurricular_achievements" type="text" class="form-control" id="edit_exampleInputcurricular" aria-describedby="emailHelp" placeholder="Enter co-curricular achievements">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputcouncil" class="col-sm-3 control-label">Why do you aspire to become a part of the student council ? (Minimum words: 50) </label>
                    <div class="col-sm-9">
                        <textarea required name="description1" class="form-control" id="edit_exampleInputcouncil1" aria-describedby="emailHelp" placeholder="Description.." rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputcouncil" class="col-sm-3 control-label">What changes do you aim to bring in school if you become a part of the Student Council? (Words: 50)</label>
                    <div class="col-sm-9">
                        <textarea required name="description2" class="form-control" id="edit_exampleInputcouncil2" aria-describedby="emailHelp" placeholder="Description.." rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="candidates_delete.php">
                <input type="hidden" class="id" name="id">
                <div class="text-center">
                    <p>DELETE CANDIDATE</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="candidates_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required accept="image/jpeg, image/png">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>



<!-- Add -->
<div class="modal fade" id="addRegistration">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Registration Settings</b></h4>
            </div>
            <?php
                $sql = "SELECT * FROM admin";
                $query = $conn->query($sql);
                $status = 1;
                while($row = $query->fetch_assoc()){
                    $can_reg_start_time = $row['can_reg_start_time'];
                    $can_reg_end_time = $row['can_reg_end_time'];
                    $can_reg_grade = $row['can_reg_grade'];
                }
            ?>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="candidates_reg_edit.php">
                <div class="form-group">
                    <label for="grade_register" class="col-sm-3 control-label">Which grade can register?</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="grade_register" name="can_reg_grade"  min="1" max="12" value="<?php echo $can_reg_grade ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_time" class="col-sm-4 control-label">Registration Start Time</label>

                    <div class="col-sm-8">
                      <input value="<?php echo $can_reg_start_time ?>" type="text" class="form-control datetimepicker1" id="start_time" name="can_reg_start_time" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_time" class="col-sm-4 control-label">Registration End Time</label>

                    <div class="col-sm-8">
                      <input value="<?php echo $can_reg_end_time ?>" type="text" class="form-control datetimepicker1" id="end_time" name="can_reg_end_time" required autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="edit"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>     


<!-- Update Photo -->
<div class="modal fade" id="edit_merit_evidence">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="candidates_merit.php" enctype="multipart/form-data">
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="merit_evidence" class="col-sm-3 control-label">Merit Evidence</label>

                    <div class="col-sm-9">
                      <input type="file" id="merit_evidence" name="merit_evidence" required  accept=".pdf">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_sports_evidence">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="candidates_sports.php" enctype="multipart/form-data">
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="sports_evidence" class="col-sm-3 control-label">Sports Evidence</label>

                    <div class="col-sm-9">
                      <input type="file" id="sports_evidence" name="sports_evidence" required  accept=".pdf">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_cocurricular_evidence">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="candidates_cocurricular.php" enctype="multipart/form-data">
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="cocurricular_evidence" class="col-sm-3 control-label">Co-curricular Evidence</label>

                    <div class="col-sm-9">
                      <input type="file" id="cocurricular_evidence" name="cocurricular_evidence" required  accept=".pdf">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>