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
        <a class="navbar-brand" href="#">Welcome, Guest!</a>
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
                <a href="#" class="list-group-item">All Songs</a>
                <a href="./home/albummenu" class="list-group-item">All Albums</a>
                <a href="./home/singermenu" class="list-group-item">All Singers</a>
                <a href="./home/composermenu" class="list-group-item">All Composers</a>
                <!-- <a href="./home/genremenu" class="list-group-item">All Genres</a> -->
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
                <!-- <a href="../home/top100" class="list-group-item">Top 100 of all Time</a> -->
              </div>
            </div>

          </div>
      </div>
</body>
</html>
