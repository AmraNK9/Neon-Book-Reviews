<?php
$active_page = $_SERVER['PHP_SELF'];
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Review System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="Review.css" />
    <link rel="stylesheet" href="../fontawesome/css/all.css">

</head>
<style>
    .nav{
        box-shadow: 0px 2px 10px #111;
    }
    .nav-height{
        height: 100px;
    }
    @media(max-width:992px){
        .nav-height{
            height: 170px;
        }
    }
  .hide-navbar {
    transform: translateY(-51%);
    transition: transform 0.3s ease-in-out;
  }
</style>
<!-- Navigation bar -->
<nav style="width:100%;top :0px;z-index:99;box-shadow:0px 5px 40px #1111"
    class="navbar position-fixed navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand-logo" href="#">
        <img src="logo4.png" style="width: 200px; height: 60px" alt="Book Review System Logo" />
    </a>


    <div class="d-flex justify-content-center navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li
                class="nav-item <?php echo ($active_page == '/NEON/BookReviewSystem Font-End/index.php') ? 'active2' : '' ?>">
                <a class="nav-link" style="color:white" href="index.php" onclick="toggleActive(event)"><i
                        class="fa-solid fa-house-chimney mx-2" style="color:white,"></i>Home</a>
            </li>
            <li
                class="nav-item <?php echo ($active_page == '/NEON/BookReviewSystem Font-End/Books.php') ? 'active2' : '' ?>">
                <a class="nav-link" style="color:white" href="Books.php" onclick="toggleActive(event)"><i
                        class="fa-solid fa-book mx-2" style="color:white,"></i>Books</a>
            </li>
            <li
                class="nav-item <?php echo ($active_page == '/NEON/BookReviewSystem Font-End/AuthorPage.php') ? 'active2' : '' ?>">
                <a class="nav-link" style="color:white" href="AuthorPage.php" onclick="toggleActive(event)"><i
                        class="fa-solid fa-feather mx-2" style="color:white,"></i>Author</a>
            </li>
            <li
                class="nav-item <?php echo ($active_page == '/NEON/BookReviewSystem Font-End/Review.php') ? 'active2' : '' ?>">
                <a class="nav-link" style="color:white" href="Review.php" onclick="toggleActive(event)"><i
                        class="fa-solid fa-message mx-2" style="color:white,"></i>Reviews</a>
            </li>

            <li class="nav-item profile-icon ">
                    <a class="nav-link "  style="color:white" href="Profile.php">

                    <i class="fa-solid fa-user mx-2" style="color:white,"></i>
                        Profile
                    </a>

                </li>
                
        </ul>
    </div>
    <li class="nav-item d-flex justify-content-center account">
        <a href="Profile.php">
            <div class="avatar">
                <img src="../image/<?php if (empty($userimg)) {
                    echo "user.jpg";
                } else {
                    echo $userimg;
                } ?>" alt="User Avatar" />
            </div>
        </a>

    </li>
</nav>

<div class="mb-3 nav-height" style="width: 100%;">

</div>

<script>
  var navbar = document.querySelector('nav');
  var lastScrollTop = 0;
  
  window.addEventListener('scroll', function() {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    // console.log(navbar.clientHeight);
    if(navbar.clientHeight>132){
        if (scrollTop > lastScrollTop) {
      navbar.classList.add('hide-navbar');
    } else {
      navbar.classList.remove('hide-navbar');
    }
    lastScrollTop = scrollTop;
    }

  });
</script>

