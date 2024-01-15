
$(document).on("click", "#startQuiz", function () {
  var thisId = $(this).data('id');
  Swal.fire({
    title: 'Are you sure?',
    text: 'You want to take this exam now, your time will start automaticaly',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, start now!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "post",
        url: "query/selExamAttemptExe.php",
        dataType: "json",
        data: { thisId: thisId },
        cache: false,
        success: function (data) {
          if (data.res == "alreadyExam") {
            Swal.fire(
              'Already Taken ',
              'you already take this exam',
              'error'
            )
          }
          else if (data.res == "takeNow") {
            window.location.href = "home.php?page=exam&id=" + thisId;
            return false;
          }
        },
        error: function (xhr, ErrorStatus, error) {
          console.log(status.error);
        }

      });
    }
  });
  return false;
})

function checkQuestionStatusOnLoad() {
  questions.forEach((question, index) => {
    const questionId = question.querySelector('.get_val').value;
    $.ajax({
      type: 'POST',
      url: 'query/check_status_question.php',
      data: {
        questionIdStatus: questionId
      },
      success: function (response) {
        console.log(question);
        const button = document.querySelector(`.question-button:nth-child(${index + 1})`);
        if (response === 'noapt') {
          button.style.backgroundColor = 'blue'; 
        } else if (response === 'You Select Correct Option') {
          button.style.backgroundColor = 'green'; 
        } else if (response === 'You Select Wrong Option') {
          button.style.backgroundColor = 'green'; 
        } else {
          button.style.backgroundColor = 'gainsboro'; 
          
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  });
}


window.addEventListener('load', checkQuestionStatusOnLoad);

function startExam(selectedRows) {
  var examIdValue = $('#exam_id').val();
  Swal.fire({
    title: 'Are you sure?',
    text: 'You want to take this exam now, your time will start automatically',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, start now!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "post",
        url: "query/selExamAttemptExeStart.php",
        dataType: "json",
        data: { thisData: selectedRows, examIdGet: examIdValue },
        cache: false,
        success: function (data) {
          if (data.res == "startExam") {
            
            init();

            window.location.href = "home.php?page=exam&id=" + examIdValue;
            return false;
          } else {
            Swal.fire(
              'Already Taken ',
              'you already take this exam',
              'error'
            )
          }
        },
        error: function (xhr, ErrorStatus, error) {
          console.log(status.error);
        }
      });
    }
  });
  return false;
}

// ready test
$(document).on("click", "#readyTest", function () {
  var thisId = $(this).data('id');
  Swal.fire({
    title: 'Are you sure?',
    text: 'You want to take this exam now, your time will start automaticaly',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, start now!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "post",
        url: "query/selExamAttemptExe.php",
        dataType: "json",
        data: { thisId: thisId },
        cache: false,
        success: function (data) {
          if (data.res == "alreadyExam") {
            Swal.fire(
              'Already Taken ',
              'you already take this exam',
              'error'
            )
          }
          else if (data.res == "takeNow") {
            window.location.href = "home.php?page=exam&id=" + thisId;
            return false;
          }
        },
        error: function (xhr, ErrorStatus, error) {
          console.log(status.error);
        }

      });
    }
  });
  return false;
})

function showStoredQuestion() {
  const storedIndex = localStorage.getItem('activeQuestionIndex');
  const index = storedIndex ? parseInt(storedIndex) : 0;
  showQuestion(index);
}
const questions = document.querySelectorAll('.question-container');
let currentQuestion = 0;
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

const questionButtonsContainer = document.getElementById('questionButtons');

function showQuestion(n) {
  questions[currentQuestion].classList.remove('active');
  currentQuestion = (n + questions.length) % questions.length;
  questions[currentQuestion].classList.add('active');
  if (currentQuestion === questions.length - 1) {
    nextBtn.disabled = true;
  } else {
    nextBtn.disabled = false;
  }

  if (currentQuestion === 0) {
    prevBtn.disabled = true;
  } else {
    prevBtn.disabled = false;
  }

  const buttons = document.querySelectorAll('.question-button');
  buttons.forEach((button, index) => {
    if (index === currentQuestion) {
      
      button.style.border = '5px solid blue';
      checkQuestionStatusOnLoad();

    } else {
      button.style.border = '';
      // button.style.border = '0px solid';
      checkQuestionStatusOnLoad();

    }
  });
  const questionContainers = document.querySelectorAll('.question-container');
  const activeQuestion = questionContainers[currentQuestion];
  const questionId = activeQuestion.querySelector('.get_val').value;
  $.ajax({
    type: 'POST',
    url: 'query/check_status_question.php',
    data: {
      questionIdStatus: questionId
    },
    success: function (response) {
      const buttons = document.querySelectorAll('.question-button');
    },
    error: function (xhr, response, error) {
      console.error(error);
    }
  });

  localStorage.setItem('activeQuestionIndex', currentQuestion);
}
window.addEventListener('load', showStoredQuestion);

function changeQuestion(n) {

  const previousQuestionId = document.querySelector('.question-container.active .get_val').value;
  showQuestion(currentQuestion + n);

  const currentQuestionId = document.querySelector('.question-container.active .get_val').value;
  if (previousQuestionId !== currentQuestionId) { }
}


$(document).ready(function () {
  $('.custom-radio').on('click', function () {
    var selectedAnswer = $(this).val();
    var questionId = $(this).data('question_number');
    $.ajax({
      type: 'POST',
      url: 'query/update_user_answer.php',
      data: {
        questionId: questionId,
        userAnswer: selectedAnswer
      },
      success: function (response) {

      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  });
});

questions.forEach((question, index) => {
  const button = document.createElement('button');
  button.textContent = `Q${index + 1}`;
  button.classList.add('question-button');
  button.style.width = '20%';
  button.style.height = '35px';
  button.style.margin = '3px';
  button.addEventListener('click', () => showQuestion(index));

  questionButtonsContainer.appendChild(button);
});

if (questions.length <= 1) {
  prevBtn.disabled = true;
  nextBtn.disabled = true;
  checkQuestionStatusOnLoad();

} else {
  prevBtn.disabled = true;
  checkQuestionStatusOnLoad();

}

function finalSubmitTest() {
  var finalExamId = $('#exam_id').val();

  Swal.fire({
    title: 'Are you sure?',
    text: 'You want to complete the test.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "post",
        url: "query/examCompleteTest.php",
        dataType: "json",
        data: { exam_id: finalExamId },
        cache: false,
        success: function (datafinal) {
          if (datafinal.res == "alreadyTaken") {
            Swal.fire(
              'Already Taken',
              "you already take this exam",
              'error'
            )
          }
          else if (datafinal.res == "success") {
            Swal.fire({
              title: 'Success',
              text: "your answer successfully submitted!",
              icon: 'success',
              allowOutsideClick: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK!'
            }).then((result) => {
              if (result.value) {
                window.location.href = 'home.php?page=result&id=' + finalExamId;
              }

            });
          }
          else if (datafinal.res == "failed") {
            Swal.fire(
              'Error',
              "Something;s went wrong",
              'error'
            )
          }
        },
        error: function (xhr, ErrorStatus, error) {
          console.log(status.error);
        }
      });
    }
  });
  return false;
};

var mins
var secs;

function cd() {
  var timeExamLimit = $('#timeExamLimit').val();
  mins = 1 * m("" + timeExamLimit); // change minutes here
  secs = 0 + s(":01");
  redo();
}

function m(obj) {
  for (var i = 0; i < obj.length; i++) {
    if (obj.substring(i, i + 1) == ":")
      break;
  }
  return (obj.substring(0, i));
}

function s(obj) {
  for (var i = 0; i < obj.length; i++) {
    if (obj.substring(i, i + 1) == ":")
      break;
  }
  return (obj.substring(i + 1, obj.length));
}

function dis(mins, secs) {
  var disp;
  if (mins <= 9) {
    disp = " 0";
  } else {
    disp = " ";
  }
  disp += mins + ":";
  if (secs <= 9) {
    disp += "0" + secs;
  } else {
    disp += secs;
  }
  return (disp);
}

function redo() {
  secs--;
  if (secs == -1) {
    secs = 59;
    mins--;
  }
  document.cd.disp.value = dis(mins, secs);
  if ((mins == 0) && (secs == 0)) {
    $('#examAction').val("autoSubmit");
    $('#submitAnswerFrm').submit();
  } else {
    cd = setTimeout("redo()", 1000);
  }
}

function init() {
  cd();
}
window.onload = init;
