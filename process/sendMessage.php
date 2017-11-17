<?php
include '../include/database.php';

  $current_user_email = 'mindyMcCready@mail.com';

  $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_EMAIL);
  $sender_id = $current_user_email;
  $subject = $_POST['subject'];
  $message_text = $_POST['message_text'];

  $sendMessage = $conn->prepare("INSERT INTO message (receiver_email, subject, message_text, sender_email) VALUES (?, ?, ?, ?)");
  $sendMessage->bindParam(1, $user_id);
  $sendMessage->bindParam(2, $subject);
  $sendMessage->bindParam(3, $message_text);
  $sendMessage->bindParam(4, $sender_id);

  $sendMessage->execute();

  header("Location: ../index.php"); /* Redirect browser */

  /* Make sure that code below does not get executed when we redirect. */
  exit;
  ?>
