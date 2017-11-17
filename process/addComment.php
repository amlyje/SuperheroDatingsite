<?php
include '../include/database.php';

  $current_user_email = 'mindyMcCready@mail.com';

  $user_id = $_POST['user_id'];
  $sender_id = $current_user_email;
  $comment_text = $_POST['comment_text'];

  $addComment = $conn->prepare("INSERT INTO comment (receiver_email, comment_text, sender_email) VALUES (?, ?, ?)");
  $addComment->bindParam(1, $user_id);
  $addComment->bindParam(2, $comment_text);
  $addComment->bindParam(3, $sender_id);

  $addComment->execute();

  header("Location: ../index.php"); /* Redirect browser */

  /* Make sure that code below does not get executed when we redirect. */
  exit;
  ?>
