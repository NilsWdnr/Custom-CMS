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
    <?php if(!is_null($input["post_image"])) { ?>
    <label for="post_image" class="mt-3">Ändere das Titelbild für den Post (altes Bild wird überschrieben)</label>
    <?php } else { ?>
    <label for="post_image" class="mt-3">Wähle ein Titelbild für den Post (optional)</label>
    <?php } ?>
    <input type="file" name="post_image" id="post_image">
    <?php if(!is_null($input["post_image"])) { ?>
    <label for="post_image" class="mt-3">Oder entferne des Titelbild</label>
    <input class="d-inline" type="checkbox" name="remove_post_image" id="remove_post_image">
    <?php } ?>
    <label for="content" class="mt-3 d-block">Inhalt</label>
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