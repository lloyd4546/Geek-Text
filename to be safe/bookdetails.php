<?php
// including database connection
require 'init.php';
$bookcode = $_GET['bookid'];
echo $bookcode;
$result = mysqli_query($link, "select comment,bookcover from book
left join review on book.bookid = review.bookid
where book.bookid=$bookcode");
while($res = mysqli_fetch_array($result))
{
  $comment = $res['comment'];
  $cover = $res['bookcover'];
}
echo $comment;
echo $cover;

?>
<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <title>GeekText</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/bookdetails.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,900|Ubuntu&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>

<body>

  <section id="title">

    <div class="container-fluid">

      <!-- Nav Bar -->
      <nav class="navbar navbar-expand-lg navbar-dark">

        <a class="navbar-brand" href="">GeekText</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Login</a></a>
            </li>
          </ul>
        </div>
      </nav>




      <!-- Title -->
      <div class="row">
        <div class="col-lg-6">
          <h1>BookTitle</h1>
          <img class="img-responsive img-thumbnail" src="images/<?php echo $cover; ?>">
        </div>
        <div class="col-lg-6">
          <p class = "bookdetails" "author-name">Author: <%= book.Author %></p>
          <p class = "bookdetails" "publisher-name">Publisher: <%= book.Publisher %></p>
          <p class = "bookdetails" "isbn">ISBN: <%= book.ISBN %></p>
          <p class = "bookdetails" "book-genre">Genre: <%= book.Genre %></p>
          <p class = "bookdetails" "avg-rating">Avg. Rating:</p>
          <p class = "bookdetails" "publish-date">Published On: <%= book.PublicationDate %></p>
          <p class = "bookdetails" "book-price">Price: $<%= book.Price %></p>
        </div>
      </div>
    </div>

    </div>
  </section>


  <!-- Features -->




  <section id="reviews">
    <div class="row">
      <h4>Reviews</h4>




<?php

    if (mysqli_num_rows($result) > 0) {

        
        echo '<section class="col-md-10">
              <div class="row">';
        while ($row = mysqli_fetch_assoc($result)) { 
         
            echo
            '<div class="col-sm-6 col-md-4" style="height: 620px">
                <div class="thumbnail">
                    <a href="book.php?id='.$row['bookid'].'">
                        <img src="images/'.($row['bookcover'] ? $row['bookcover'] : 'default-placeholder.png').'" alt="">
                    </a>
                    <div class="caption">
                        <h3>'.$row["comment"].'</h3>

                    </div>
                </div>
            </div>';
        }
        echo
        '</div>
    </section>
</main>';
    }
    
?>
















<?php
while ($rows = mysqli_fetch_assoc($result)) {   
echo
'<div class="container">
  <div class="card">
    <div class="card-body"> <h3>'.$rows["comment"].'</h3> </div>
  </div>
</div>';
}
?>


    </div>
    <p><?php echo $comment ?></p>
  </section>


    <!-- Footer -->

    <footer id="footer">
      <div class="footer-box container-fluid">
        <div class= "social-media-emoji">
          <i class="fab fa-twitter"></i>
          <i class="fab fa-facebook-f"></i>
          <i class="fab fa-instagram"></i>
          <i class="fas fa-envelope"></i>
        </div>
        <p class="footer-text">© Copyright 2020 GeekText</p>
      </div>

    </footer>


</body>

</html>
