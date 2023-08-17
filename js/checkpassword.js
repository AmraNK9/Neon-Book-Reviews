$(document).ready(function(){
    $('.password1,.password2').on('input', function() {
        var password = $(this).val();
        $(this).val(password.replace(/\s/g,''));
      });
      //check Password
        $(".password1,.password2").keyup(function(){
          var password1 = $('.password1').val();
          var password2 = $('.password2').val();
            if (password1.length < 6 || password2.length < 6) {
              $(".note").text("Passwords must be at least 6 characters long");
            }else if (password1 !== password2) {
              $(".note").text("Passwords do not match");
            }else{
              $(".note").text(" ");
            }   
      })
})