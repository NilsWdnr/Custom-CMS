<main class="container py-5">
  <form method="post" enctype="multipart/form-data">
    <label for="title">Titel</label>
    <input type="text" name="title" id="title" maxlength="150" value="<?
      if(isset($input["title"])){
        echo $input["title"];
      }
     ?>">
    <?php if(isset($errors["title"])) { ?>
      <div class="alert alert-danger mt-2" role="alert">
        <?= $errors["title"] ?>
      </div>
    <? } ?>
    <label for="post_image" class="mt-3">Wähle ein Titelbild für den Post (optional)</label>
    <input type="file" name="post_image" id="post_image">
    <label for="content" class="mt-3">Inhalt</label>
    <textarea name="content" id="content" cols="30" rows="10" maxlength="999"><?
      if(isset($input["content"])){
        echo $input["content"];
      }
     ?></textarea>
    <?php if(isset($errors["content"])) { ?>
      <div class="alert alert-danger mt-2" role="alert">
        <?= $errors["content"] ?>
      </div>
    <? } ?>
    <input type="submit" name="submit" id="submit" value="Veröffentlichen" class="mt-3">

  </form>
</main>