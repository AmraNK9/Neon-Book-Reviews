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
												<p class="comment-text">
												${form.value}
												</p>
												<span class="comment-meta">-
												${userName}
												</span>
											</div>
										</li>	
										`
	$(`#comment-list-${Id}`).prepend(cmListItem)
	if (form.value !== "") {
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