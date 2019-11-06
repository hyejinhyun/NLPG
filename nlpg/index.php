<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >

  <title>Clean Blog - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.html">N.L.P.G.</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="post.html">Sample Post</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>WELCOME!</h1>
            <span class="subheading">인공지능이 요약한 기사를 읽어보세요!</span>
          </div>
        </div>
      </div>
    </div>
  </header>

<?php

$conn = mysqli_connect("localhost", "root", "171217");
mysqli_query($conn,'SET NAMES utf8');
if (!$conn) {
echo "Unable to connect to DB: " . mysqli_error();
exit;
}

if (!mysqli_select_db($conn,"test")) {
echo "Unable to select mydbname: " . mysqli_error();
exit;
}

$sql = "SELECT *
FROM sample
ORDER BY id DESC
LIMIT 10";

$result = mysqli_query($conn,$sql);

if (!$result) {
echo "Could not successfully run query ($sql) from DB: " . mysqli_error();
exit;
}

if (mysqli_num_rows($result) == 0) {
echo "No rows found, nothing to print so am exiting";
exit;
}

// While a row of data exists, put that row in $row as an associative array
// Note: If you're expecting just one row, no need to use a loop
// Note: If you put extract($row); inside the following loop, you'll
// then create $userid, $fullname, and $userstatus
echo "<table>";
while ($row = mysqli_fetch_assoc($result)) {
echo "<tr><td>{$row['id']}</td><td>{$row['title']}</td><td>{$row['content']}</td><td>{$row['url']}</td></tr>";
}
echo "</table>";
mysqli_free_result($result);

?>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">
          <a href="원래 기사 링크">
            <h2 class="post-title">
              <?php echo "{$row['title']}"?>
            </h2>
            <h3 class="post-subtitle">
              <?php echo "{$row['content']}"?>
            </h3>
          </a>
          <p class="post-meta">
            on October 24, 2019</p>  //기사 작성 날짜
        </div>

        <hr>
        <div class="post-preview">
          <a href="post.html">
            <h2 class="post-title">
              I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.
            </h2>
          </a>
          <p class="post-meta">Posted by
            <a href="#">Start Bootstrap</a>
            on September 18, 2019</p>
        </div>

        <hr>
        <div class="post-preview">
          <a href="post.html">
            <h2 class="post-title">
              Science has not yet mastered prophecy
            </h2>
            <h3 class="post-subtitle">
              We predict too much for the next year and yet far too little for the next ten.
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="#">Start Bootstrap</a>
            on August 24, 2019</p>
        </div>
        <hr>
        <div class="post-preview">
          <a href="post.html">
            <h2 class="post-title">
              Failure is not an option
            </h2>
            <h3 class="post-subtitle">
              Many say exploration is part of our destiny, but it’s actually our duty to future generations.
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="#">Start Bootstrap</a>
            on July 8, 2019</p>
        </div>
        <hr>
        <div class="post-preview">
          <a href="원래 기사 링크">
            <h2 class="post-title">
              원래 기사 제목
            </h2>
            <h3 class="post-subtitle">
              인공지능이 요약한 기사 내용
            </h3>
          </a>
          <p class="post-meta">
            on September 24, 2019</p>  //기사 작성 날짜
        </div>
        <hr>
        <div class="post-preview">
          <a href="원래 기사 링크">
            <h2 class="post-title">
              원래 기사 제목
            </h2>
            <h3 class="post-subtitle">
              인공지능이 요약한 기사 내용
            </h3>
          </a>
          <p class="post-meta">
            on September 24, 2019</p>  //기사 작성 날짜
        </div>
        <hr>
        <div class="post-preview">
          <a href="원래 기사 링크">
            <h2 class="post-title">
              원래 기사 제목
            </h2>
            <h3 class="post-subtitle">
              인공지능이 요약한 기사 내용
            </h3>
          </a>
          <p class="post-meta">
            on September 24, 2019</p>  //기사 작성 날짜
        </div>
        <hr>
        <div class="post-preview">
          <a href="원래 기사 링크">
            <h2 class="post-title">
              원래 기사 제목
            </h2>
            <h3 class="post-subtitle">
              인공지능이 요약한 기사 내용
            </h3>
          </a>
          <p class="post-meta">
            on September 24, 2019</p>  //기사 작성 날짜
        </div>
        <hr>
        <div class="post-preview">
          <a href="원래 기사 링크">
            <h2 class="post-title">
              원래 기사 제목
            </h2>
            <h3 class="post-subtitle">
              인공지능이 요약한 기사 내용
            </h3>
          </a>
          <p class="post-meta">
            on September 24, 2019</p>  //기사 작성 날짜
        </div>
        <hr>
        <div class="post-preview">
          <a href="원래 기사 링크">
            <h2 class="post-title">
              원래 기사 제목
            </h2>
            <h3 class="post-subtitle">
              인공지능이 요약한 기사 내용
            </h3>
          </a>
          <p class="post-meta">
            on September 24, 2019</p>  //기사 작성 날짜
        </div>
        <hr>
        <!-- Pager -->
        <!-- <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div> -->
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; Your Website 2019</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
