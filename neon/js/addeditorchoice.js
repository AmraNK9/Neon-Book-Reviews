$(document).ready(function(e) {
    $(document.body).on("click",'.unselect-btn',function() {
      console.log("Hello")
       var bookId = $(this).data('book-id');
       console.log(bookId);
      $('#selected_book_id').val(bookId);
   $(this).parent().parent().remove();
      // $('form').submit(function() {
      // //  e.preventDefault(); // Prevent default form submission behavior
  
      //   $.ajax({
      //     type: 'POST',
      //     url: $(this).attr('action'),
      //     data: $(this).serialize(),
      //     //success: function() {
      //   //  location.reload(); // Reload the page after successful form submission
      //    // }
      //   });
      // });
  
      //  $('form').submit(); // Trigger the form submission
    });
  });