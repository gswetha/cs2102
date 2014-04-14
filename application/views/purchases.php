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
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="../home/admin_edit">My Profile</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1">My Purchases</a></li>
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
          <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" role="button" id="drop2" data-toggle="dropdown">
                Catalogue
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Song</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Album</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Artist</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Composer</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Genre</a></li>
              </ul>
          </li>
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" role="button" id="drop3" data-toggle="dropdown">
                Most Popular
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Song</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Album</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Artist</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Composer</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Genre</a></li>
              </ul>
          </li> -->
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
               <a href="../songcontroller" class="list-group-item">All Songs</a>
                <a href="../albumcontroller" class="list-group-item">All Albums</a>
                <a href="../singercontroller" class="list-group-item">All Singers</a>
                <a href="../composercontroller" class="list-group-item">All Composers</a>
                <!-- <a href="../home/genremenu" class="list-group-item">All Genres</a> -->
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
                <a href="../songController/searchMostPopularSongs" class="list-group-item">Top 10 Songs</a>
                <a href="../albumController/searchMostPopular" class="list-group-item">Top 10 Albums</a>
                <a href="../singerController/searchMostPopular" class="list-group-item">Top 10 Singers</a>
                <!-- <a href="../home/top100" class="list-group-item">Top 100 of all Time</a> -->
              </div>
            </div>

          </div>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <h2 class="sub-header">Already Purchases Songs</h2>

        <div style="font-size:18px;"><select>
          <option>Search By..</option>
          <option>Song</option>
          <option>Album</option>
          <option>Year</option>
          <option>Composer</option>
          <option>Genre</option>
        </select></div>

        <div class="col-m-12" >
          <div class="input-group">
            <input type="text" class="form-control">
          </div>
        </div>


        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th><a style="text-decoration:none">Category</a></th>
                <th><a style="text-decoration:none">Title</a></th>
                <th><a style="text-decoration:none">Artist</a></th>
                <th><a style="text-decoration:none">Purchased Price</a></th>
                <th><a style="text-decoration:none">Purchased Date</a></th>
                <th><a style="text-decoration:none">Order ID</a></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Song</td>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Let It Go</a></td>
                <td>Edina Menzel</td>
                <td>2014</td>
                <td>$1.50</td>
                <td>20/2/2014</td>
              </tr>
              <tr>
                <td>Song</td>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Do You Wanna Build a Snowman?</a></td>
                <td>Kirsten Bell</td>
                <td>2014</td>
                <td>$0.99</td>
                <td>20/2/2014</td>
              </tr>
              <tr>
                <td>Album</td>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Love in the Future</a></td>
                <td>John Legend</td>              
                <td>2013</td>
                <td>$15.99</td>
                <td>18/2/2014</td>
              </tr>
              <tr>
                <td>Song</td>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Love is An Open Door</a></td>
                <td>Kristen Bell</td>
                <td>2013</td>
                <td>$1.19</td>
                <td>15/2/2014</td>
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