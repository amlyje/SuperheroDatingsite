<?php
include '../include/database.php';

$current_user_email = 'mindyMcCready@mail.com';

$gift_title = $_POST['gift_title'];
$user_id = $_POST['user_id'];
$sender_id = $current_user_email;

$sendMessage = $conn->prepare("INSERT INTO user_has_gift (receiver_email, gift_title, sender_email) VALUES (?, ?, ?)");
$sendMessage->bindParam(1, $user_id);
$sendMessage->bindParam(2, $gift_title);
$sendMessage->bindParam(3, $sender_id);

$sendMessage->execute();

header("Location: ../index.php"); /* Redirect browser */

/* Make sure that code below does not get executed when we redirect. */
exit;

?>
