<div class="container-lg hero mt-5">
  <div class="row row-cols-1 row-cols-md-3 gap-4 justify-content-center justify-content-xl-start" id="livesearch">
    <?php

    // session checking
    if (!isset($_SESSION) && !headers_sent()) {
      session_start();
    }

    ?>


    <?php
    foreach ($movies as $item) {
      $id = $item[0];
      $name = $item[1];
      $genre = $item[2];
      $release_year = $item[3];
      $image = "https://cse-482.000webhostapp.com/" . substr($item[4], 3);
      $likes = $item[6];
    ?>
      <a href="https://cse-482.000webhostapp.com/pages/movie_details.php?id=<?php echo $id ?>" class="col" style="max-width: 300px; text-decoration: none; color: black;">
        <div class="card movie-card">
          <div style="width: 100%;">
            <div style="overflow: hidden; position: relative; width: 100%; padding-bottom: 95%;">
              <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                <img src="<?php echo $image ?>" alt="" style="object-fit: cover; height: 100%; width: 100%;" />
              </div>
            </div>
          </div>
          <div class="card-body d-flex flex-column justify-content-center align-items-center gap-2">
            <h6 class="card-title fs-5"> <?php echo $name; ?></h6>
            <div class="d-flex align-items-center justify-content-center w-100 gap-2" style="color: #545454; font-size: 0.9rem;">
              <span><i class="bi bi-calendar"></i> <?php echo $release_year ?></span>
              <span>•</span>
              <span><i class="bi bi-tag"></i> <?php echo $genre ?></span>
              <span>•</span>
              <span><i class="bi bi-hand-thumbs-up"></i> <?php echo $likes ?></span>
            </div>
          </div>
        </div>
      </a>
    <?php
    }
    ?>
  </div>
</div>