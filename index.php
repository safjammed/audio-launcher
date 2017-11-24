  <?php
  include_once 'partials/head.php';
  ?>

      <!-- Page Content -->
      <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron my-4">
          <h1 class="display-3">Audio Launcher</h1>
          <p class="lead">An Unlimited Audio Sharing Platform. Free for Everyone!</p>
          <?php if(isset($_SESSION['id'])): ?>
          <a href="upload.php" class="btn btn-primary btn-lg">Upload Now</a>
        <?php else: ?>
          <a href="userlogin.php" class="btn btn-primary btn-lg">Get Started</a>
        <?php endif ?>
        </header>

        <!-- Page Features -->
        <div class="row text-center">

         <?php getSongsHome($db); ?>       

          

        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->

  <?php
  include_once 'partials/footer.php';
  ?>