<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>
<?php
// print_r($exmneId);die;
$examId = $_GET['id'];
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
$selExamTimeLimit = $selExam['ex_time_limit'];
$exDisplayLimit = $selExam['ex_questlimit_display'];
?>


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="col-md-12">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>
                            <?php echo $selExam['ex_title']; ?>
                            <div class="page-title-subheading">
                                <?php echo $selExam['ex_description']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="page-title-actions mr-5" style="font-size: 20px;">
                        <form name="cd">
                            <input type="hidden" name="" id="timeExamLimit" value="<?php echo $selExamTimeLimit; ?>">
                            <label>Remaining Time : </label>
                            <input style="border:none;background-color: transparent;color:blue;font-size: 25px;" name="disp" type="text" class="clock" id="txt" value="<?php echo $selExamTimeLimit; ?>:00" size="5" readonly="true" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $examId; ?>">
        <input type="hidden" name="examAction" id="examAction">
        <?php
        $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examId' ORDER BY rand() LIMIT $exDisplayLimit ");
        if ($selQuest->rowCount() > 0) {
            $selectedRows = array();
            while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) {
                $selectedRows[] = $selQuestRow;
            }
            $selectedRowsJSON = json_encode($selectedRows);
        ?>
            <div class="col-md-12">
                <?php
                // print_r($exmneId);die;
                $selQuestApt = $conn->query("SELECT * FROM exam_questions_atp WHERE exam_id='$examId' AND exmne_id = '$exmneId';");
                if ($selQuestApt->rowCount() > 0) {
                ?>
                    <button class="btn btn-primary" type="submit" name="startExam" id="startExam" onclick='startExam(<?php echo $selectedRowsJSON; ?>)' disabled>Start Test</button>
                <?php
                } else {
                ?>
                    <button class="btn btn-primary" type="submit" name="startExam" id="startExam" onclick='startExam(<?php echo $selectedRowsJSON; ?>)'>Start Test</button>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>

        <?php
        $selAptQut = $conn->query("SELECT * FROM exam_questions_atp WHERE exam_id='$examId' AND exmne_id = '$exmneId';");
        $q = 1;
        if ($selAptQut->rowCount() > 0) {
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <?php

                        while ($row = $selAptQut->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <div id="questions-container" class="question-container <?php echo ($q === 1) ? 'active' : ''; ?>" data-question="<?php echo $q; ?>">
                                <form action="" id="myTestForm<?php echo $row['id']; ?>">
                                    <p>Q<?php echo $q; ?> : <?php echo $row['exam_question']; ?></p>

                                    <input type="radio" class="custom-radio" name="userAnswer" id="userAnswer" value="<?php echo $row['exam_ch1']; ?>" data-question_number="<?php echo $row['id']; ?>" <?php echo $row['exam_ch1'] == $row['user_answared'] ? "checked" : ""; ?> />
                                    <label for="choice1"><?php echo $row['exam_ch1']; ?></label><br>

                                    <input type="radio" class="custom-radio" name="userAnswer" id="userAnswer<?php echo $row['id']; ?>" value="<?php echo $row['exam_ch2']; ?>" data-question_number="<?php echo $row['id']; ?>" <?php echo $row['exam_ch2'] == $row['user_answared'] ? "checked" : ""; ?>>
                                    <label for="choice2"><?php echo $row['exam_ch2']; ?></label><br>

                                    <input type="radio" class="custom-radio" name="userAnswer" id="userAnswer<?php echo $row['id']; ?>" value="<?php echo $row['exam_ch3']; ?>" data-question_number="<?php echo $row['id']; ?>" <?php echo $row['exam_ch3'] == $row['user_answared'] ? "checked" : ""; ?>>
                                    <label for="choice3"><?php echo $row['exam_ch3']; ?></label><br>

                                    <input type="radio" class="custom-radio" name="userAnswer" id="userAnswer<?php echo $row['id']; ?>" value="<?php echo $row['exam_ch4']; ?>" data-question_number="<?php echo $row['id']; ?>" <?php echo $row['exam_ch4'] == $row['user_answared'] ? "checked" : ""; ?>>
                                    <label for="choice4"><?php echo $row['exam_ch4']; ?></label><br>

                                    <input type="hidden" class="get_val" id="questionId" value="<?php echo $row['id']; ?>">

                                </form>
                                <div id="check_result"></div>
                                <div id="check_result<?php echo $row['id']; ?>"></div>
                            </div>

                        <?php
                            $q++;
                        }

                        ?>
                        <button class="btn btn-info" id="prevBtn" onclick="changeQuestion(-1)">Previous</button>
                        <button class="btn btn-info" id="nextBtn" onclick="changeQuestion(1)">Next</button>

                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div id="questionButtons"></div>

                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-success btn-lg" id="testfinalsubmit" onclick="finalSubmitTest()">SUBMIT</button>

                </div>
            </div>
        <?php
        }
        ?>