<?php
include_once 'db_connection.php';

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PayPal REST API Example</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="App" style="color: white; background: black;">
  <!-- <h1 style="background: black; color: cyan;">Donation Page</h1> -->
  <div class="wrapper">
    <?php
    $results = mysqli_query($db_conn, "SELECT * FROM products where status=1");
    while ($row = mysqli_fetch_array($results)) {
    ?>
      <div class="col__box" style="border: 1px solid cyan">
        <h5><?php echo $row['name']; ?></h5>
        <h6><span> $<?php echo $row['price']; ?> </span> </h6>

        <form class=" paypal" action="request.php" method="post" id="paypal_form">
          <input type="hidden" name="item_number" value="<?php echo $row['id']; ?>">
          <input type="hidden" name="item_name" value="<?php echo $row['name']; ?>">
          <input type="hidden" name="amount" value="<?php echo $row['price']; ?>">
          <input type="hidden" name="currency_code" value="USD">

          <input type="submit" name="submit" value="Donate Now" class="btn__default" style="background: black; border: 1px solid cyan;">
        </form>
      </div>

    <?php } ?>
  </div>
  <a href="../index.php" class="btn" tabindex="-1" role="button" aria-disabled="true" style="color: cyan;">Back To Homepage</a>
</body>

</html>