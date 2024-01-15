<!-- Modal For Add Department -->
<div class="modal fade" id="modalForAddCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addCourseFrm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Department</label>
              <input type="" name="course_name" id="course_name" class="form-control" placeholder="Input Department" required="" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Now</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal For Update Department -->
<div class="modal fade myModal" id="updateCourse-<?php echo $selCourseRow['cou_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <form class="refreshFrm" id="addCourseFrm" method="post">
      <div class="modal-content myModal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update ( <?php echo $selCourseRow['cou_name']; ?> )</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Department</label>
              <input type="" name="course_name" id="course_name" class="form-control" value="<?php echo $selCourseRow['cou_name']; ?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Now</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal For Add Exam -->
<div class="modal fade" id="modalForExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addExamFrm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Select Department</label>
              <select class="form-control" name="courseSelected">
                <option value="0">Select Department</option>
                <?php
                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC");
                if ($selCourse->rowCount() > 0) {
                  while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $selCourseRow['cou_id']; ?>"><?php echo $selCourseRow['cou_name']; ?></option>
                  <?php }
                } else { ?>
                  <option value="0">No Department Found</option>
                <?php }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label>Exam Time Limit</label>
              <select class="form-control" name="timeLimit" required="">
                <option value="0">Select time</option>
                <option value="10">10 Minutes</option>
                <option value="20">20 Minutes</option>
                <option value="30">30 Minutes</option>
                <option value="40">40 Minutes</option>
                <option value="50">50 Minutes</option>
                <option value="60">60 Minutes</option>
              </select>
            </div>

            <div class="form-group">
              <label>Question Limit to Display</label>
              <input type="number" name="examQuestDipLimit" id="" class="form-control" placeholder="Input question limit to display">
            </div>

            <div class="form-group">
              <label>Exam Title</label>
              <input type="" name="examTitle" class="form-control" placeholder="Input Exam Title" required="">
            </div>

            <div class="form-group">
              <label>Exam Description</label>
              <textarea name="examDesc" class="form-control" rows="4" placeholder="Input Exam Description" required=""></textarea>
            </div>


          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Now</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal For Add Examinee -->
<div class="modal fade" id="modalForAddExaminee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addExamineeFrm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Examinee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Fullname</label>
              <input type="" name="fullname" id="fullname" class="form-control" placeholder="Input Fullname" autocomplete="off" required="">
            </div>
            <div class="form-group">
              <label>Birhdate</label>
              <input type="date" name="bdate" id="bdate" class="form-control" placeholder="Input Birhdate" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Gender</label>
              <select class="form-control" name="gender" id="gender">
                <option value="0">Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="form-group">
              <label>Department</label>
              <select class="form-control" name="course" id="course">
                <option value="0">Select Department</option>
                <?php
                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id asc");
                while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $selCourseRow['cou_id']; ?>"><?php echo $selCourseRow['cou_name']; ?></option>
                <?php }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Year Level</label>
              <select class="form-control" name="year_level" id="year_level">
                <option value="0">Select year level</option>
                <option value="first year">First Year</option>
                <option value="second year">Second Year</option>
                <option value="third year">Third Year</option>
                <option value="fourth year">Fourth Year</option>
              </select>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Input Email" autocomplete="off" required="">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Input Password" autocomplete="off" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Now</button>
        </div>
      </div>
    </form>
  </div>
</div>



<!-- Modal For Add Question -->
<div class="modal fade" id="modalForAddQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addQuestionFrm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Question for <br><?php echo $selExamRow['ex_title']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="refreshFrm" method="post" id="addQuestionFrm">
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group">
                <label>Question</label>
                <input type="hidden" name="examId" value="<?php echo $exId; ?>">
                <input type="" name="question" id="course_name" class="form-control" placeholder="Input question" autocomplete="off">
              </div>

              <fieldset>
                <legend>Input word for choice's</legend>
                <div class="form-group">
                  <label>Choice A</label>
                  <input type="" name="choice_A" id="choice_A" class="form-control" placeholder="Input choice A" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Choice B</label>
                  <input type="" name="choice_B" id="choice_B" class="form-control" placeholder="Input choice B" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Choice C</label>
                  <input type="" name="choice_C" id="choice_C" class="form-control" placeholder="Input choice C" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Choice D</label>
                  <input type="" name="choice_D" id="choice_D" class="form-control" placeholder="Input choice D" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Correct Answer</label>
                  <input type="" name="correctAnswer" id="" class="form-control" placeholder="Input correct answer" autocomplete="off">
                </div>
              </fieldset>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Now</button>
          </div>
        </form>
      </div>
    </form>
  </div>
</div>


<!-- Modal For Add Question excel upload -->
<div class="modal fade" id="modalForAddQuestionExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!-- <form class="refreshFrm" id="addQuestionFrmImport" method="post" enctype="multipart/form-data"> -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Question for <br><?php echo $selExamRow['ex_title']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="refreshFrm" method="post" id="addQuestionFrmImport" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="col-md-12">
            <fieldset>
              <legend>Upload Excel File</legend>
              <div class="form-group">
                <input type="hidden" name="examIdImport" value="<?php echo $exId; ?>">
                <input type="file" name="import_file" class="form-control" autocomplete="off" />
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Import Now</button>
        </div>
      </form>
    </div>
    <!-- </form> -->
  </div>
</div>

<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-xl">
    <!-- <form class="refreshFrm" id="addQuestionFrmImport" method="post" enctype="multipart/form-data"> -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Question for <br><?php echo $selExamRow['ex_title']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="refreshFrm" method="post" id="addQuestionFrmImport" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="col-md-12">
            <fieldset>
              <legend>Upload Excel File</legend>
              <div class="form-group">
                <input type="hidden" name="examIdImport" value="<?php echo $exId; ?>">
                <input type="file" name="import_file" class="form-control" autocomplete="off" />
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Import Now</button>
        </div>
      </form>
    </div>
    <!-- </form> -->
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalForAddQuestionExcelDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Question Format</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-1"></div>
          <div class="col-10">
            <img src="assets/quizformatimage/questionformat.png" alt="sdsdsd" height="400" style="width: 100%;">
          </div>
          <div class="col-1"></div>
         
          <div class="col-12">
            <a class="btn btn-warning btn-lg text-white" href="exam_question_tbl.xlsx">DOWNLOAD</a>
          </div>
          <div class="col-12 card card-body mb-3">
            <p class="text-danger">Note: </p>
            <span>Download the Excel File Question format and exclusively add questions there.</span><br>
            <span>After uploading the Excel file once, verify whether the questions have been correctly uploaded or not.</span>
          </div>
          
          <div class="col-2"></div><br>
          <div class="col-4 text-center">
            <h6 class="text-danger">Wrong Upload</h6>
            <img src="assets/quizformatimage/wrong.png" alt="" style="width: 100%;">
          </div>
          <div class="col-4">
            <h6 class="text-success">Correct Upload</h6>
            <img src="assets/quizformatimage/corect.png" alt="" style="width: 100%;">
          </div>
          <div class="col-2"></div>


        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>