    // Get the element you want to track scroll events on
var element = document.querySelector("body");

// Add a scroll event listener to the element
element.addEventListener('scroll', function(event) {
  // This function will be called when the scroll event occurs
  // You can perform any actions you want here
  
  // Get the current scroll position
  var scrollTop = event.target.scrollTop;
  var scrollLeft = event.target.scrollLeft;
  
  // Perform actions based on the scroll position
  // For example, you can check if the user has scrolled to the bottom
  if (scrollTop + element.clientHeight >= element.scrollHeight) {
    console.log('Scrolled to the bottom!');
  }
});
// Add event listener to "See More" link
const seeMoreLinks = document.querySelectorAll('.read-more-btn');

seeMoreLinks.forEach(link => {
  link.addEventListener('click', function(event) {
    event.preventDefault();
    const bookCard = this.closest('.book-card');
    const description = bookCard.querySelector('.book-description');
    const readReviewLink = bookCard.querySelector('.read-review');

    // Toggle the visibility of the book description
    if (description.style.maxHeight) {
      description.style.maxHeight = null;
      this.textContent = '...See More';
    //   readReviewLink.style.display = 'inline-block';
    } else {
      description.style.maxHeight = description.scrollHeight + 'px';
      this.textContent = '...See Less';
    //   readReviewLink.style.display = 'none';
    }
  });
});

//Rating Function
const stars = document.querySelectorAll('.star');
let rating = 0;

stars.forEach((star, index) => {
  star.addEventListener('click', () => {
    rating = index + 1;
    highlightStars(rating);
  });

  star.addEventListener('mouseover', () => {
    highlightStars(index + 1);
  });

  star.addEventListener('mouseout', () => {
    highlightStars(rating);
  });
});

function highlightStars(num) {
  stars.forEach((star, index) => {
    if (index < num) {
      star.style.backgroundImage = 'url(star-icon-filled.png)';
    } else {
      star.style.backgroundImage = 'url(star-icon.png)';
    }
  });
}

//book marked function

// Get the bookmark icon element
const bookmarkIcon = document.querySelector('.bookmark-icon');

// Add click event listener to toggle bookmark status
bookmarkIcon.addEventListener('click', function() {
  // Toggle the 'active' class on the bookmark icon
  this.classList.toggle('active');

  // Get the bookmark status
  const isBookmarked = this.classList.contains('active');

  // Update the bookmark status based on the current state
  if (isBookmarked) {
    // Book is bookmarked, change the icon to indicate bookmarked state
    this.querySelector('i').classList.remove('fa-regular');
    this.querySelector('i').classList.add('fa-solid');
    console.log('Bookmarked');
  } else {
    // Book is unbookmarked, change the icon to indicate unbookmarked state
    this.querySelector('i').classList.remove('fa-solid');
    this.querySelector('i').classList.add('fa-regular');
    console.log('Unbookmarked');
  }
});
