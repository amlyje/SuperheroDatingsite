<?php
include '../include/database.php';

  $current_user_email = 'mindyMcCready@mail.com';
  $superhero_name = $_POST['superhero_name'];
  $superpower = $_POST['superpower'];
  $profile_text = $_POST['profile_text'];

  $updateUser = $conn->prepare("UPDATE user SET superhero_name = :superhero_name, superpower = :superpower, profile_text = :profile_text WHERE email= :email");
  $updateUser->bindParam(':superhero_name', $superhero_name);
  $updateUser->bindParam(':superpower', $superpower);
  $updateUser->bindParam(':profile_text', $profile_text);
  $updateUser->bindParam(':email', $current_user_email);

  $updateUser->execute();

  header("Location: ../profile.php"); /* Redirect browser */

  /* Make sure that code below does not get executed when we redirect. */
  exit;

  ?>
