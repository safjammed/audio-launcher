  <?php
  include_once 'partials/head.php';

  if (isset($_GET['del'])) {
    try {
      $audio_id = $_GET['del'];
      $thumb = 'assets/images/thumb/'.$_GET['thumb'];
      $audio_file = 'audio/'.$_GET['mp3'];
      $statement = $db->prepare("DELETE FROM audio WHERE audio_id = :audio_id");
      $statement->execute([':audio_id' => $audio_id]);

      if ($statement->rowCount() == 1 ) {
        $console->log((unlink($thumb)==true)? 'Thumb Deleted' : 'Thumb Not Deleted');
        $console->log((unlink($audio_file)==true)? 'Mp3 Deleted' : 'Mp3 Not Deleted');
        swal('Success!', 'The Song was Deleted successfully','success','account.php');

      }
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }
  ?>

      <!-- Page Content -->
      <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron my-4">
          <h1 class="display-3">Audio Launcher</h1>
          <p class="lead">Your Uploaded Audios will show below!</p>
          <?php if(isset($_SESSION['id'])): ?>
          <a href="upload.php" class="btn btn-primary btn-lg">Upload Now</a>
        <?php else: ?>
          <a href="userlogin.php" class="btn btn-primary btn-lg">Get Started</a>
        <?php endif ?>
        </header>

        <!-- Page Features -->
        <div class="row text-center">

         <?php getSongsAccount($db,$_SESSION['id']); ?>       

          

        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->

  <?php
  include_once 'partials/footer.php';
  ?>