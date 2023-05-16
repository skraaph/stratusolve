const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
  container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
  container.classList.remove("right-panel-active");
});

$.fn.capitalizeFirstChar = function() {
  return this.each(function() {
    var inputString = $(this).val();
    $(this).val(inputString.charAt(0).toUpperCase() + inputString.slice(1));
  });
};

$(document).ready(function() {
  $('.text-only').on('input', function() {
    $(this).val(function(_, val) {
      return val.replace(/\d/g, '');
    });
    $(this).capitalizeFirstChar();
  });
});

$(document).ready(function() {
  $('.char-first').on('input', function() {
    var inputValue = $(this).val().charAt(0);
    if (/^\d/.test(inputValue)) {
      $(this).val(function(_, val) {
        return val.slice(1);
      });
    }
  });
});

$(function() {
  $('form.form-signin').submit(function(e) {
    e.preventDefault();
    var form = $(this);

    var email = $("#login-email").val();
    var password = $("#login-password").val();

    $.ajax({
      type: form.attr('method'),
      url: form.attr('action'),
      data: {
        email: email,
        password: password
      },
      success: function (data) {
        if (data != false) {
          var segments = window.location.href.split("/");
          segments.pop();
          
          //window.location.href = segments.join("/");
          location.reload(false)
        } else {
          signErrors(data);
        }
      },
    });
  });
});

$(function() {
  $('form.form-signup').submit(function(e) {
    e.preventDefault();
    var form = $(this);

    var firstname = $("#signup-firstname").val();
    var lastname = $("#signup-lastname").val();
    var email = $("#signup-email").val();
    var username = $("#signup-username").val();
    var password = $("#signup-password").val();

    $.ajax({
      type: form.attr('method'),
      url: form.attr('action'),
      data: {
        firstname: firstname,
        lastname: lastname,
        email: email,
        username: username,
        password: password
      },
      success: function (data) {
        if (data == true) {
          $('.signup-btn-done').addClass('active-done');
          setTimeout(() => {
            $('#signIn').trigger('click');
            $('.form-signup input').val('');
          }, 1000);
        } else {
          signErrors(data);
        }
      },
    });
  });
});

function signErrors(data) {
  $.each(JSON.parse(data), function (index, item) {
    switch (index) {
      case 'firstname':
        $('#signup-firstname-error').text(item);
        $("#signup-firstname-error").addClass("active");
        break;
      case 'lastname':
        $('#signup-lastname-error').text(item);
        $('#signup-lastname-error').addClass("active");
        break;
      case 'email':
        $('#signup-email-error').text(item);
        $('#signup-email-error').addClass("active");
        break;
      case 'username':
        $('#signup-username-error').text(item);
        $('#signup-username-error').addClass("active");
        break;
      case 'password':
        $('#signup-password-error').text(item);
        $('#signup-password-error').addClass("active");
        break;
    }
  });
};

$(document).on('keydown', '#signup-firstname, #signup-lastname, #signup-email, #signup-username, #signup-password',
  function () {
    $(this).next('div').removeClass("active");
});