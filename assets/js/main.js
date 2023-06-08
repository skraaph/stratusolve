$(document).ready(function() {
  var path = window.location.pathname;
  if (path.endsWith('/account')) {
    $('#account').addClass('active');
  }
  if (path.endsWith('/')) {
    $('#home').addClass('active');
  }
});

function loadElements() {
  $.ajax({
    url: 'handlers/handle_postsloader.php',
    type: 'POST',
    data: { limit: 10 },
    beforeSend: function() {
      isLoading = true;
    },
    success: function (data) {
      if (data[0]) {
        var $receivedElement = $(data[1]['Posts']);
        $(".main-list").append($receivedElement);
      }
      isLoading = false;
    },
    error: function(xhr, textStatus, errorThrown) {
      // Handle the error here
      console.log("AJAX request failed:", textStatus);
      isLoading = false;
    }
  });
}

// posts load
$(document).ready(function () {
  var limit = 10;
  var isLoading = false;

  function loadElements() {
    $.ajax({
      url: 'handlers/handle_postsloader.php',
      type: 'POST',
      data: { limit: limit },
      beforeSend: function() {
        isLoading = true;
      },
      success: function (data) {
        if (data[0]) {
          var $receivedElement = $(data[1]['Posts']);
          $(".main-list").append($receivedElement);
        }
        isLoading = false;
      },
      error: function(xhr, textStatus, errorThrown) {
        // Handle the error here
        console.log("AJAX request failed:", textStatus);
        isLoading = false;
      }
    });
  }

  $(window).on('scroll', function () {
    if ($('.main-post-footer').length) {
      var hT = $('.main-post-footer').offset().top,
        hH = -50,
        wH = $(window).height(),
        wS = $(this).scrollTop();
      if (wS > (hT + hH - wH) && !isLoading) {
        isLoading = true;
        setTimeout(() => {
          console.log('load');
          loadElements();
        }, 100);
      }
    }
  });

  loadElements();
});

// logout button
$(document).ready(function() {
  $(document).on('click', '.account-item', function (event) {
    $('.account-menu').toggle();

    var btnPosition = $(this).offset();
    var btnWidth = $(this).outerWidth()/2;
    var btnHeight = $(this).outerHeight()/2;

    $('.account-menu').css({
      top: btnPosition.top - btnHeight + 'px',
      left: btnPosition.left + btnWidth + 'px'
    });

      event.stopPropagation();
  });

  $(document).click(function() {
    $('.account-menu').hide();
  });
});

$(document).ready(function() {
  $('.account-menu-btn').on('click', function (event) {
    var id = $(this).attr('id');
    $.ajax({
      url: 'handlers/handle_logout.php',
      type: 'POST',
      success: function (data) {
        window.location.href = window.location.href;
      }
    });
    event.stopPropagation();
  });
});

// del btn
$(document).ready(function() {
  $(document).on('click', '.post-btn', function (event) {
    var attr = $(this).attr('id');
    //if (typeof attr !== 'undefined' && attr !== false)
    if (attr != 'd') {
      $('.post-menu').toggle();
      $('.post-menu-del').attr('id', attr);

      var btnPosition = $(this).offset();
      var btnWidth = $(this).outerWidth()/2;
      var btnHeight = $(this).outerHeight()/2;

      $('.post-menu').css({
        top: btnPosition.top + btnHeight + 'px',
        left: btnPosition.left + btnWidth + 'px'
      });

      event.stopPropagation();
    }
  });

  $(document).click(function() {
    $('.post-menu').hide();
  });
});

$(document).ready(function() {
  $('.post-menu-del').on('click', function (event) {
    var id = $(this).attr('id');
    $.ajax({
      url: 'handlers/handle_postdelete.php',
      type: 'POST',
      data: { id: id },
      success: function (data) {
        if (data) {
          $('.post-btn#' + id).closest('.main-post').remove();
          $('.post-menu').hide();
        }
      }
    });
    event.stopPropagation();
  });
});

// new post
$(document).ready(function () {
  $('form.form-newpost').submit(function (e) {
    e.preventDefault();
    var form = $(this);

    var postName = $("#postname").val().trim();
    var postText = $("#posttext").val().trim();
    if (postName != '' &&  postText != '') {
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: {
          postname: postName,
          posttext: postText
        },
        success: function (data) {
          if (data['Done']) {
            var $receivedElement = $(data['NewPost']);
            $("#postname").val('');
            $("#posttext").val('');
            $(".main-list").empty();
            loadElements();
            //$(".main-list").prepend($receivedElement);
          } else {
            signErrors(data);
          }
        },
      });
      
    }
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