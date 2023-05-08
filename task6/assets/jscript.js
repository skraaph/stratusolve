$(document).ready(function () {
  $("table tbody tr").click(function (evt) {
      $("#ModalEdit").modal('show');
    
      var rowId = $(this).data("row-id");
      var firstName = $(this).find('td:eq(1)').text();
      var surName = $(this).find('td:eq(2)').text();
      var dateOfBirth = $(this).find('td:eq(3)').text();
      var emailAddress = $(this).find('td:eq(4)').text();
    
      $('#rowId').val(rowId);
      $('#FirstName').val(firstName);
      $('#SurName').val(surName);
      $('#DateOfBirth').val(dateOfBirth);
      $('#EmailAddress').val(emailAddress);
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
          window.location.href=window.location.href
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
    var rowId = $("#rowId").val();
    var FirstName = $("#FirstName").val();
    var SurName = $("#SurName").val();
    var DateOfBirth = $("#DateOfBirth").val();
    var EmailAddress = $("#EmailAddress").val();
    
    $.ajax({
      url: "edit.php",
      method: "POST",
      data: {
        Id: rowId,
        FirstName: FirstName,
        SurName: SurName,
        DateOfBirth: DateOfBirth,
        EmailAddress: EmailAddress
      },
      cache: false,
      success: function(data) {
        window.location.href=window.location.href
      },
      error: function(xhr, status, error) {
        console.error(xhr);
      }
    });
  });
});

$(document).ready(function () {
  $("#create").click(function() {
    var FirstName = $("#FirstName").val();
    var SurName = $("#SurName").val();
    var DateOfBirth = $("#DateOfBirth").val();
    var EmailAddress = $("#EmailAddress").val();
    
    if(FirstName==''||SurName==''||DateOfBirth==''||EmailAddress=='') {
      alert("Please fill all fields.");
      return false;
    }
    
    $.ajax({
      type: "POST",
      url: "create.php",
      data: {
        FirstName: FirstName,
        SurName: SurName,
        DateOfBirth: DateOfBirth,
        EmailAddress: EmailAddress
      },
      cache: false,
      success: function(data) {
        window.location.href=window.location.href
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
        window.location.href=window.location.href
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
          window.location.href=window.location.href
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