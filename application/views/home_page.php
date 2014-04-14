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
        <a class="navbar-brand" href="#">Welcome, <?php echo $username; ?>!</a>
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
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="./adminEditController">My Profile</a></li>
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
                <a href="./songcontroller" class="list-group-item">All Songs</a>
                <a href="./albumcontroller" class="list-group-item">All Albums</a>
                <a href="./singercontroller" class="list-group-item">All Singers</a>
                <a href="./composercontroller" class="list-group-item">All Composers</a>
                <a href="./home/genremenu" class="list-group-item">All Genres</a>
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
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">What's Trending</h1>

        <div class="row placeholders">

        <!-- Carousel
        ================================================== -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
          </ol>
          <div class="carousel-inner">
            <div class="item active">
              <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide">
              <div class="container">
                <div class="carousel-caption">
                  <h1>Today's Hits</h1>
                  <div class="col-xs-6 col-sm-3 placeholder">
                    <img data-src="http://media1.santabanta.com/full1/Global%20Celebrities(M)/Justin%20Bieber/justin-bieber-5a.jpg" class="img-responsive" alt="Generic placeholder thumbnail">
                    <h4>Baby</h4>
                    <span class="text-muted">Justin Bieber</span>
                  </div>
                  <div class="col-xs-6 col-sm-3 placeholder">
                    <img data-src="http://static4.businessinsider.com/image/5293ca546da811be22e01e27/miley-cyrus-may-be-starring-in-a-very-expensive-super-bowl-commercial-for-pistachios.jpg" class="img-responsive" alt="Generic placeholder thumbnail">
                    <h4>The Climb</h4>
                    <span class="text-muted">Miley Cyrus</span>
                  </div>
                  <div class="col-xs-6 col-sm-3 placeholder">
                    <img data-src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTARqNL9rPBA1AgLOM0lGCTwHvuxrDm0cj8XyoTlbZRC71UTiOk" class="img-responsive" alt="Generic placeholder thumbnail">
                    <h4>Call Me Maybe</h4>
                    <span class="text-muted">Carly Rae Jepsen</span>
                  </div>
                  <div class="col-xs-6 col-sm-3 placeholder">
                    <img data-src="http://media.salon.com/2012/09/myspace-comeback.jpeg-e1357838843694-1280x960.jpg" class="img-responsive" alt="Generic placeholder thumbnail">
                    <h4>My Love</h4>
                    <span class="text-muted">Justin Timberlake</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="container">
                <div class="carousel-caption">
                  <h1>One more for good measure.</h1>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                </div>
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div><!-- /.carousel -->
        </div>

        

        <h2 class="sub-header">Music Catalogue</h2>


        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th><a style="text-decoration:none">Song</a></th>
                <th><a style="text-decoration:none">Artist</a></th>
                <th><a style="text-decoration:none">Album</a></th>
                <th><a style="text-decoration:none">Genre</a></th>
                <th><a style="text-decoration:none">Year</a></th>
                <th><a style="text-decoration:none">Price</a></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Let It Go</a></td>
                <td>Edina Menzel</td>
                <td>Frozen OST</td>
                <td>Pop</td>
                <td>2014</td>
                <td><button>$1.50</button></td>
              </tr>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Do You Wanna Build a Snowman?</a></td>
                <td>Kirsten Bell</td>
                <td>Never Again</td>
                <td>Pop</td>
                <td>2014</td>
                <td><button>$0.99</button></td>
              </tr>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">All Of Me</a></td>
                <td>John Legend</td>
                <td>Love in the Future</td>
                <td>Pop</td>
                <td>2013</td>
                <td><button>$0.99</button></td>
              </tr>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Love is An Open Door</a></td>
                <td>Kristen Bell</td>
                <td>Frozen OST</td>
                <td>Pop</td>
                <td>2013</td>
                <td><button>$1.19</button></td>
              </tr>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Dark Horse</a></td>
                <td>Katy Perry</td>
                <td>Prism</td>
                <td>Pop</td>
                <td>2013</td>
                <td><button>$0.79</button></td>
              </tr>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Happy</a></td>
                <td>Pharrel Williams</td>
                <td>Despicable Me 2: OST</td>
                <td>Pop</td>
                <td>2013</td>
                <td><button>$0.79</button></td>
              </tr>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">A Thousand Years</a></td>
                <td>Christina Perri</td>
                <td>Twilight</td>
                <td>Pop</td>
                <td>2011</td>
                <td><button>$0.50</button></td>
              </tr>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Wake Me Up!</a></td>
                <td>Avicii</td>
                <td>True</td>
                <td>Electonics</td>
                <td>2013</td>
                <td><button>$0.99</button></td>
              </tr>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Counting Stars</a></td>
                <td>One Republic</td>
                <td>Native</td>
                <td>Pop</td>
                <td>2013</td>
                <td><button>$1.29</button></td>
              </tr>
              <tr>
                <td><a href="" style="text-decoration:none; color:black;" data-toggle="modal" data-target="#songinfo">Roar</a></td>
                <td>Katy Perry</td>
                <td>Prism</td>
                <td>Pop</td>
                <td>2013</td>
                <td><button>$1.09</button></td>
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
                  <button type="button" class="btn btn-primary">$1.99</button>
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
