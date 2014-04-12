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
        <a class="navbar-brand" href="../home">Back</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          
         
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" role="button" id="drop1" data-toggle="dropdown">
                  My Account
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                  <li role="presentation"><a role="menuitem" tabindex="-1" >My Profile</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="../home/purchases">My Purchases</a></li>
                  <li role="presentation" class="divider"></li>
                  
                </ul>
            </li>
          
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
                <a href="./albumController" class="list-group-item">All Albums</a>
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
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <h2 class="sub-header">Your Dashboard</h2>

        <?php 
          
          $count = count($add);
          if($count > 0){
            echo'<h4>Album with title '.$add[0].' is added successfully</h4>';
          }else{
            echo'<h4>Failed to add album with title '.$add[0].'</h4>';
          }
        ?>


        <div><button type="button" class="btn btn-default" data-toggle="modal" data-target="#addinfo">To Add an Entry, Click Here</button></div>
        </br>
        </br>
        <form action="../adminEditController/searchItem" method="post">
          <div style="font-size:18px;">
          <select name="searchOption">
            <option>Search By..</option>
            <option>Song</option>
            <option>Album</option>
          </select></div>

          <div class="col-m-12" >
            <div class="input-group">
             <input type="text" class="form-control" placeholder="Search..." name="searchInput">
              <span class="input-group-btn">
                 <button class="btn btn-default" type="submit" name="searchSubmit" id="searchSubmit" value="submit">Go!</button>
            </span>
            </div>
          </div>
        </form>

        <div class="table-responsive">
          <table class="table table-striped" input="hidden">
            <thead>
              <tr>
                <th><a style="text-decoration:none">Category</a></th>
                <th><a style="text-decoration:none">Title</a></th>
                <th><a style="text-decoration:none">Artist</a></th>
                <th><a style="text-decoration:none">Album</a></th>
                <th><a style="text-decoration:none">Genre</a></th>
                <th><a style="text-decoration:none">Year</a></th>
                <th><a style="text-decoration:none">Delete/Edit Entry</a></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Let It Go</a></td>
                <td>Edina Menzel</td>
                <td>Frozen OST</td>
                <td>Pop</td>
                <td>2014</td>
                <td><button>Delete</button><a href="../home/add_artist_composer"><button>Edit</button></a></td>
              </tr>
            </tbody>
          </table>

          <div id="songinfo" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Song Title</h4>
                </div>
                <div class="modal-body">
                  <p><img data-src="holder.js/200x180" align="middle"></p>
                  <p>asd dfsdf ew weqwe qwe wef df df dfdas dsad sads ddfdf df df gtr t rt rtrtrt r t sa dasd s dsd asd 
                    dfsdf ew weqwe qwe wef df df dfdas dsad sads ddfdf df df gtr t rt rtrtrt r t asd dfsdf ew weqwe qwe wef df df dfd
                    as dsad sads ddfdf df df gtr t rt rtrtrt r t sa dasd s dsdsa dasd s dsd</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Delete</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <div id="addinfo" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Please Select Category to Edit:</h4>
                </div>
                <div class="modal-body">
                
                </br>
                <button type="button" class="btn btn-default btn-lg btn-block"><a href="./home/add_song_album">Song</a></button>
                <button type="button" class="btn btn-default btn-lg btn-block"><a href="./home/add_album">Album</a></button>
                <button type="button" class="btn btn-default btn-lg btn-block"><a href="./home/add_artist">Artist</a></button>
                <button type="button" class="btn btn-default btn-lg btn-block"><a href="./home/add_artist_composer">Composer</a></button>

                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Confirm Entry</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>
      </div>
    </div>
  </div>
</body>
</html>