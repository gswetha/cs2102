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
                <a class="list-group-item">Top 10 Songs</a>
                <a href="../albumcontroller/searchMostPopular" class="list-group-item">Top 10 Albums</a>
                <a href="../singercontroller/searchMostPopular" class="list-group-item">Top 10 Singers</a>
                <!-- <a href="../home/top100" class="list-group-item">Top 100 of all Time</a> -->
              </div>
            </div>

          </div>
      </div>

      

      <div class="col-xs-3" style="margin-top:20px; margin-left:880px;">

      <form method="post" action="../songcontroller/search">  
        <div style="font-size:18px;"><select name="search_option" id="search_option">
          <option>Search By..</option>
          <option>Song Title</option>
          <option>Singer</option>
          <option>Year</option>
          <option>Composer</option>
          <option>Genre</option>
          <option>Price</option>
          <option>Album</option>
        </select></div>
        <div class="input-group">
         <input type="text" class="form-control" name="search_term" id="search_term" placeholder="Search..">
            <span class="input-group-btn">
              <button class="btn btn-default" name="search_submit" id="search_submit" value="Submit" type="submit">Go!</button>
            </span>
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </form>

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="row">
        <?php if(count($songs_list)) {  } ?>
        <?php 
          if(count($songs_list)){
             $rank = 1;
            foreach ($songs_list as $key => $value) {
             //var_dump($value);
              echo '<div class="col-xs-6 col-md-3 style="height:320px; overflow:hidden;">';
              $data_target = "#songinfo_".$key;
              echo '<a href="#" data-toggle="modal" data-target="'.$data_target.'" class="thumbnail">';
              //echo '<img data-src="holder.js/200x180">';
              echo '<img src= '.$value['songImg'].' width="150" height="150" >';
              echo '<p>';
              echo '<b>Popularity: '.$rank.'  '.$value['songTitle']." - $".$value['songPrice'].'</b>';
              echo '</p>';
              echo '</div>';
              $rank = $rank + 1;
            }
          } else { ?>
            <p><b>Sorry, we did not find any matches for your search :(</b></p>
        <?php } ?>
      
          <div class="col-xs-6 col-md-3" style="display: none;">
            <a href="#" data-toggle="modal" data-target="#songinfo" class="thumbnail">
              <img data-src="holder.js/200x180">
            </a>
          </div> 
        </div>
      </div>
      
      <?php   if(count($songs_list)){
        foreach ($songs_list as $key => $value) {
        $id = "songinfo_".$key; 
      ?>
        <div id=<?php echo $id; ?> class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $value['songTitle']; ?></h4>
              </div>
              <div class="modal-body">
                <p><img src="<?php echo $value['songImg']; ?>" align="middle"></p>
                <p>Album: <?php echo $value['sAlbumTitle']; ?> ( released <?php echo $value['sAlbumYear']; ?>)</p>
                <p>Genre: <?php echo $value['songGenre']; ?></p>
                <p>Length: <?php echo $value['songLength']; ?></p>
              </div>
              <div class="modal-footer">
                <form method="post" action="../purchasescontroller/purchaseSong">
                  <input type="hidden" name="songTitle" value="<?php echo $value['songTitle']; ?>">
                  <input type="hidden" name="songYear" value=<?php echo $value['songYear'];  ?>>
                  <input type="hidden" name="sAlbumTitle" value="<?php echo $value['sAlbumTitle'];  ?>">
                  <input type="hidden" name="sAlbumYear" value=<?php echo $value['sAlbumYear'];  ?>>
                  <input type="hidden" name="amountPaid" value=<?php echo $value['songPrice'];  ?>>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <?php if($logged_in) { ?>
                      <input type="hidden" name="userEmail" value=<?php echo $email;  ?>>
                      <button type="submit" class="btn btn-primary" name="buy_song" id="buy_song" value="buy_song">Buy for $<?php echo number_format($value['songPrice'],2); ?></button>
                  <?php } else { ?>
                      <button type="submit" class="btn btn-primary disabled">Login to purchase for $<?php echo number_format($value['songPrice'],2); ?></button>
                  <?php } ?>  
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      <?php } ?>  
       <?php } ?>

</body>
</html>
