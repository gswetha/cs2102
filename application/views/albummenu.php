<!DOCTYPE html>
<html lang="en">
<script src="Scripts/jquery-1.7.1.js" type="text/javascript"></script>
<script src="Scripts/knockout-2.0.0.js" type="text/javascript"></script>
<script src="Scripts/ViewModel.js" type="text/javascript"></script>
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
                <a href="../home/songmenu" class="list-group-item">All Songs</a>
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

      <div class="col-xs-3" style="margin-top:20px; margin-left:880px;">

        <div style="font-size:18px;"><select>
          <option>Search By..</option>
          <option>Song Title</option>
          <option>Artist</option>
          <option>Year</option>
          <option>Composer</option>
          <option>Genre</option>
        </select></div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
          </span>
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="row">
                <tbody>
                  <?php
                    log_message('info', 'album_list in view is '.print_r($albumImg,true));
                    if(count($albumImg)){
                          foreach ($albumImg as $key => $value) {
                            echo '<div class="col-xs-6 col-md-3">';
                              echo '<a href="#" data-toggle="modal" data-target="#albuminfo" class="thumbnail">';
                                echo '<img src="'; echo $value['albumImg']; echo'>';                                
                             echo '</a>';
                             echo $value['albumTitle'];
                            echo $value['albumPrice'];
                            echo '</div>';
                          }
                      }
                  ?>
                </tbody> 
        </div>
      </div>


      <div id="albuminfo" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Album Title Goes Here!</h4> 
              <tbody>
                <?php
                  echo "soomething as a test!";
                ?>
              </tbody>
            </div>
            <div class="modal-body">
              <div style="float:left;">
              <p><img data-src="holder.js/200x180" align="middle"></p></div>
              <div style="margin-left:210px;"><p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta 
              	gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              </div>
            </div>
            <div>
            	<div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th><a style="text-decoration:none">No.</a></th>
                      <th><a style="text-decoration:none">Song Name</a></th>
                  </thead>
                  <tbody>
                    <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                    <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                    <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                    <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                    <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                   <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                    <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                    <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                    <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                    <tr>
                      
                      <td>1</td>
                      <td>Song 1</td>
                      
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="modal-footer" style="margin-top:30px;">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">$20.99</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


</body>
</html>