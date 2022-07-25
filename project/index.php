<!-- head -->
<?php require('components/global/head.php');

if (!isset($_SESSION)) {
  session_start();
}

// if (!isset($_SESSION['email'])) {
?>
<!-- body -->
<main style="height: 100%;">
  <!-- nav -->
  <?php require('components/nav.php'); ?>

  <!-- hero -->
  <?php require('components/hero.php'); ?>
</main>

<?php
// } else {
//   header("location: components/dashboard/dashboard.php");
//   exit();
// }

// foot
require('components/global/foot.php'); ?>