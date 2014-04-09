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
                <a href="../home/songmenu" class="list-group-item">All Songs</a>
                <a href="../home/albummenu"class="list-group-item">All Albums</a>
                <a class="list-group-item">All Singers</a>
                <a href="../home/composermenu" class="list-group-item">All Composers</a>
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
                    log_message('info', 'singer_list in view is '.print_r($images,true));
                    if(count($images)){
                          foreach ($images as $key => $value) {
                            echo '<div class="col-xs-6 col-md-3">';
                              echo '<a href="#" data-toggle="modal" data-target="#singerinfo" data-id="test123" class="thumbnail">';
                                echo '<img src="'; echo $value['singerImg']; echo'width="180" height="180">';
                             echo '</a>';
                            echo '</div>';
                          }
                      }
                  ?>
                </tbody> 
        </div>
      </div>

      <div id="singerinfo" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Singer Title Goes Here!</h4>
            </div>
            <div class="modal-body">
              <div style="float:left;">
              <p><img data-src="holder.js/200x180" align="middle"></p></div>
              <div style="margin-left:210px;"><p>Singer description goes here.</p>
              </div>
            </div>
            <div>
          <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th><a style="text-decoration:none">No.</a></th>
                <th><a style="text-decoration:none">Album</a></th>
                <th><a style="text-decoration:none">Year</a></th>
            </thead>
            <tbody>
              <tr>
                
                <td>1</td>
                <td><a style="text-decoration:none; color:#000066;" href="../home/singlealbumview">Album 1</a></td>
                <td>1997</td>
              </tr>
              <tr>
                
                <td>1</td>
                <td><a style="text-decoration:none; color:#000066;" href="../home/singlealbumview">Album 1</a></td>
                <td>1997</td>
              </tr>
              <tr>
                
                <td>1</td>
                <td><a style="text-decoration:none; color:#000066;" href="../home/singlealbumview">Album 1</a></td>
                <td>1997</td>
              </tr>
              <tr>
                
                <td>1</td>
                <td><a style="text-decoration:none; color:#000066;" href="../home/singlealbumview">Album 1</a></td>
                <td>1997</td>
              </tr>
            </tbody>
          </table>
            </div>
            <div class="modal-footer" style="margin-top:30px;">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


      
</body>
</html>