<div class="container py-5">
  <h2>Dashboard</h2>
  <h3 class="mt-5">Posts</h3>
  <a href="/post/create"><button class="btn btn-primary">Post erstellen</button><a>


  <table id="postsTabel" class="mt-3">
  <?php foreach($posts as $post){ ?>

      <tr>
        <td><?= $post["title"] ?></td>
        <td><?= $post["created"] ?></td>
        <td><a href="/post/edit/<?= $post["id"] ?>">bearbeiten</a></td>
        <td><a href="/post/delete/<?= $post["id"] ?>">löschen</a></td>
      </tr>

  <? } ?>
  </table>

</div>
