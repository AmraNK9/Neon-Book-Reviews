// $(document).ready(function () {
//   $(document.body).on("click",".success123",function() {
//       console.log("Clik")
//         var bookId = $(this).data('book-id');
//         console.log(bookId)
        
//         $('#selected_book_id').val(bookId);
//         // e.preventDefault();
//         //$('form').submit();
        
        
//     });
//     $(document.body).on("click",".unselete123",function(){
//       // $(".btn-success").remove();
//       // $(".btn-danger").append();
//         var bookId = $(this).data('book-id');
//         console.log(bookId)
//         $('#selected_book_id').val(bookId);
//         //e.preventDefault();
        
        
//         //$('form').submit();
        
        
//     });
// });
$(document).ready(function() {
  $(document.body).on("click", ".success123", function() {
      var bookId = $(this).data('book-id');
      $('#selected_book_id').val(bookId);
      $('#editorChoiceForm').attr('action', 'addeditorchoice.php');
      $('#editorChoiceForm').submit();
  });

  $(document.body).on("click", ".unselete123", function() {
      var bookId = $(this).data('book-id');
      $('#selected_book_id').val(bookId);
      $('#editorChoiceForm').attr('action', 'removeeditorchoice.php');
      $('#editorChoiceForm').submit();
  });
});
