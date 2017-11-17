<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Superhero Dating</title>
    <!-- Link til stylesheets -->
    <link rel="stylesheet" href="css/reset.css" type="text/css">
  	<link rel="stylesheet" href="css/style.min.css" type="text/css">
    <!-- Link til Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
  </head>
  <body>
    <header>
      <h1>welcome to superhero dating</h1>
      <?php include 'include/header.php';?>
    </header>
    <?php

    $users = $conn->query('SELECT * FROM user')->fetchAll();
    $comments = $conn->query('SELECT * FROM comment')->fetchAll();
    $user_comments = $conn->query('SELECT * FROM user JOIN comment ON comment.sender_email = user.email')->fetchAll();

    $current_user_email = 'mindyMcCready@mail.com';

    $current_user = $conn->prepare('SELECT * FROM user WHERE email = :email');
    $current_user->bindParam(':email', $current_user_email);
    $current_user->execute();
    foreach ($current_user as $current){};

    foreach ($users as $id=>$user) {
      if ($user['email'] !== $current['email']){
        ?>
        <article class="box">
          <section class="profile_box">
          <!-- Billede -->
          <section class="profile_image">
            <img src="images/<?php echo $user['image']; ?>" alt="<?php echo $user['superhero_name']; ?>">
          </section>
          <section class="profile_info">
            <!-- Brugerinformation -->
            <h2 class="name"><?php echo $user['superhero_name'];?></h2>
            <p class="age"><?php echo $user['age']; ?> years old</p>
            <p class="superpower">My superpower: <?php echo $user['superpower']; ?></p>
            <p class="description">"<?php echo $user['profile_text']; ?>"</p>
            <p class="likes">LIKES </p><p class="text_box"><?php echo $user['likes']; ?></p>
            <!-- Giv et like -->
            <form action="process/updateLike.php" method="post">
              <input type="hidden" name="user_id" value="<?php echo $user['email']; ?>">
              <button type="submit" name="button" value="insert" class="action_button">Give <?php echo $user['superhero_name']; ?> a Like!</button>
            </form>
            <!-- Brugerkommentarer -->
            <p class="tagline">User comments</p>
            <?php
            foreach ($comments as $comment) {
              if ($comment['receiver_email'] === $user['email']){?>
                <section class="comment">
                  <?php
                  foreach ($user_comments as $user_comment) {
                    if ($comment['sender_email'] === $user_comment['sender_email'] && $comment['id'] === $user_comment['id']){?>
                    <p class="name"><?php echo $user_comment['superhero_name']; ?></p>
                  <?php
                }};
                  ?>
              <p class="date"><?php echo $comment['date']; ?></p>
              <p class="comment_text"><?php echo $comment['comment_text']; ?></p>
              </section>
            <?php
              }};
             ?>
             <!-- Tilføj kommentar -->
             <p class="tagline">Add comment</p>
             <form class="leftalign" action="process/addComment.php" method="post">
               <input type="hidden" name="user_id" value="<?php echo $user['email']; ?>">
               <textarea type="text" name="comment_text" rows="6" cols="66" maxlength="500"></textarea><br>
               <button class="action_button" type="submit" name="button" value="insert">Add</button>
             </form>
           </section>
           </section>
           <!-- Send besked -->
           <p class="tagline send_message">Send <?php echo $user['superhero_name']; ?> a private message!</p>
           <!-- Modalboks til besked -->
               <form action="process/sendMessage.php" method="post">
                 <input type="hidden" name="user_id" value="<?php echo $user['email']; ?>">
                 <label for="subject">Subject</label><br><textarea type="text" name="subject" rows="1" cols="80" maxlength="50"></textarea><br>
                 <label for="message_text">Your message</label><br><textarea name="message_text" rows="8" cols="80" maxlength="500"></textarea><br>
                 <button type="submit" name="button" class="action_button" value="insert">Send message</button>
               </form>
            <?php
              }
            ?>
        </article>
        <?php
          }
        ?>
  </body>
</html>
