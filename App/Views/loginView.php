<main class="container py-5">
  <h2>Login</h2>
  <form method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <input type="submit" name="submit" value="Login" class="mt-3">
  </form>
</main>

<?php if (isset($loginError)): ?>
  <div class="alert alert-danger mt-1 py-1" role="alert"><?= $loginError ?></div>
<?php endif; ?>