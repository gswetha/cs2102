<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CS2102 - Music Catalogue</title>

  <style type="text/css">
  </style>
</head>

<body>
<div style="padding-left:150px; padding-right:150px;">
  <h2>Add Song</h2>
    <?php if(isset($errors) && count($errors) ) { ?>
          <div class="alert alert-danger">
              <?php foreach ($errors as $key => $value) {
                   echo $value; echo '<br>';
                  }
              ?>
          </div>
        <?php } ?>
<form role="form" method="post" action="../songcontroller/addSong">
        <div class="form-group">
          <label for="Title">Album Title</label>
          <input type="text" class="form-control" id="title" name="sAlbumTitle" placeholder="Enter Title">
        
          <label for="price">Album Year</label>
          <input type="text" class="form-control" id="price" name="sAlbumYear" placeholder="Enter Price">
       
          <label for="Title">Song Title</label>
          <input type="text" class="form-control" id="title" name="songTitle" placeholder="Enter Title">
       
          <label for="price">Song Year</label>
          <input type="text" class="form-control" id="price" name="songYear" placeholder="Enter Price">
        
          <label for="year">Song Price</label>
          <input type="text" class="form-control" id="year" name="songPrice" placeholder="Enter Year">
       
          <label for="genre">Song Image</label>
          <input type="text" class="form-control" id="genre" name="songImg" placeholder="Enter Genre">
       
          <label for="year">Song Genre</label>
          <input type="text" class="form-control" id="length" name="songGenre" placeholder="Enter Length">
       
          <label for="year">Song Length</label>
          <input type="text" class="form-control" id="length" name="songLength" placeholder="Enter Length">
       
          <label for="year">Singer First Name</label>
          <input type="text" class="form-control" id="length" name="singerFirstName" placeholder="Enter Length">
       
          <label for="year">Singer Last Name</label>
          <input type="text" class="form-control" id="length" name="singerLastName" placeholder="Enter Length">
      
          <label for="year">Singer Stage Name</label>
          <input type="text" class="form-control" id="length" name="singerStageName" placeholder="Enter Length">
        
          <label for="year">Composer First Name</label>
          <input type="text" class="form-control" id="length" name="composerFirstName" placeholder="Enter Length">
        
          <label for="year">Composer Last Name</label>
          <input type="text" class="form-control" id="length" name="composerLastName" placeholder="Enter Length">
       
          <label for="year">Composer Birthday</label>
          <input type="text" class="form-control" id="length" name="composerBirthday" placeholder="Enter Length">
        </div>
        
        <button type="submit" name="submit_add_song" id="submit_add_song" class="btn btn-primary" value="Submit">Add this song!</button></div>
        </form>
</body>
</html>
