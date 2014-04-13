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
  <h2>Edit Song</h2>
    <?php if(isset($errors) && count($errors) ) { ?>
          <div class="alert alert-danger">
              <?php foreach ($errors as $key => $value) {
                   echo $value; echo '<br>';
                  }
              ?>
          </div>
        <?php } ?>
<form role="form" method="post" action="../songcontroller/updateSong">
        <div class="form-group">
          <label for="Title">Album Title</label>
          <input type="text" class="form-control" id="title" name="sAlbumTitle" placeholder="Enter Title" value="<?php echo $sAlbumTitle ?>" disabled>
          <input type="hidden" class="form-control" id="title" name="sAlbumTitleOriginal" placeholder="Enter Title" value="<?php echo $sAlbumTitle ?>">
        
          <label for="price">Album Year</label>
          <input type="text" class="form-control" id="price" name="sAlbumYear" placeholder="Enter Price" value=<?php echo $sAlbumYear ?> disabled>
          <input type="hidden" class="form-control" id="price" name="sAlbumYearOriginal" placeholder="Enter Price" value=<?php echo $sAlbumYear ?>>
       
          <label for="Title">Song Title</label>
          <input type="text" class="form-control" id="title" name="songTitle" placeholder="Enter Title" value="<?php echo $songTitle ?>">
          <input type="hidden" class="form-control" id="title" name="songTitleOriginal" placeholder="Enter Title" value="<?php echo $songTitle ?>">
       
          <label for="price">Song Year</label>
          <input type="text" class="form-control" id="price" name="songYear" placeholder="Enter Price" value=<?php echo $songYear ?>>
          <input type="hidden" class="form-control" id="price" name="songYearOriginal" placeholder="Enter Price" value=<?php echo $songYear ?>>
        
          <label for="year">Song Price</label>
          <input type="text" class="form-control" id="year" name="songPrice" placeholder="Enter Year" value=<?php echo $songPrice ?>>
       
          <label for="genre">Song Image</label>
          <input type="text" class="form-control" id="genre" name="songImg" placeholder="Enter Genre" value="<?php echo $songImg ?>">
       
          <label for="year">Song Genre</label>
          <input type="text" class="form-control" id="length" name="songGenre" placeholder="Enter Length" value="<?php echo $songGenre ?>">
       
          <label for="year">Song Length</label>
          <input type="text" class="form-control" id="length" name="songLength" placeholder="Enter Length" value=<?php echo $songLength ?>>

        </div>
        
        <button type="submit" name="updateSubmit" id="updateSubmit" class="btn btn-primary" value="Submit">Edit this song!</button></div>
        </form>
</body>
</html>
