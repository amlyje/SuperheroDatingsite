<?php
include '../include/database.php';

  $image = $_POST['image'];

  $updateUser = $conn->prepare("UPDATE user SET image = :image WHERE email='mindyMcCready@mail.com'");
  $updateUser->bindParam(':image', $image);

  $updateUser->execute();

  header("Location: ../profile.php"); /* Redirect browser */

  /* Make sure that code below does not get executed when we redirect. */
  exit;
  ?>
