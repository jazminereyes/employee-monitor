$(document).ready(function(){
  $("#password-block").css('display', 'none');
  $("#save-profile").css('display', 'none');

  $("#edit-profile").click(function(){
    $("#password-block").css('display', 'block');
    $("#editProfileModal input").removeAttr('readonly');
    $("#save-profile").css('display', 'block');
    $(this).attr('disabled', 'disabled');
  });

  $("#editProfileModal button.profile-close").click(function(){
    $("#password-block").css('display', 'none');
    $("#editProfileModal input").attr('readonly', 'readonly');
    $("#save-profile").css('display', 'none');
    $("#edit-profile").removeAttr('disabled');
  });
});