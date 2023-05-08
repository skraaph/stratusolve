$(document).ready(function () {
  $("table tbody tr").click(function (evt) {
      $("#ModalEdit").modal('show');
    
      var rowId = $(this).data("row-id");
      var firstName = $(this).find('td:eq(1)').text();
      var surName = $(this).find('td:eq(2)').text();
      var dateOfBirth = $(this).find('td:eq(3)').text();
      var emailAddress = $(this).find('td:eq(4)').text();
    
      $('#rowIdEdit').val(rowId);
      $('#FirstNameEdit').val(firstName);
      $('#SurNameEdit').val(surName);
      $('#DateOfBirthEdit').val(dateOfBirth);
      $('#EmailAddressEdit').val(emailAddress);
  });
});

$(document).ready(function() {
  $('.text-only').on('input', function() {
    $(this).val(function(_, val) {
      return val.replace(/\d/g, '');
    });
  });
});

$(document).ready(function () {
  $("table tbody tr button").click(function (e) {
    e.stopPropagation();
    if (confirm("Are you sure you want to delete this?")) {
      var rowId = $(this).closest('tr').attr('data-row-id');
      $.ajax({
        type: "POST",
        url: "delete.php",
        data: {
          Id: rowId,
          action: 'deleteId'
        },
        cache: false,
        success: function(data) {
          window.location.href='./'
        },
        error: function(xhr, status, error) {
          console.error(xhr);
        }
      });
    } else {
      return false;
    }
  });
});

$(document).ready(function () {
  $("#edit").click(function() {
    var rowId = $("#rowIdEdit").val();
    var firstName = $("#FirstNameEdit").val();
    var surName = $("#SurNameEdit").val();
    var dateOfBirth = $("#DateOfBirthEdit").val();
    var emailAddress = $("#EmailAddressEdit").val();
    
    $.ajax({
      url: "edit.php",
      method: "POST",
      data: {
        Id: rowId,
        FirstName: firstName,
        SurName: surName,
        DateOfBirth: dateOfBirth,
        EmailAddress: emailAddress
      },
      cache: false,
      success: function(data) {
        window.location.href='./'
      },
      error: function(xhr, status, error) {
        console.error(xhr);
      }
    });
  });
});

$(document).ready(function () {
  $("#create").click(function() {
    var firstName = $("#FirstName").val();
    var surName = $("#SurName").val();
    var dateOfBirth = $("#DateOfBirth").val();
    var emailAddress = $("#EmailAddress").val();
    
    if(firstName==''||surName==''||dateOfBirth==''||emailAddress=='') {
      alert("Please fill all fields.");
      return false;
    }
    
    $.ajax({
      type: "POST",
      url: "create.php",
      data: {
        FirstName: firstName,
        SurName: surName,
        DateOfBirth: dateOfBirth,
        EmailAddress: emailAddress
      },
      cache: false,
      success: function(data) {
        window.location.href=window.location.href+data
      },
      error: function(xhr, status, error) {
        console.error(xhr);
      }
    });
  });
});

$(document).ready(function() {
  $("#random").click(function() {
    $.ajax({
      type: "POST",
      url: "create.php",
      data: {
        action: 'random'
      },
      cache: false,
      success: function(data) {
        window.location.href='index.php?page='+data
      },
      error: function(xhr, status, error) {
        console.error(xhr);
      }
    });
  });
});

$(document).ready(function() {
  $("#delete").click(function() {
    if(confirm("Are you sure you want to delete this?")) {
      $.ajax({
        type: "POST",
        url: "delete.php",
        data: {
          action: 'delete'
        },
        cache: false,
        success: function(data) {
          window.location.href='./'
        },
        error: function(xhr, status, error) {
          console.error(xhr);
        }
      });
    } else {
      return false;
    }
  });
});