<h1>Home</h1>

<?php 

foreach($posts as $post){ ?>

<h2><?= $post["title"] ?></h2>

<?php if(!is_null($post["post_image"])){ ?>
  <img src="<?= $post["post_image"] ?>" alt="<?= $post["title"] ?>">
<?php } ?>

<p><?= $post["content"] ?></p>

<?php } ?>