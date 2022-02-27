<header id="backendHeader">
  <div class="container-fluid py-2">
    <div class="d-flex align-items-center justify-content-between">
      <h1>CMS</h1>
      <?php if(isset($_SESSION["username"])){ ?>
        <a href="/logout" id="logout">
        logout
        </a>
      <?php } ?> 
    </div>
  </div>
</header>