<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css" type="text/css">
  	<link rel="stylesheet" href="css/style.min.css" type="text/css">
  </head>
  <body>
    <header>
      <h1>you look fabulous today</h1>
      <?php include 'include/header.php'; ?>
    </header>
    <?php
    $current_user_email = "mindyMcCready@mail.com";

    $current_user = $conn->prepare('SELECT * FROM user WHERE email = :email');
    $current_user->bindParam(':email', $current_user_email);
    $current_user->execute();

    $comments = $conn->prepare('SELECT * FROM comment WHERE receiver_email = :email');
    $comments->bindParam(':email', $current_user_email);
    $comments->execute();

    $tagline = $conn->query('SELECT * FROM user JOIN comment ON comment.sender_email = user.email')->fetchAll();
    ?>
    <article class="box profile_box">
    <?php foreach ($current_user as $user) { ?>
        <!-- Billede -->
        <section class="profile_image">
          <img src="images/<?php echo $user['image']; ?>" alt="<?php echo $user['image']; ?>">
        </section>
        <!-- Brugerinformation -->
        <section class="profile_info">
          <h2 class="name"><?php echo $user['superhero_name']; ?></h2>
          <p class="age"><?php echo $user['age']; ?> years old</p>
          <p class="superpower">My superpower: <?php echo $user['superpower']; ?></p>
          <p class="description">"<?php echo $user['profile_text']; ?>"</p>
          <p class="likes">LIKES </p><p class="text_box"><?php echo $user['likes']; ?></p>
          <!-- Brugerkommentarer -->
          <p class="tagline">User comments</p>
          <?php
          foreach ($comments as $comment) {
            if ($comment['receiver_email'] === $user['email']){?>
              <section class="comment">
                <?php
                foreach ($tagline as $user_comment) {
                  if ($comment['receiver_email'] === $user_comment['receiver_email'] && $comment['sender_email'] === $user_comment['sender_email'] && $comment['id'] === $user_comment['id']){?>
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
          <!-- Ændre profil -->
          <button type="button" name="button" id="change_button" class="action_button">Change profile</button>
          <!-- Modal til ændre profil -->
          <div id="change_profile_modal" class="modal">
            <div class="modal-content">
            <span class="close">&times;</span>
            <form action="process/updateImage.php" method="post">
              <label for="image" class="tagline">Image</label><br><input type="file" name="image"><br>
              <button class="action_button" type="submit" name="button" value="insert">Add new image</button>
            </form>
            <form action="process/updateProfile.php" method="post">
              <label for="superhero_name" class="tagline">Superhero Name</label><br><input type="text" name="superhero_name" value="<?php echo $user['superhero_name'] ?>" maxlength="50"><br>
              <label for="superpower" class="tagline">My superpower</label><br><textarea name="superpower" rows="2" cols="80" maxlength="200"><?php echo $user['superpower'] ?></textarea><br>
              <label for="profile_text" class="tagline">Profile text</label><br><textarea name="profile_text" rows="8" cols="60" maxlength="500"><?php echo $user['profile_text'] ?></textarea><br>
              <button class="action_button" type="submit" name="button" value="insert">Save changes</button>
            </form>
          </div>
        </div>
      </section>
    </article>
    <?php
      }
    ?>

    <!-- Beskeder -->
    <article class="box messages">
      <?php
      $messages = $conn->prepare('SELECT * FROM message WHERE receiver_email = :email');
      $messages->bindParam(':email', $current_user_email);
      $messages->execute();

      $message_senders = $conn->query('SELECT email, superhero_name FROM user JOIN message ON message.sender_email = user.email GROUP BY user.email')->fetchAll();
      ?>

      <h2 class="tagline">Messages</h2>
      <?php
      foreach ($messages as $message){
      ?>
      <section class="message">
        <?php foreach ($message_senders as $message_sender) {
          if ($message['sender_email'] === $message_sender['email'])
          {?>
            <section class="comment">
            <p class="name"> <?php echo $message_sender['superhero_name'] ?> </p>
        <?php
        }};
        ?>
        <p class="date"><?php echo $message['date']; ?></p>
        <p class="subject"><?php echo $message['subject']; ?></p>
        <p class="comment_text"><?php echo $message['message_text']; ?></p>
      </section>
      <?php
      }
      ?>
    </section>
    </article>
    <!-- Gaver -->
    <article class="box gifts">
      <?php
      $gifts = $conn->prepare('SELECT * FROM user_has_gift WHERE receiver_email = :email');
      $gifts->bindParam(':email', $current_user_email);
      $gifts->execute();

      $gifts_user = $conn->prepare('SELECT * FROM user_has_gift JOIN gift ON gift.title = user_has_gift.gift_title WHERE receiver_email = :email');
      $gifts_user->bindParam(':email', $current_user_email);
      $gifts_user->execute();
      $display_gifts = $gifts_user->fetchAll();

      $gift_senders = $conn->query('SELECT email, superhero_name FROM user JOIN user_has_gift ON user_has_gift.sender_email = user.email GROUP BY user.email')->fetchAll();
      ?>

      <h2 class="tagline">Gifts</h2>
      <section class="gift_content">
      <?php
      foreach ($gifts as $gift){
        ?>
        <section class="gift_box">
        <?php
      foreach ($gift_senders as $gift_sender) {
        if ($gift['sender_email'] === $gift_sender['email'])
          {?>
            <p class="name"> <?php echo $gift_sender['superhero_name'] ?> send you a gift! </p>
          <?php
        }
      };?>
      <section class="gift">
      <p><?php echo $gift['gift_title']; ?></p>
      <?php
        foreach ($display_gifts as $display_gift) {;
          if ($gift['gift_title'] === $display_gift['title'])
          {?>
            <img src="images/<?php echo $display_gift['image'];?> " alt="">
            <p> <?php echo $display_gift['description']; ?> </p>
          <?php
          }
        } ?>
      </section>
      </section>
        <?php
      };
      ?>
    </section>
    </article>
    <!-- JS til modalboks -->
    <script type="text/javascript" src="js/script.js"></script>
  </body>
</html>
