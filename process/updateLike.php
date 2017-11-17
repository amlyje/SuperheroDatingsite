<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Send a gift!</title>
    <!-- Link til stylesheets -->
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
  	<link rel="stylesheet" href="../css/style.min.css" type="text/css">
    <!-- Link til Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
  </head>
  <body>
    <?php
    include '../include/database.php';

      $user_id = $_POST['user_id'];
      $plusLike = 1;

      $updateLikes = $conn->prepare("UPDATE user SET likes = likes + :likes WHERE email= :email");
      $updateLikes->bindParam(':likes', $plusLike);
      $updateLikes->bindParam(':email', $user_id);

      $updateLikes->execute();

      $gifts = $conn->query('SELECT * FROM gift')->fetchAll();
      $superheronames = $conn->query('SELECT email, superhero_name FROM user')->fetchAll();

      ?>
      <article class="box send_gift">
        <?php
        foreach ($superheronames as $superheroname) {
          if ($user_id === $superheroname['email']) {?>
        <h1>Send <?php echo $superheroname['superhero_name'] ?> a gift!</h1>
        <?php
        }};
        foreach ($gifts as $gift) {
         ?>
         <section class="gift">
           <h3><?php echo $gift['title']; ?></h3>
           <img src="../images/<?php echo $gift['image'];?>" alt="<?php echo $gift['title']; ?>">
           <p><?php echo $gift['description']; ?></p>
          <form action="sendGift.php" method="post">
            <input type="hidden" name="gift_title" value="<?php echo $gift['title']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <button type="submit" name="button" value="insert" class="action_button">Send</button>
          </form>
      </section>
      <?php } ?>
      <p class="tagline">Don't want to send a gift?</p>
      <a href="../index.php"><button type="button" name="button" class="action_button">Go back!</button></a>
    </article>
  </body>
</html>
