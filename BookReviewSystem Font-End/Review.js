// Comment Load More Function
// $(document).ready(function() {
//     var commentsPerPage = 2; // Number of comments to show per page
//     var $commentList = $('.comment-list');
//     var $loadMoreBtn = $('.load-more-btn');
//     var totalComments = $commentList.children('.comment').length;
//     var visibleComments = commentsPerPage;

//     // Initially hide all comments beyond the specified limit
//     $commentList.children('.comment:gt(' + (visibleComments - 1) + ')').hide();

//     // Show/hide "Load More" button based on the number of comments
//     if (totalComments <= visibleComments) {
//       $loadMoreBtn.hide();
//     }

//     // Handle "Load More" button click event
//     $loadMoreBtn.on('click', function() {
//       visibleComments += commentsPerPage;

//       // Show the next set of comments
//       $commentList.children('.comment:lt(' + visibleComments + ')').show();

//       // Hide the "Load More" button if all comments are visible
//       if (visibleComments >= totalComments) {
//         $loadMoreBtn.hide();
//       }
//     });
//   });
//function comment loadMore function
// function CheckCommentLists(id){ //to hide load more btn acct list length
// 	var commentsPerPage = 2; // Number of comments to show per page
//     var $commentList = $(`#comment-list-${id}`);
// 	console.log($commentList);
//     var $loadMoreBtn = $('.load-more-btn');
//     var totalComments = $commentList.children('.comment').length;
//     var visibleComments = commentsPerPage;

//     // Initially hide all comments beyond the specified limit
//     $commentList.children('.comment:gt(' + (visibleComments - 1) + ')').hide();

//     // Show/hide "Load More" button based on the number of comments
//     if (totalComments <= visibleComments) {
//       $loadMoreBtn.hide();
//     }
// 	   // Handle "Load More" button click event
// 	   $loadMoreBtn.on('click', function() {
// 		visibleComments += commentsPerPage;

// 		// Show the next set of comments
// 		$commentList.children('.comment:lt(' + visibleComments + ')').show();

// 		// Hide the "Load More" button if all comments are visible
// 		if (visibleComments >= totalComments) {
// 		  $loadMoreBtn.hide();
// 		}
// 	  });

// }
//Like Btn
const LikesBtns = document.querySelectorAll(".like-btn");
function checkLikes() {
	LikesBtns.forEach((element) => {
		if (element.classList.contains("liked")) {
			let likeIcon = element.querySelector(".fa-thumbs-up");
			likeIcon.classList.add("liked-like-icon");
			let likeText = element.querySelector(".like-text");
			likeText.innerText = "Liked";
		}
	});
}
checkLikes();

const mainDocument = document.querySelector("main");
function toggleLike(btn) {
	let user_id = mainDocument.dataset.userId;
	console.log(user_id); // Outputs: "user id"
	let review_id = btn.dataset.reviewId;
	console.log(review_id);
	btn.classList.toggle("liked");
	const likeText = btn.querySelector(".like-text");
	const likeCount = btn.querySelector(".like-count");
	const likeIcon = btn.querySelector(".fa-thumbs-up");
	likeIcon.classList.toggle("liked-like-icon");
	if (btn.classList.contains("liked")) {
		likeText.innerText = "Liked";
		likeCount.innerText = parseInt(likeCount.innerText) + 1;
		$.ajax({
			type: "POST",
			url: "reviews_react.php",
			data: {
				method: "create",
				user_id: user_id,
				review_id: review_id,
			},
			success: function (response) {
				// console.log(response);
			},
		});
	} else {
		likeText.innerText = "Like";
		likeCount.innerText = parseInt(likeCount.innerText) - 1;

		$.ajax({
			type: "POST",
			url: "reviews_react.php",
			data: {
				method: "delete",
				user_id: user_id,
				review_id: review_id,
			},
			success: function (response) {
				// console.log(response);
			},
		});
	}
}

//Create Comment Function
function LeeError(btn) {
	let userImage = mainDocument.dataset.userImage;
	let userName = mainDocument.dataset.userName;
	let Id = btn.dataset.reviewId;
	let CommentDiv = document.querySelector(`#comment-form-${Id}`);
	let commentList = document.querySelector(`#comment-list-${Id}`);
	let form = CommentDiv.querySelector("textarea");
	let cmListItem = `
					<li class="comment">
						<div class="comment-avatar">
							<img src="${userImage}" alt="${userImage}" />
						</div>
						<div class="comment-content">
						<p class="ago" style="color: #888;">now</p>
							<p class="comment-text">
							${form.value}
							</p>

							<span class="comment-meta">-
							${userName}
							</span>
						</div>
					</li>	
					`
	if (form.value !== "") {
		$(`#comment-list-${Id}`).prepend(cmListItem)

		$.ajax({
			type: "POST",
			url: "createReviewComment.php",
			data: {
				review: Id,
				comment: form.value,
			},
			success: function (response) {
				console.log(response);
				if (response == 1) {
					form.value = "";
				}
			},
		});
	}
}

function toggleComment(btn) {
	let Id = btn.dataset.reviewId;
	let CommentDiv = document.querySelector(`#comment-${Id}`);

	// CheckCommentLists(Id);

	CommentDiv.classList.toggle("hide");
}
var offset = 5;
var limit = 3;
//funtion load more review
let isLoading = false;

function LoadMore() {
	$.ajax({
		type: "POST",
		url: "load_more_reviews.php",
		data: {
			offset: offset,
			limit: limit,
		},
		success: function (response) {
			var reviews = $.parseJSON(response);
			var authorContainer = $("main");

			if (reviews.length > 0) {
				$.each(reviews, function (index, review) {
					let books = review.Books;
					var authorCard = `
					<div class= "container mt-4">
			<div class="review">
				<div class="review-header">
					<div class="user-profile">
						<img src="../image/${review.image}" alt="${review.image}" />
						<div class="user-details">
							<h3>
				  ${review.name}
							</h3>
							<p>${review.date}</p>
						</div>
					</div>
				</div>
				<div class="review-content">
					<div class="d-flex flex-wrap">
					
					</div>

					<p>
					${review.content}
					</p>
				</div>`;

					books.forEach((element) => {
						authorCard += `<a href="BookDetail.php?id=${element.id}">
				<div class="book-details">
					<img src="../image/photos/${element.image}" alt="${element.image}" />
					<div class="book-info">
						<h2>
						${element.name}
						</h2>
					
						<p>by
						${element.auther}
						</p>
					</div>
				</div>
			</a>`;
					});
					if (review.isReact) {
						authorCard += `
										
									<div class="review-actions position-relative">
										<button class="like-btn liked" data-user-id ="${review.user_id}" data-review-id = "${review.id}" onclick="toggleLike(this)">
											<i class="fas fa-thumbs-up liked-like-icon"></i>
											<span class="like-text">Liked</span>
											<span class="like-count">
												${review.user_react}
											</span>
										</button>
										<button class="comment-btn" data-review-id = "${review.id}"  onclick="toggleComment(this)">
											<i class="fas fa-comment"></i>
											 Comment
										</button>
									</div>
									<div class="comments hide" id = "comment-${review["id"]}">
										<h4>Comments</h4>
										<ul class="comment-list">
					`;
					} else {
						authorCard += `<div class="review-actions position-relative">
											<button class="like-btn " data-user-id ="${review.user_id}" data-review-id = "${review.id}" onclick="toggleLike(this)">
												<i class="fas fa-thumbs-up "></i>
												<span class="like-text">Like</span>
												<span class="like-count">
													${review.user_react}
												</span>
											</button>
											<button class="comment-btn" data-review-id = "${review.id}"  onclick="toggleComment(this)">
												<i class="fas fa-comment"></i> 
												Comment
											</button>
										</div>
										<div class="comments hide" id = "comment-${review["id"]}">
											<h4>Comments</h4>
											<ul class="comment-list" id = "comment-list-${review['id']}">																															
										`;
								}
					review.comments.forEach((element) => {
						authorCard += `
										<li class="comment" >
											<div class="comment-avatar">
												<img src="${element.image}" alt="${element.image}" />
											</div>
											<div class="comment-content">
												<p class="comment-text">
												${element.comment}
												</p>
												<span class="comment-meta">-
												${element.name}
												</span>
											</div>
										</li>`;											
									});
					authorCard += `
									</ul>

								<div class="comment-form" id = "comment-form-${review.id}" >
									<textarea class="form-control" placeholder="Add a comment"></textarea>
									<button class="btn btn-primary" data-review-id = "${review.id}"  onclick="LeeError(this)"  >Submit</button>
								</div>
							</div>
						</div>
					</div>`;
					authorContainer.append(authorCard);
					checkLikes();
				});
				offset += limit;
			}
			if (reviews.length < 3) {
				console.log(authors.length);
				$("#loadMoreBtn").hide();
			}
		},
	});
	setTimeout(() => {
		// After the loading is complete, reset the flag to allow the loadMore function to run again
		isLoading = false;
		console.log("More content loaded!");
	}, 2000); // Adjust the timeout as needed
}

// Function to check if the user has reached the bottom of the page
function isNearBottom() {
	const scrollTop =
		document.documentElement.scrollTop || document.body.scrollTop;
	const windowHeight =
		window.innerHeight || document.documentElement.clientHeight;
	const documentHeight =
		document.documentElement.scrollHeight || document.body.scrollHeight;

	return scrollTop + windowHeight >= documentHeight - 100; // Adjust the threshold as needed
}

// Function to handle the scroll event
function handleScroll() {
	if (isNearBottom() && !isLoading) {
		isLoading = true; // Set the flag to indicate that the loadMore function is running
		LoadMore();
	}
}

// Add scroll event listener to the window or your desired scrollable element
window.addEventListener("scroll", handleScroll);
