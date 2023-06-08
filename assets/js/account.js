$.fn.capitalizeFirstChar = function() {
    return this.each(function() {
      var inputString = $(this).val();
      $(this).val(inputString.charAt(0).toUpperCase() + inputString.slice(1));
    });
  };

$(document).ready(function () {
    $('.text-only').on('input', function() {
      $(this).val(function(_, val) {
        return val.replace(/\d/g, '');
      });
      $(this).capitalizeFirstChar();
    });
});

$(document).ready(function () {
  var selectedFile;

  $(".inputfile").change(function (e) {
    selectedFile = null;
    var reader = null;
    var fileInput = null;
    var file = null;

    selectedFile = e.target.files[0];
    var reader = new FileReader();
    var fileInput = $(".inputfile")[0];
    var file = fileInput.files[0];

    if (file && file.size > 100 * 1024) {
      signErrorsAcc({ "img": "* File size limit 100 KB." });
      //alert("* File size limit 100 KB.");
      return;
    }
    reader.onload = function (event) {
      $("#previewImage").attr("src", event.target.result);
    };
    reader.readAsDataURL(selectedFile);
    $('.inputfile-label').addClass('active-btn2');
    $('.acc-img button').toggle();
    
  });

  $(".acc-img-change").submit(function (e) {
    e.preventDefault();

    if (selectedFile) {
      var form = $(this);
      var formData = new FormData();
      formData.append("fileToUpload", selectedFile);

      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: formData,
        dataType: "text",
        processData: false,
        contentType: false,
        success: function (response) {
          //alert(response);
        },
        error: function (xhr, status, error) {
          //alert("An error occurred while uploading the file.");
          signErrorsAcc({ "img": "* An error occurred while uploading the file." });
        }
      });
    } else {
      signErrorsAcc(data);
    }
  });
});


$(function() {
    $('form.acc-change').submit(function(e) {
      e.preventDefault();
      var form = $(this);
  
      var firstname = $("#acc-firstname").val();
      var lastname = $("#acc-lastname").val();
      var username = $("#acc-username").val();
      var password = $("#acc-password").val();
  
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: {
          firstname: firstname,
          lastname: lastname,
          username: username,
          password: password
        },
        success: function (data) {
          if (data == true) {
            $('#acc-password').val('');
            $("#myModal").css("display", "block");
            $('.signup-btn-done').addClass('active-done');
            setTimeout(() => {
              $('#signIn').trigger('click');
              $('.form-signup input').val('');
            }, 1000);
          } else {
            signErrorsAcc(data);
          }
        },
      });
    });
});


$(document).ready(function () {
  $('.acc-pass-change').submit(function (e) {
    e.preventDefault();
    var form = $(this);

    var oldpassword = $("#acc-oldpassword-ch").val();
    var newpassword = $("#acc-newpassword-ch").val();

    $.ajax({
      type: form.attr('method'),
      url: form.attr('action'),
      data: {
        oldpassword: oldpassword,
        newpassword: newpassword
      },
      success: function (data) {
        if (data == true) {
          $('#acc-oldpassword-ch').val('');
          $('#acc-newpassword-ch').val('');
          $("#myModal2").css("display", "block");
          $('.signup-btn-done').addClass('active-done');
          setTimeout(() => {
            $('#signIn').trigger('click');
            $('.form-signup input').val('');
          }, 1000);
        } else {
          signErrorsAcc(data);
        }
      },
    });
  });
});

function signErrorsAcc(data) {
    $.each(data, function (index, item) {
      switch (index) {
        case 'firstname':
          $('#acc-firstname').addClass('error-active');
          $('#acc-firstname-error span').text(item);
          $("#acc-firstname-error").addClass("active");
          break;
        case 'lastname':
          $('#acc-lastname').addClass('error-active');
          $('#acc-lastname-error span').text(item);
          $('#acc-lastname-error').addClass("active");
          break;
        case 'username':
          $('#acc-username').addClass('error-active');
          $('#acc-username-error span').text(item);
          $('#acc-username-error').addClass("active");
          break;
        case 'password':
          $('#acc-password').addClass('error-active');
          $('#acc-password-error span').text(item);
          $('#acc-password-error').addClass("active");
          break;
        case 'img':
          $('#acc-img-error span').text(item);
          $('#acc-img-error').addClass("active");
        case 'oldpassword':
          $('#acc-oldpassword-error span').text(item);
          $('#acc-oldpassword-error').addClass("active");
          break;
        case 'newpassword':
          $('#acc-newpassword-error span').text(item);
          $('#acc-newpassword-error').addClass("active");
          break;
      }
    });
  };
  
  $(document).on('keydown', '#acc-oldpassword-ch, #acc-newpassword-ch, #file, #acc-firstname, #acc-lastname, #acc-username, #acc-password',
    function () {
      $(this).next('div').removeClass("active");
  });
  
  function setTextToInput() {
    var input = document.getElementById("myInput");
    input.value = "Hello, World!";
}
  
/*$(document).ready(function() {
    $.ajax({
        url: 'handlers/handle_useracc.php',
        type: 'POST',
        success: function (data) {
          $('#acc-firstname').val(data['firstname']);
          $('#acc-lastname').val(data['lastname']);
          $('#acc-username').val(data['username']);
        }
    });
});*/

$(document).ready(function () { 
  $(".close, .modal").click(function () {
    $("#myModal").css("display", "none");
    $("#myModal2").css("display", "none");
  });
  
  $(".modal-content").click(function (e) {
    e.stopPropagation();
  });
});

$(document).ready(function() {
  $('.char-first').on('input', function() {
    var inputValue = $(this).val().charAt(0);
    if (/^[0-9]?[^a-zA-Z]+/.test(inputValue)) {
      $(this).val(function(_, val) {
        return val.slice(1);
      });
    }
    $(this).val(function(_, val) {
      return val.replace(/[^a-zA-Z0-9']+/g, '');
    });
  });
});