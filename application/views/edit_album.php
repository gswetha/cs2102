<form action="../albumController/updateAlbum" method="post">
    <div style="padding-left:150px; padding-right:150px;">
<!-- <form role="form"> -->
                    <div class="form-group">
                      <label for="Title">Title</label>
                      <input type="title" class="form-control" name="title" value=<?php echo $albumTitle ?>>
                      <input type="hidden" name="origAlbumTitle" value=<?php echo $albumTitle;?>>
                    </div>

                     <div class="form-group"> 
                      <label for="year">Year</label>
                      <input type="year" class="form-control" name="year" value=<?php echo $albumYear ?>>
                      <input type="hidden" name="origAlbumYear" value=<?php echo $albumYear;?>>
                    </div>


                    <div class="form-group">
                      <label for="noSongs">Number of Songs</label>
                      <input type="noSongs" class="form-control" name="noSongs" value=<?php echo $numSongs ?>>
                    </div>



                    <div class="form-group">
                      <label for="genre">Genre</label>
                      <input type="genre" class="form-control" name="genre" value=<?php echo $albumGenre ?>>
                    </div>


                    <div class="form-group">
                      <label for="price">Price</label>
                      <input type="price" class="form-control" name="price" value=<?php echo $albumPrice ?>>
                    </div>

                    <div class="form-group">     
                      <label for="img">Image URL</label>
                      <input type="img" class="form-control" name="img" value=<?php echo $albumImg ?>>
                    </div>

                    <div class="form-group">     
                      <label for="descrip">Description</label>
                      <input type="descrip" class="form-control" name="descrip" value=<?php echo $albumDescrip ?>>
                    </div>
                    
                  <!-- </form> -->
                  <div><button type="submit" name="updateSubmit" name="updateSubmit" value="submit" class="btn btn-default">Update Entry</button></div>

                </div>
</form>

