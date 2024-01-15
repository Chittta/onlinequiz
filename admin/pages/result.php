<?php
$examId = $_GET['id'];
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);

?>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div id="refreshData">

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
                    </div>
                </div>
                <div class="row col-md-12">
                    <h1 class="text-primary">RESULT'S</h1>
                </div>

                <div class="row col-md-6 float-left">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Your Answer's</h5>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                                <?php
                                $selQuest = $conn->query("SELECT
                        COUNT(*) AS total_questions,
                        SUM(CASE WHEN user_answared IS NOT NULL THEN 1 ELSE 0 END) AS total_attempts,
                        SUM(CASE WHEN exam_answer = user_answared THEN 1 ELSE 0 END) AS correct_answers,
                        SUM(CASE WHEN exam_answer != user_answared THEN 1 ELSE 0 END) AS wrong_answers,
                        SUM(CASE WHEN exam_answer = user_answared THEN 1 ELSE 0 END) / COUNT(*) AS score,
                        (SUM(CASE WHEN exam_answer = user_answared THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS percentage,
                        exam_id,exmne_id 
                    FROM exam_questions_atp eqt WHERE eqt.exam_id='$examId' AND eqt.exmne_id='$exmneId'");
                                $i = 1;
                                $selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)  ?>
                                <tr>
                                    <td>
                                        <label for="">Total Question : <?= $selQuestRow['total_questions']; ?></label>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Total Attempts : <?= $selQuestRow['total_attempts']; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Correct Answer : <?= $selQuestRow['correct_answers']; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Wrong Answer : <?= $selQuestRow['wrong_answers']; ?></label>
                                    </td>
                                </tr>
                                <?php
                                ?>
                            </table>
                            <hr>
                            <button class="btn btn-danger mt-3">Send Result to Email</button>
                        </div>
                    </div>
        

                </div>
                <!--  -->
                <div class="row col-md-6 float-left">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Your Answer's</h5>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                                <?php
                                $selQuest = $conn->query("SELECT * FROM exam_questions_atp eee WHERE eee.exam_id='$examId' AND eee.exmne_id='$exmneId' ");
                                $i = 1;
                                while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td>
                                            <b>
                                                <p><?php echo $i++; ?> .) <?php echo $selQuestRow['exam_question']; ?></p>
                                            </b>
                                            <label class="pl-4 text-success">
                                                Answer :
                                                <?php
                                                if ($selQuestRow['exam_answer'] != $selQuestRow['user_answared']) { ?>
                                                    <span style="color:red"><?php echo $selQuestRow['user_answared']; ?></span>
                                                <?PHP } else { ?>
                                                    <span class="text-success"><?php echo $selQuestRow['user_answared']; ?></span>
                                                <?php }
                                                ?>
                                            </label>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!--  -->



            </div>


        </div>

    </div>