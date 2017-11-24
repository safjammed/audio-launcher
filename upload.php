  <?php
  
    # code...
  
 include_once 'partials/head.php';
 if((isset($_SESSION['id']))):
    //If adding reqested
if (isset($_POST['submit'])) { 
 //Check if the fields are empty
  // var_dump($_FILES);
  $form_errors =  check_empty_fields(['title','artist', 'description']);

  if(empty($form_errors)){
    //get  all data from form
    $title =  $_POST['title'];
    $artist =  $_POST['artist'];
    $description = $_POST['description'];    
    $genre_id = $_POST['genre_id'];
    $user_id = $_POST['user_id'];

    //upload
    $target_thumb_dir = "assets/images/thumb/";    
    $target_thumb_name= time() . basename($_FILES["thumb"]["name"]);
    $target_thumb = $target_thumb_dir . $target_thumb_name;  

    $uploadOk = 1;   
   
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["thumb"]["tmp_name"], $target_thumb)) {

          $target_file_dir = "audio/";
          $target_file_name= time() . basename($_FILES["audio_file"]["name"]);
          $target_file = $target_file_dir . $target_file_name;

          if(move_uploaded_file($_FILES["audio_file"]["tmp_name"], $target_file)){
          //Add to database
          try {

            $sql = "INSERT INTO audio (title, artist, description, thumb, file) VALUES(:title, :artist, :description, :thumb,:file)";
            $statement = $db -> prepare($sql);
            $statement-> execute(array(':title' => $title, ':artist' => $artist, ':description' => $description, ':thumb' => $target_thumb_name,':file'=>$target_file_name));
            //Count affected rows
            $affected = $statement -> rowCount();
            if( $affected == 1){
              //add to user audio
              $audio_id = lastInsertAudioId($db,'audio');

              $statement = $db -> prepare("INSERT INTO user_audio (user_id, audio_id) VALUES (:user_id, :audio_id)");
              $statement->execute([':user_id'=>$user_id, ':audio_id'=>$audio_id]);
                $affected = $statement -> rowCount();
                //if successfull then
                if ($affected == 1) {
                  //ADD to audio genre
                  $statement = $db -> prepare("INSERT INTO audio_genre (genre_id,audio_id) VALUES (:genre_id, :audio_id)");
                  $statement->execute([':genre_id'=>$genre_id, ':audio_id'=>$audio_id]);
                    $affected = $statement -> rowCount();
                    if ($affected == 1) {
                      swal('Hurray!','The Audio has been Uploaded Nicely','success');
                    }else{
                      $console->log('problem uploading into audio_genre');
                    }
                }else{
                      $console->log('problem uploading into user_audio');
                    }
            }else{
              $console->log('problem uploading into audio');
            }
          } catch (PDOException $e) {
            echo 'CABINS: '.$e->getMessage();
          }
            // echo "The file ". basename( $_FILES["thumb"]["name"]). " has been uploaded.";

        }else{
          $console->log('Error Uploading audio File');
        }
        } else {
            echo "Sorry, there was an error uploading your Thumbnail file.";
        }
    }

  }else{ //if formerror was found

  }
  }
  

  ?>

      <!-- Page Content -->
      <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron my-4">
          <h1 class="display-3">Upload Files</h1>
          <p class="lead">An Unlimited Audio Sharing Platform. Free for Everyone! Fill Out The Form Below to Upload Your Audio File</p>          
        </header>

        <!-- Page Features -->
        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default">
              
              <div class="panel-body">
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="Titile">Titile:</label>
                    <input type="text" class="form-control" id="Titile" required name="title">
                  </div>
                  <div class="form-group">
                    <label for="Artist">Artist:</label>
                    <input type="text" class="form-control" id="Artist" required name="artist">
                  </div>     
                   <div class="form-group">
                    <label for="thumb">Cover Art (300 x 300px):</label>
                    <input type="file" accept="image/*" class="form-control" id="thumb" accept="" required name="thumb">
                  </div>   
                  <div class="form-group">
                    <label for="mp3">Audio (mp3 only):</label>
                    <input type="file" class="form-control" accept=".mp3" id="mp3" required name="audio_file">
                  </div>       
                  </div>     
                   <div class="form-group">                    
                    <select class="form-control" required name="genre_id">
                      <option value="" selected>SELECT A GENRE</option>
                      <?php printGenreOpt($db); ?>
                    </select>
                  </div>            
                  <div class="form-group">
                    <label for="Description">Description:</label>
                    <textarea rows="10" class="form-control" id="Description" required name="description">Type Short Description Here</textarea>
                  </div>
                  <input type="hidden" name="user_id" value="<?= $_SESSION['id']?>">  
                  <button type="submit" class="btn btn-default" name="submit">Submit</button>
                </form>
              </div>
            </div>

          </div>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->

  <?php
  include_once 'partials/footer.php';
  else:
    header('location:index.php');
  endif
  ?>