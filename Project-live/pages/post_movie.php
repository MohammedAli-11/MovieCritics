<?php
require('../components/global/head.php');
require('../components/nav.php');

if (!isset($_SESSION) && !headers_sent()) {
  session_start();
}

if (isset($_SESSION['email'])) {
?>

  <main class="text-black" style="height: max-content;">

    <div class="container p-5 rounded-5 mt-5" style="color: white; max-width: 600px; background: #070707; border: 1px solid rgba(0,255,255,10%);">
      <!-- form -->
      <form class="d-flex flex-column jusify-content-center" action="../database/post_movie.src.php" method="post" enctype="multipart/form-data">
        <!-- name -->
        <div class="mb-2">
          <label for="movie_name" class="form-label">Movie name</label>
          <input type="text" name="movie_name" class="form-control" id="movie_name" aria-describedby="movie-name" required>
        </div>
        <!-- genre -->
        <div class="mb-3">
          <label for="genre" class="form-label">Genre</label>
          <input type="text" name="genre" class="form-control" id="genre" required>
        </div>
        <!-- release year -->
        <div class="mb-3">
          <label for="release_year" class="form-label">Release Year</label>
          <input type="number" name="release_year" class="form-control" id="release_year" required>
        </div>

        <!-- image -->
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input type="file" name="image" class="form-control" id="image" required>
        </div>

        <!-- description -->
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" class="form-control" id="description" rows="5" required></textarea>
        </div>

        <!-- submit button -->
        <button type="submit" name="submit-movie" class="btn mb-2 align-self-center mt-4" style="min-width: 150px; border: 1px solid cyan; color: white;">Post</button>
      </form>
  </main>


  <?php
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "stmtFailed") {
      echo '<p style="color:red;font-weight:bold;">Something went wrong!</p>';
    } else if ($_GET["error"] == "none") {
      echo '<p style="color:green;font-weight:bold; text-align: center;">Movie posted successfully!</p>';
    }
  }
  ?>

<?php
}
require('../components/global/foot.php'); ?>