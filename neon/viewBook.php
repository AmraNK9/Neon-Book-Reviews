<?php

include_once "layouts/sidebar.php";
include_once "controller/BookController.php";
include_once "../controllers/commentController.php";
$cid=$_GET['id'];
$book_controller=new BookController();
$book=$book_controller->getBook($cid);
$comment_controller=new CommentController();
$comment=$comment_controller->getAllComments($cid);
?>



<main class="content ">
        
	<div class="container p-0">
		<!-- <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1> -->
        
                
                                <div class="col-md-3" >
                                        <div class="card" style="width: 18rem;">
                                                <img src="img/photos/<?php echo $book[0]['image'] ?>" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                        <h3 class="card-tit"><strong><?php echo $book[0]['name'] ?></strong></h3>
                                                        <?php  
                                                        foreach ($book as $value) {
                                                        ?>
                                                        <span ><?php echo $value['category_name'] ?> /  </span>
                                                        <?php     
                                                        }
                                                        ?>
                                                        
                                                        <h4 class="card-title"><strong><?php echo $book[0]['auther_name'] ?></h3>
                                                        <button class="btn btn-primary open" id="open">Read</button>
                                                
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-3" >
                                        <div class="comments" style="width: 80rem; height:500px; overflow:scroll; padding:0;">
                                                <h4 style="  position: sticky; top: 0; background-color:#E8EBF0; height: 30px; padding-left: 20px; padding-top: 5px;">Comments</h4>
                                                <ul class="comment-list">
                                                        <?php
                                                        foreach ($comment as $com) {
                                                        ?>
                                                        <li class="comment" data-comment-id="<?php echo $com['id']; ?>">
                                                                <div class="comment-avatar">
                                                                        <img
                                                                                src="../image/photos/<?php echo $com['image'] ?>"
                                                                                alt="<?php echo $com['name'] ?>"
                                                                        />
                                                                </div>
                                                                <div class="comment-content">
                                                                        <p class="ago" style="color: #888;"></p>
                                                                        <p class="comment-text"><?php echo $com['comment'] ?></p>
                                                                        <span class="comment-meta">- <?php echo $com['name'] ?></span>
                                                                </div>
                                                        </li>
                        
                                                        <?php
                                                        }
                                                        ?>
					
					<!-- Add more comment list items as needed -->
				                </ul>
                                        </div>
                                </div>
                        
                                                        
        <div class="row"  id="pdfContainer"></div>
        
        
        <div>
            <a href="book.php" class="btn btn-success">Back to Users</a>
        </div>
	</div>
        
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
      $("#open").click(function() {
        openPDF("pdf/<?php echo $book[0]['pdf_file'] ?>");
      });

//       $(".comment").click(function() {
//         // openPDF("pdf/sample.pdf");
//         console.log('comment');
//       });

    });
    function openPDF(filePath) {
        event.preventDefault();
        
      var pdfContainer = $("#pdfContainer");
      
      pdfContainer.html('<iframe src="' + filePath + '" width="100%" height="600px" ></iframe>');
    }
    <?php foreach ($comment as $com) : ?>
				// Get the writing time from PHP (assuming it's stored in a variable called writingTime)
				var writingTime = "<?php echo $com['date']; ?>";

				// Convert the writing time to JavaScript Date object
				var writingDate = new Date(writingTime);

				// Calculate the time difference in milliseconds
				var timeDiff = Date.now() - writingDate.getTime();

				// Define time intervals in milliseconds
				var minute = 60 * 1000;
				var hour = 60 * minute;
				var day = 24 * hour;

				// Calculate the time difference in different units
				var diff;
				if (timeDiff < minute) {
					diff =  "now";
				} else if (timeDiff < hour) {
					diff = Math.floor(timeDiff / minute) + " minutes ago";
				} else if (timeDiff < day) {
					diff = Math.floor(timeDiff / hour) + " hours ago";
				} else {
					diff = writingDate.toDateString(); // Writing time as a formatted date if it's more than a day ago
				}

				// Output the time difference
				$('.comment[data-comment-id="<?php echo $com['id']; ?>"] .ago').text(diff);
			<?php endforeach; ?>
  </script>
<?php

include_once "layouts/footer.php"

?>