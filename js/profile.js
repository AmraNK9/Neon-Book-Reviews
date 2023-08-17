$(document).ready(function(){
    
    $(".editProfile").on('click', function(e) {
      e.preventDefault();
      $('.round').removeClass('d-none');
      $('.editProfile').addClass('d-none');
      $('.logout').addClass('d-none');
      $('.save').removeClass('d-none');
      $('.cancel').removeClass('d-none');
      $('.username').addClass('d-none');
      $('.usereditname').removeClass('d-none');
      $('.profile-bio').addClass('d-none');
      $('.usereditbio').removeClass('d-none');
  
      if ($('.img').attr('src') !== '../image/user.jpg') {
        $('#cancelButton').removeClass('d-none');
      }
    });
    $(".cancel").on("click",function(){
        $('.round').addClass('d-none');
        $('.save').addClass('d-none');
        $('.cancel').addClass('d-none');
        $('.editProfile').removeClass('d-none');
        $('.logout').removeClass('d-none');
    })

    $(".camera").on("click", function () {
      $("input[name='img']").click();
  });

  $("input[name='img']").on("change", function () {
      var file = this.files[0];
      var reader = new FileReader();
      reader.onload= function () {
          $(".img").attr("src", reader.result);
          if ($('.img').attr('src') != '../image/user.jpg') {
            console.log("Not Equal");
            $('#cancelButton').removeClass('d-none');
          }else{
            $('#cancelButton').addClass('d-none');
          }

      }
    
      if (file) {
        console.log(file);
          reader.readAsDataURL(file);
      }
      
  });

  
      
      $(".cancel-button").on("click",function(){
         $('.img').attr('src','../image/user.jpg');
         $("#input").val("");
        $('#cancelButton').addClass('d-none');
        let user_image = "user.jpg";
        $.ajax({
          url : "changeImage.php",
          type : 'post',
          data : {user_image : user_image},
          success : function(response){
            console.log(response);
          }
        })
      })
    
    //   $(".save").on("click", function(e) {
    //     if ($('.img').attr('src') !== '../image/nurse.jpg') {
    //       console.log("I am Hello")
// 
    //       let imgSrc = $('#profileimg').attr('src');
    //     console.log(imgSrc);
    //     $("#profileimg").attr("src", imgSrc);
    //       //$('.cross').removeClass('d-none');
    //        e.preventDefault();
    //     }
        
        
    // });
      // $(".save").on("click", function(e) {
      //   let img = $('#profileimg').attr('src');
      //   console.log(img)
      //   $("#profileimg").attr("src",img);
      //   e.preventDefault();
      // });
})