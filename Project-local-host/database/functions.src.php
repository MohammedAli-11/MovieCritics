<?php

function isPasswordConfirmed($password, $confirmedPassword)
{
  return $password == $confirmedPassword;
}


function isAlreadyUser($conn, $email)
{
  $query = "SELECT * FROM users WHERE email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/auth/signup.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($resultData);
  mysqli_stmt_close($stmt);
  if ($row) {
    return $row;
  }
  return false;
}


function createUser($conn, $username, $email, $password)
{
  $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/auth/signup.php?error=stmtFailed");
    exit();
  }
  // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../components/auth/login.php?error=none");
  exit();
}


function loginUser($conn, $inputEmail, $inputPassword)
{
  $isUser = isAlreadyUser($conn, $inputEmail);

  if (!$isUser) {
    header("location: ../components/auth/login.php?error=wrongLoginDetails");
    exit();
  }
  $passwordMatch = $isUser["password"] == strval($inputPassword);
  if (!$passwordMatch) {
    header("location: ../components/auth/login.php?error=wrongLoginDetails");
    exit();
  } else if ($passwordMatch) {
    if (!isset($_SESSION)) {
      session_start();
    }
    $_SESSION["id"] = $isUser["id"];
    $_SESSION["email"] = $isUser["email"];
    $_SESSION["username"] = $isUser["username"];
    $_SESSION["type"] = $isUser["type"];

    $cookie_name = "user";
    $cookie_value = $isUser["email"];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

    // header("location: ../components/dashboard/dashboard.php");
    header("location: ../index.php");
    exit();
  }
}

function updateProfile($conn, $username, $email, $id)
{
  $query = "UPDATE users SET username = ?, email = ? WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/profile_edit.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $_SESSION["email"] = $_POST["email"];
  $_SESSION["username"] = $_POST["username"];

  header("location: ../components/profile_edit.php?error=none");
  exit();
}


function getUserInfo($conn, $uid)
{
  $query = "SELECT * FROM users WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/dashboard.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "i", $uid);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($resultData);
  mysqli_stmt_close($stmt);
  return $row;
}

function postMovie($conn, $movie_name, $genre, $release_year, $folder, $description)
{
  $query = "INSERT INTO movies (movie_name, genre, release_year, image, description) VALUES (?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../pages/post_movie.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ssiss", $movie_name, $genre, $release_year, $folder, $description);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../pages/post_movie.php?error=none");
  exit();
}

function getAllMovies($conn)
{
  $query = "SELECT * FROM movies ORDER BY release_year DESC;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/item_view_admin.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $rows = mysqli_fetch_all($resultData);
  mysqli_stmt_close($stmt);
  return $rows;
}

function getMovieDetails($conn, $id)
{
  $query = "SELECT * FROM movies WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/item_view_admin.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($resultData);
  mysqli_stmt_close($stmt);
  return $row;
}

function postComment($conn, $text, $uid, $mid)
{
  $query = "INSERT INTO comments (text, uid, mid) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../pages/movie_details.php?error=stmtFailed&id=" . $mid);
    exit();
  }
  mysqli_stmt_bind_param($stmt, "sii", $text, $uid, $mid);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../pages/movie_details.php?error=none&id=" . $mid);
  exit();
}

function getAllComments($conn, $mid)
{
  $query = "SELECT * FROM comments WHERE mid = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/pages/movie_details.php?error=stmtFailed" . "id=" . $mid);
    exit();
  }
  mysqli_stmt_bind_param($stmt, "i", $mid);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $rows = mysqli_fetch_all($resultData);
  mysqli_stmt_close($stmt);
  return $rows;
}

function likeMoview($conn, $uid, $mid)
{
  $query = "INSERT INTO likes (uid, mid) VALUES (?, ?);";
  $query2 = "UPDATE movies SET likes = likes + 1 WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);
  $stmt2 = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query) || !mysqli_stmt_prepare($stmt2, $query2)) {
    header("location: ../pages/movie_details.php?error=stmtFailed&id=" . $mid);
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ii", $uid, $mid);
  mysqli_stmt_bind_param($stmt2, "i", $mid);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_execute($stmt2);
  mysqli_stmt_close($stmt);
  mysqli_stmt_close($stmt2);
  header("location: ../pages/movie_details.php?id=" . $mid);
  exit();
}

function unlikeMoview($conn, $uid, $mid)
{
  $query = "DELETE FROM likes WHERE uid = ? AND mid = ?";
  $query2 = "UPDATE movies SET likes = likes - 1 WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);
  $stmt2 = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query) || !mysqli_stmt_prepare($stmt2, $query2)) {
    header("location: ../pages/movie_details.php?error=stmtFailed&id=" . $mid);
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ii", $uid, $mid);
  mysqli_stmt_bind_param($stmt2, "i", $mid);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_execute($stmt2);
  mysqli_stmt_close($stmt);
  mysqli_stmt_close($stmt2);
  header("location: ../pages/movie_details.php?id=" . $mid);
  exit();
}

function isAlreadyLiked($conn, $uid, $mid)
{
  $query = "SELECT * FROM likes WHERE uid = ? AND mid = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/auth/signup.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ii", $uid, $mid);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($resultData);
  mysqli_stmt_close($stmt);
  if ($row) {
    return true;
  }
  return false;
}

function handleSearch($conn, $q)
{
  $query = "SELECT * FROM movies WHERE movie_name = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/hero.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $q);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_all($resultData);
  mysqli_stmt_close($stmt);
  return $row;
}
