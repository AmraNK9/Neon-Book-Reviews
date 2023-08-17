$(document).ready(function() {
      // $(".world").on('change',function(input) {
      //   console.log("Hello")
      //   if (input.files && input.files[0]) {
      //       var reader = new FileReader();
      //       reader.onload = function(e) {
      //         $('#preview').attr('src', e.target.result);
      //         $('.cross').removeClass('d-none');
      //         console.log("Hello")
      //       }
      //       reader.readAsDataURL(input.files[0]);
      //       console.log("Hello")
      //   }
      //   console.log("Hello")
      // })
      let input = document.getElementById('input');
      let img = document.getElementById('preview');
      $('#input').on('change',function(){
        img.src = URL.createObjectURL(input.files[0]);
        $('.cross').removeClass('d-none');
      })

      $(".camera").click(function() {
          $("input[name='image']").click();
      });
          
      $("input[name='image']").change(function() {
        var file = this.files[0];
        var reader = new FileReader();
    
        reader.onload = function(e) {
          $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(file);
      });

      $(".cancel-button").on("click",function(){
        $('#preview').attr('src', 'image/user.jpg');
        $('.cross').addClass('d-none');
      })   

      // var imgSrc = $('#preview').attr('src',"image/nurse.jpg");
      // imgSrc.on("change",function(){
      //   console.log("Hello")
      //   $('.cross').removeClass('d-none');
        
      // })
        // if (imgSrc === 'image/nurse.jpg') {
        //   $('.cancel-button').addClass('hide');
        // }else{
        //     $('.cancel-button').removeClass('hide');
        // }
              
        // $('input[name="image"]').on('change', function() {
        //   previewImage(this);
        // });
      
    //     $('.cancel-button').on('click', function() {
    //       $('#preview').attr('src', 'image/nurse.jpg');
    //     });
    
      

      // $(document).on("click", ".cancel-button", function() {
      //   $('#preview').attr('src', 'image/nurse.jpg');
      // });
      
})



