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
          $('#acc-firstname-error').text(item);
          $("#acc-firstname-error").addClass("active");
          break;
        case 'lastname':
          $('#acc-lastname-error').text(item);
          $('#acc-lastname-error').addClass("active");
          break;
        case 'username':
          $('#acc-username-error').text(item);
          $('#acc-username-error').addClass("active");
          break;
        case 'password':
          $('#acc-password-error').text(item);
          $('#acc-password-error').addClass("active");
          break;
      }
    });
  };
  
  $(document).on('keydown', '#acc-firstname, #acc-lastname, #acc-username, #acc-password',
    function () {
      $(this).next('div').removeClass("active");
  });
  
  function setTextToInput() {
    var input = document.getElementById("myInput");
    input.value = "Hello, World!";
}
  
$(document).ready(function() {
    $.ajax({
        url: 'handlers/handle_useracc.php',
        type: 'POST',
        success: function (data) {
          $('#acc-firstname').val(data['firstname']);
          $('#acc-lastname').val(data['lastname']);
          $('#acc-username').val(data['username']);
        }
    });
});