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
         <?php if(isset($username)) { ?>
              <a class="navbar-brand" href="./home">Welcome, <?php echo $username; ?>!</a>
          <?php } else { ?>
              <a class="navbar-brand" href="./home">Welcome, Guest!</a>
          <?php } ?>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
         <?php if(!$logged_in){ ?>
            <li><a href=<?php echo $this->config->item('base_url')."userController/login"?> >Login</a></li>
            <li><a href=<?php echo $this->config->item('base_url')."userController/signup"?>>Sign up</a></li>
          <?php } ?>
          <?php if($logged_in){ ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" role="button" id="drop1" data-toggle="dropdown">
                  My Account
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="./home/admin_edit">My Profile</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="./home/purchases">My Purchases</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo $this->config->item('base_url')."userController/logout"?>>Logout</a></li>
                </ul>
            </li>
          <?php } ?> 
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
                <a href="../songController" class="list-group-item">All Songs</a>
                <a href="../albumController" class="list-group-item">All Albums</a>
                <a href="../singerController" class="list-group-item">All Singers</a>
                <a href="../composerController" class="list-group-item">All Composers</a>
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
                <a href="../songController/searchMostPopularSongs" class="list-group-item">Top 10 Songs</a>
                <a href="../albumController/searchMostPopular" class="list-group-item">Top 10 Albums</a>
                <a href="../singerController/searchMostPopular" class="list-group-item">Top 10 Singers</a>
                <a href="../home/top100" class="list-group-item">Top 100 of all Time</a>
              </div>
            </div>
          </div>
      </div>

      <div class="col-xs-3" style="margin-top:20px; margin-left:880px;">

      <form method="post" action="../composerController/search">  
        <div style="font-size:18px;">
          <select name="search_option" id="search_option">
            <option>Search By..</option>
            <option>Composer Name</option>
            <option>Composer Birthday</option>
            <option>Song</option>
            <option>Album</option>
            <option>Genre</option>
          </select>
        </div>
          <div class="input-group">
            <input type="text" class="form-control" name="search_term" id="search_term" placeholder="Search...">
            <span class="input-group-btn">
              <button class="btn btn-default" name="search_submit" id="search_submit" value="Submit" type="submit">Go!</button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </form>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th><a style="text-decoration:none">No.</a></th>
                <th><a style="text-decoration:none">First Name</a></th> 
                <th><a style="text-decoration:none">Last Name</a></th> 
                <th><a style="text-decoration:none">Birthday</a></th> 
                <th><a style="text-decoration:none">Description</a></th> 
              </tr>
            </thead>
            <tbody>
              <?php 
                  log_message('info', 'composers_list in view is '.print_r($composers_list,true));
                   if(count($composers_list)){
                    foreach ($composers_list as $key => $value) {
                      echo '<tr>';
                      echo '<td>'; echo ($key+1); echo '</td>';
                      echo '<td>'; echo $value['composerFirstName']; echo '</td>';
                      echo '<td>'; echo $value['composerLastName']; echo '</td>';
                      echo '<td>'; echo $value['composerBirthday']; echo '</td>';
                      echo '<td>'; echo $value['composerDescrip']; echo '</td>';
                      echo '</tr>';
                    }
                  }
              ?>
              
            </tbody>
          </table>
        </div
</body>
</html>
