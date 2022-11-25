<?php
require('../components/global/head.php');
require('../components/nav.php');
require_once('../database/movie_details.src.php');
require_once('../database/comments.src.php');


$image = "http://localhost/projects/project/" . substr($movie_details["image"], 3);
$release_year = $movie_details["release_year"];
$genre = $movie_details["genre"];
$likes = $movie_details["likes"];

?>
<img src="<?php echo $image ?>" alt="" style="object-fit: cover; height: 600px; width: 100%; aspect-ratio: 16 / 9;" />

<div class="container d-flex flex-column justify-content-center gap-4 px-5" style="max-width: 1000px; color: white; background: #070707; border: 1px solid rgba(0,255,255,10%);">
  <div class="d-flex flex-column align-items-center justify-content-center gap-1">
    <h2 class="mt-4 text-center"><?php echo $movie_details["movie_name"] ?></h2>

    <div class="d-flex align-items-center gap-4 justify-content-center" style="color: gray; font-size: 1.1rem;">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-calendar"></i>
        <span><?php echo $release_year ?></span>
      </div>

      <span>•</span>

      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-tag"></i>
        <span> <?php echo $genre ?></span>
      </div>

      <span>•</span>

      <!-- like unlike -->
      <?php
      if ($isAlreadyLiked) {
      ?>
        <form action="../database/like.src.php?id=<?php echo $_GET["id"] ?>" method="POST">
          <button class="d-flex align-items-center gap-2" type="submit" name="submit-unlike" style="appearance: none; background: none; outline: none; border: none;">
            <i class="bi bi-hand-thumbs-up-fill" style="cursor: pointer; color: cyan;"></i>
            <div style="color: white;"> <?php echo $likes ?></div>
          </button>
        </form>
      <?php
      } else {
      ?>
        <form action="../database/like.src.php?id=<?php echo $_GET["id"] ?>" method="POST">
          <button class="d-flex align-items-center gap-2" type="submit" name="submit-like" style="appearance: none; background: none; outline: none; border: none;">
            <i class="bi bi-hand-thumbs-up" style="cursor: pointer; color: cyan;"></i>
            <div style="color: white;"> <?php echo $likes ?></div>
          </button>
        </form>
      <?php
      }
      ?>
    </div>
  </div>

  <p class="mt-4">
    <?php echo $movie_details["description"] ?>
  </p>

  <div class="d-flex flex-column justify-content-center align-items-center gap-4 w-100">
    <h5 class="align-self-start mt-4 fw-bold" style="color: cyan;">Reviews:</h5>

    <div class="d-flex flex-column align-self-start rounded w-100" style="gap: 0.5rem; background: transparent;">
      <?php
      if ($comments) {
        foreach ($comments as $comment) {
          $text = $comment[1];
          $uid = $comment[2];
          $mid = $comment[3];

          $user = getUserInfo($conn, $uid);

      ?>
          <div class="d-flex align-items-center p-1 rounded" style="gap: 2rem; --bs-border-opacity: .1;">
            <div class="d-flex align-items-center" style="gap: 1rem;">
              <i class="bi bi-person-circle" style="color: white; font-size: 30px;"></i>
              <div style="font-weight: bold;"><?php echo $user["username"] ?></div>
            </div>
            <div><?php echo $text ?></div>
          </div>

          <div style="width: 100%; height: 1px; background-color: cyan; opacity: 10%;"></div>
      <?php
        }
      } else {
        echo '<div style="color: white;">No reviews found!</div>';
      }
      ?>
    </div>
  </div>
  <form action="../database/post_comment.src.php?id=<?php echo $_GET["id"] ?>" method="post" class="d-flex flex-column gap-3 pb-5 mt-5">
    <textarea type="text" rows="3" name="text" class="form-control" placeholder="Add a review..." required maxlength="255"></textarea>
    <button class="btn align-self-center" type="submit" name="submit-comment" id="button-addon2" style="border: 1px solid cyan; color: white; width: 100px;">
      <!-- <i class="bi bi-plus" style="color: cyan;"></i> -->
      Add
    </button>
  </form>
</div>

<?php


// error/success messages
if (isset($_GET["error"])) {
  if ($_GET["error"] == "stmtFailed") {
    echo '<p style="color:red;font-weight:bold;text-align:center;">Something went wrong! Please try again.</p>';
  } else if ($_GET["error"] == "none") {
    echo '<p style="color:green;font-weight:bold;text-align:center;margin-top: 10px;">Review added!</p>';
  }
}

require('../components/global/foot.php');
?>