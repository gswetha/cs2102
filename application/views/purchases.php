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
                 <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo $this->config->item('base_url')."userController/logout"?>>Logout</a></li>
                  
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

        <h2 class="sub-header">Purchased Songs</h2>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <?php if($role == "admin") { ?>
                <tr>
                  <th><a style="text-decoration:none">Purchase Type</a></th>
                  <th><a style="text-decoration:none">Transaction ID</a></th>
                  <th><a style="text-decoration:none">Album Title</a></th>
                  <th><a style="text-decoration:none">Album Year</a></th>
                  <th><a style="text-decoration:none">Song Title</a></th>
                  <th><a style="text-decoration:none">Song Year</a></th>
                  <th><a style="text-decoration:none">User Email</a></th>
                  <th><a style="text-decoration:none">Username</a></th>
                  <th><a style="text-decoration:none">Transaction Date</a></th>
                  <th><a style="text-decoration:none">Amount Paid</a></th>
                </tr>
              <?php } else { ?>
                <tr>
                 <th><a style="text-decoration:none">Purchase Type</a></th>
                  <th><a style="text-decoration:none">Transaction ID</a></th>
                  <th><a style="text-decoration:none">Album Title</a></th>
                  <th><a style="text-decoration:none">Album Year</a></th>
                  <th><a style="text-decoration:none">Song Title</a></th>
                  <th><a style="text-decoration:none">Song Year</a></th>
                  <th><a style="text-decoration:none">Transaction Date</a></th>
                  <th><a style="text-decoration:none">Amount Paid</a></th>
                </tr>
              <?php } ?>
            </thead>
            <tbody>
              <?php if($role == "admin") { ?>
                <?php foreach ($result['album'] as $key => $value) { ?>
                  <tr>
                    <td><?php echo $value['purchaseType']; ?></td>
                    <td><?php echo $value['transactionId']; ?></td>
                    <td><?php echo $value['pAlbumTitle']; ?></td>
                    <td><?php echo $value['pAlbumYear']; ?></td>
                    <td> </td>
                    <td> </td>
                    <td><?php echo $value['pEmail']; ?></td>
                    <td><?php echo $value['userName']; ?></td>
                    <td><?php echo $value['transactionDate']; ?></td>
                    <td><?php echo $value['amountPaid']; ?></td>
                  </tr>
                <?php } ?>

                <?php foreach ($result['song'] as $key => $value) { ?>
                  <tr>
                    <td><?php echo $value['purchaseType']; ?></td>
                    <td><?php echo $value['transactionId']; ?></td>
                    <td><?php echo $value['pAlbumTitle']; ?></td>
                    <td><?php echo $value['pAlbumYear']; ?></td>
                    <td><?php echo $value['pSongTitle']; ?></td>
                    <td><?php echo $value['pSongYear']; ?></td>
                    <td><?php echo $value['pEmail']; ?></td>
                    <td><?php echo $value['userName']; ?></td>
                    <td><?php echo $value['transactionDate']; ?></td>
                    <td><?php echo $value['amountPaid']; ?></td>
                  </tr>
                <?php } ?>
             
              <?php } else { ?>
               <?php //var_dump($result); ?>
               <?php foreach ($result as $key => $value) { ?>
                  <tr>
                    <td><?php echo $value['purchaseType']; ?></td>
                    <td><?php echo $value['transactionId']; ?></td>
                    <td><?php echo $value['pAlbumTitle']; ?></td>
                    <td><?php echo $value['pAlbumYear']; ?></td>
                    <?php if($value['purchaseType'] == "song") { ?>
                        <td><?php echo $value['pSongTitle']; ?></td>
                        <td><?php echo $value['pSongYear']; ?></td>
                    <?php } else { ?>
                        <td> </td>
                        <td> </td>
                    <?php } ?>
                    <td><?php echo $value['transactionDate']; ?></td>
                    <td><?php echo $value['amountPaid']; ?></td>
                  </tr>
                <?php } ?>
              <?php } ?>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>