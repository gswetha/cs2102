<form action="../albumController/addAlbum" method="post">
    <div style="padding-left:150px; padding-right:150px;">
<!-- <form role="form"> -->
                    <div class="form-group">
                      <label for="Title">Title</label>
                      <input type="title" class="form-control" name="title" placeholder="Enter Title">
                    </div>

                     <div class="form-group">
                      <label for="year">Year</label>
                      <input type="year" class="form-control" name="year" placeholder="Enter Year">
                    </div>


                    <div class="form-group">
                      <label for="noSongs">Number of Songs</label>
                      <input type="noSongs" class="form-control" name="noSongs" placeholder="Enter Number of Songs">
                    </div>



                    <div class="form-group">
                      <label for="genre">Genre</label>
                      <input type="genre" class="form-control" name="genre" placeholder="Enter Genre">
                    </div>


                    <div class="form-group">
                      <label for="price">Price</label>
                      <input type="price" class="form-control" name="price" placeholder="Enter Price">
                    </div>

                    <div class="form-group">     
                      <label for="img">Image URL</label>
                      <input type="img" class="form-control" name="img" placeholder="Enter Image URL">
                    </div>

                    <div class="form-group">     
                      <label for="descrip">Description</label>
                      <input type="descrip" class="form-control" name="descrip" placeholder="Enter Description for Album">
                    </div>
                    
                  <!-- </form> -->
                  <div><button type="submit" name="addSubmit" name="addSubmit" value="submit" class="btn btn-default">Confirm Entry</button></div>

                </div>
</form>

