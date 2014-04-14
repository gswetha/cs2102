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
                <a href="./songController" class="list-group-item">All Songs</a>
                <a href="./albumController"class="list-group-item">All Albums</a>
                <a class="list-group-item">All Singers</a>
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
                <a href="./songController/searchMostPopularSongs" class="list-group-item">Top 10 Songs</a>
                <a href="./albumController/searchMostPopular" class="list-group-item">Top 10 Albums</a>
                <a href="./singerController/searchMostPopular" class="list-group-item">Top 10 Singers</a>
                <a href="../home/top100" class="list-group-item">Top 100 of all Time</a>
              </div>
            </div>

          </div>
      </div>
      <form method="post" action="./singerController/searchInSinger" >
       <div class="col-xs-3" style="margin-top:20px; margin-left:880px;">
          <div style="font-size:18px;">
          <select name="searchOptions" id="searchOptions">
            <option>Search By..</option>
            <option>Album Title</option>
            <option>Album Release Date</option>
            <option>Song Title</option>
            <option>Artist Name</option>
            <option>Birthday</option>
            <option>Genre</option>
          </select></div>

          <div class="input-group">
            <input type="text" class="form-control" name="searchInput" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-default" name="searchSubmit" id="searchSubmit" value="submit" >Go!</button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </form>

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
         <div class="row">
           <?php if(count($allSingers)) {  } ?>
                  <?php
                    log_message('info', 'singer_list in view is '.print_r($allSingers,true));
                    if(count($allSingers)){
                          foreach ($allSingers as $key => $value) {
                            $data_target = "#singerinfo_".$key;
                            echo '<div class="col-xs-6 col-md-3" style="height: 320px; overflow: hidden;">';
                              echo '<a href="#" data-toggle="modal" data-target="'.$data_target.'" class="thumbnail">';
                                echo '<img src="'.$value['singerImg'].'" width="200" height="200">';
                             echo '</a>';
                             echo '<p><b>'.$value['stageName'].'</b></p>';
                            echo '</div>';
                          }
                      }else{
                        echo '<p><b>Sorry, we did not find any matches for your search :(</b></p>';
                      }
                  ?>
             
        </div>
      </div>

      <?php foreach ($allSingers as $key => $value) {
        $id = "singerinfo_".$key; 
      ?>
        <div id=<?php echo $id; ?> class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $value['stageName']; ?></h4>
              </div>
              <div class="modal-body">
                <p><img src="<?php echo $value['singerImg']; ?>" align="middle"></p>
                
                <div>
                  <p><?php echo $value['singerDescrip']; ?></p>
                </div>
                <p>First Name: <?php echo $value['singerFirstName']; ?></p>
                <p>Last Name: <?php echo $value['singerLastName']; ?></p>
                <p>Birthday: <?php echo $value['singerBirthday']; ?></p>
              </div>

          <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th><a style="text-decoration:none">No.</a></th>
                <th><a style="text-decoration:none">Album</a></th>
                <th><a style="text-decoration:none">Year</a></th>
            </thead>
            <tbody>
                <?php 
                  if(count($allSingerSongs)){
                    $counter = 1;
                    foreach($allSingerSongs as $stepper => $result){
                      $firstName = $value['singerFirstName'];
                      $lastName = $value['singerLastName'];
                      $stageName = $value['stageName'];
                      if($result['sssSingerFirstName'] == $firstName && $result['sssSingerLastName'] == $lastName && $result['sssSingerStageName'] = $stageName){
                        echo '<tr>';
                        echo '<td>'.$counter.'.</td>';
                        echo '<td><a style="text-decoration:none; color:#000066;" href="./singlealbumview">'.$result['sssAlbumTitle'].'</a></td>';
                        echo ' <td>'.$result['sssAlbumYear'].'</td></tr>';
                        $counter = $counter + 1;
                      }
                    }
                  }
                ?>  
            </tbody>
          </table>
            </div>
              <div class="modal-footer">
                <form method="post"> <!-- later add in action="/purchasecontroller/buysong" -->
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      <?php } ?>  


      
</body>
</html>