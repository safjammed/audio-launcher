<?php
include_once 'partials/head.php';

$audio_id = $_GET['id'];
$sql="SELECT * FROM audio,audio_genre, genre, users, user_audio WHERE 
audio.audio_id = audio_genre.audio_id AND
genre.genre_id = audio_genre.genre_id AND
audio.audio_id = user_audio.audio_id AND
users.id = user_audio.user_id AND audio.audio_id = :audio_id
";

$statement = $db->prepare($sql);
$statement->execute(array(':audio_id' => $audio_id));
while ($row =  $statement->fetch()) {
 addView($db,$row['views'], $audio_id);
?>

    <!-- Page Content -->
    <div class="container">

      <!-- Heading Row -->
      <div class="row my-4">
        <div class="col-lg-8 playerWrap" id="playerWrap">
           <div id="title">
            <span id="track"></span>
            
          </div>
          <!-- Controls -->
          <div class="controlsOuter">
            <div class="controlsInner">
              <div id="loading"></div>
              <div class="playerbtn" id="playBtn"></div>
              <div class="playerbtn" id="pauseBtn"></div>
              <div class="playerbtn" id="prevBtn"></div>
              <div class="playerbtn" id="nextBtn"></div>
              <div id="timer">0:00</div>
            <div id="duration">0:00</div>
            </div>
            <div class="playerbtn" id="playlistBtn"></div>
            <div class="playerbtn" id="volumeBtn"></div>
          </div>

          <!-- Progress -->
          <div id="waveform"></div>
          <div id="bar"></div>
          <div id="progress"></div>

          <!-- Playlist -->
          <div id="playlist">
            <div id="list"></div>
          </div>

          <!-- Volume -->
          <div id="volume" class="fadeout">
            <div id="barFull" class="bar"></div>
            <div id="barEmpty" class="bar"></div>
            <div id="sliderBtn"></div>
          </div>
        </div>
        <script type="text/javascript">
          $(function () {
            $('.playerWrap').height($('.takeFromHere').height()+'px');
          });
        </script>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4 takeFromHere">
          <h1><?= $row['title'];?> </h1>
          <h4>by <?= $row['artist']?></h4>
          <p>Published on: <?= $row['upload_time']?><br>
            Genre: <?= $row['genre']?><br>
            Uploaded By: <?= $row['fname']?> <?= $row['lname']?><br>            
          </p>
          <p></p>
          <?php if((isset($_SESSION['id']))): ?>
                     <p><div class="btn-group">
            <button type="button" class="btn blue white-text" ><i class="fa fa-play" aria-hidden="true"></i><span class="badge"><?= $row['views']+1?></span></button>
            <button type="button" class="btn green white-text" id="addLikes" data-userid="<?= $_SESSION['id']?>" data-audioid="<?= $audio_id?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="badge">...</span></button>            
            <button type="button" class="btn red white-text" id="addDislikes" data-userid="<?= $_SESSION['id']?>" data-audioid="<?= $audio_id?>"><i class="fa fa-thumbs-down" aria-hidden="true"></i><span class="badge">...</span></button>
          </div></p>
          

          <p><a download class="btn btn-primary btn-lg" href="./audio/<?= $row['file']?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a></p>


                      <?php else:?>
                        <p><div class="btn-group">
                          <button type="button" class="btn blue white-text"><i class="fa fa-play" aria-hidden="true"></i><span class="badge"><?= $row['views']+1?></span></button>
                          <button id="addLikes" type="button" class="btn green white-text disabled" disabled data-audioid="<?= $audio_id?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="badge"></span></button>            
                          <button id="addDislikes" type="button" class="btn red white-text disabled" disabled data-audioid="<?= $audio_id?>"><i class="fa fa-thumbs-down" aria-hidden="true"></i><span class="badge"></span></button>
                        </div></p>
                        <p><a class="btn btn-primary btn-lg" href="userlogin.php"><i class="fa fa-download" aria-hidden="true"></i> Login to Download</a></p>
                      <?php endif ?>

                      <p><a class="btn facebook-blue white-text btn-lg" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];?>', '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i> Share on facebook</a></p>

          
        </div>
        <!-- /.col-md-4 -->
      </div>
      <!-- /.row -->

      <!-- Call to Action Well -->
      <div class="card text-white bg-secondary my-4 text-center">
        <div class="card-body text-center">
          <h3>About This Audio</h3>
          <hr>
          <div style="width: 10%;float: left;margin-right: 3%;"><img width="100" src="assets/images/thumb/<?=$row['thumb']?>"></div>
          <div style="width: 86%;float: left;vertical-align: middle;text-align: left"><?=$row['description']?></div>          
        </div>
      </div>

      <!-- Content Row -->
      <div class="row text-center"  style="display: block;">
        <hr>
        <h3 class="text-center">Recommended For You</h3>
        <hr>
      </div>
      <div class="row">        
        <?php getSongsHome($db,4)?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
<script type="text/javascript">
<?php include_once 'partials/playerjs_top.php'; ?>
// Setup our new audio player class and pass it the playlist.
var player = new Player([
  {
    title: '<?= $row['title'];?>',
    file: '<?= $row['file'];?>',
    howl: null
  }
]);

<?php include_once 'partials/playerjs_bottom.php'; 

?>
    </script>
<?php
}
include_once 'partials/footer.php';
?>
