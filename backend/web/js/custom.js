$(".user-create").hide();
$(".create").click(function (e) {
  e.preventDefault();
  $(".user-create").show();
});
$(document).ready(function () {
  $("#loginform-showpassword").change(function () {
    if ($(this).prop("checked")) {
      $("#loginform-password").attr("type", "text");
    } else {
      $("#loginform-password").attr("type", "password");
    }
  });
});
$(document).ready(function () {
  $(".update").click(function () {
    var userId = $(this).data("userid");
    $("#update-form-" + userId).toggle();
  });
});
