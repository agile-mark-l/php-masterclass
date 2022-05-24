<!DOCTYPE html>
<html lang="en">
  <?php
    include 'inc/functions.php';

    $id = $_GET["id"];

    $post = getPost($id);
    if (!$post) {
      header('Location: 404.php?error=Article not found');
      die();
    }
    echo $post->izpisiCeloto();
  ?>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title><?= $post["title"]; ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="css/custom.css" rel="stylesheet"/>
  </head>
  <body>
  <!-- Responsive navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">Agiledrop PHP-Masterclass</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
          class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Page content-->
  <div class="container">
    <?php 
        print '<div class="full-post">';
        print "<h2>" . $post["title"] . "</h2>";
        if($post["image"] != null) {
            print '<img src="' . $post["image"]["url"] . '" alt="' . $post["image"]["alt"] . '">';
        }
        print '<p>' . $post["content"] . '</p>';
        print '<div class="author">' . $post["authored by"] . '</div>';
        print '<div class="time">' . date('d.m.Y', $post["authored on"]) . '</div>';
        print '</div>';    
    ?>
  </div>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  </body>
</html>