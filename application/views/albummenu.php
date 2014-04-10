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
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../home">Welcome, Guest!</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Login</a></li>
          <li><a href="#">Sign up</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Catalogue
                  </a>
                  </h4>
              </div>
              <div class="list-group">
                <a href="./songController" class="list-group-item">All Songs</a>
                <a class="list-group-item">All Albums</a>
                <a href="./singerController" class="list-group-item">All Singers</a>
                <a href="./composerController" class="list-group-item">All Composers</a>
                <a href="../home/genremenu" class="list-group-item">All Genres</a>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    Most Popular
                  </a>
                  </h4>
              </div>
              <div class="list-group">
                <a href="../home/top10songs" class="list-group-item">Top 10 Songs</a>
                <a href="../home/top10albums" class="list-group-item">Top 10 Albums</a>
                <a href="../home/top10singers" class="list-group-item">Top 10 Singers</a>
                <a href="../home/top100" class="list-group-item">Top 100 of all Time</a>
              </div>
            </div>

          </div>
      </div>

     <form action="./albumController/searchInAlbum" method="post">
      <div class="col-xs-3" style="margin-top:20px; margin-left:880px;">
          <div style="font-size:18px;">
            <select id="searchOptions" name="searchOptions">
              <option>Search By..</option>
              <option>Album Title</option>
              <option>Song Title</option>
              <option>Artist</option>
              <option>Year</option>
              <option>Composer</option>
              <option>Genre</option>
              <option>Price</option>
            </select>
          </div>
        
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search..." name="searchInput">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit" name="searchSubmit" id="searchSubmit" value="submit">Go!</button>
            </span>
          </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
      </form>

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="row">
                
                  <?php
            
                    // log_message('info', 'album_list in view is '.print_r($albumList,true));
                    if(count($albumList)){
                          foreach ($albumList as $key => $value) {
                            echo '<div class="col-xs-6 col-md-3" style="height: 320px; overflow: hidden;">';
                            $data_target = "#albuminfo_".$key;
                              echo '<a href="#" data-toggle="modal" data-target="'.$data_target.'" class="thumbnail">';
                              echo '<img src="'.$value['albumImg'].' width="250" height="250"> </a>';                                
                              echo '<p>';
                              echo '<b>'.$value['albumTitle']." - $".$value['albumPrice'].'</b>';
                              echo '</p>';
                              echo '</div>';
                          }
                      }else{
                        echo '<p><b>Sorry, we did not find any matches for your search :(</b></p>';
                      }
                  ?>
               
        </div>
      </div>
      <?php 
      if(count($albumList)){
        foreach ($albumList as $key => $value) {
          $id = "albuminfo_".$key; 
      ?>
        <div id=<?php echo $id; ?> class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $value['albumTitle']; ?></h4>
              </div>
              <div class="modal-body">
                <p><img src="<?php echo $value['albumImg']; ?>" align="middle"></p>
                <p>Release Date: <?php echo $value['albumYear']?></p>
                <p>Number of Songs: <?php echo $value['numSongs']?></p>
                <p>Genre: <?php echo $value['albumGenre']?></p>
              </div>
    
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th><a style="text-decoration:none">No.</a></th>
                      <th><a style="text-decoration:none">Song Name</a></th>
                      <th><a style="text-decoration:none">Length</a></th>
                  </thead>
                  <tbody>
                      <?php 
                        if(count($albumSongs)){
                          $counter = 1;
                          foreach($albumSongs as $stepper => $result){
                                  $albumTitle = $value['albumTitle'];
                            $albumYear = $value['albumYear'];
                            if($result['sAlbumTitle'] == $albumTitle && $result['sAlbumYear'] == $albumYear ){
                              echo '<tr>';
                              echo '<td>'.$counter.'.</td>';
                              echo '<td>'.$result['songTitle'].'</td>';
                              echo ' <td>'.$result['songLength'].'</td></tr>';
                              $counter = $counter + 1;
                            }
                          }
                        }
                      ?> 
                  </tbody>
                </table>
            </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="buy_song" id="buy_song">$<?php echo number_format($value['albumPrice'],2); ?></button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      <?php }} ?> 


</body>
</html>