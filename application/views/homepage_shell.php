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
        <a class="navbar-brand" href=<?php echo $this->config->item('base_url')."home"?>>Welcome, <?php echo $username; ?>!</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <?php if(!$logged_in){ ?>
            <li><a href=<?php echo $this->config->item('base_url')."userController/login"?> >Login</a></li>
            <li><a href=<?php echo $this->config->item('base_url')."userController/signup"?>>Sign up</a></li>
          <?php } ?>
          <li><a href=<?php echo $this->config->item('base_url')."userController/feedback"?>>Leave us a feedback!</a></li>
          <?php if($logged_in){ ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" role="button" id="drop1" data-toggle="dropdown">
                  My Account
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">My Profile</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">My Purchases</a></li>
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
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul role="menu" aria-labelledby="drop3">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Song</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Album</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Artist</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Composer</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Genre</a></li>
                  </ul>
                </div>
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
              <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul role="menu" aria-labelledby="drop3">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Song</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Album</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Artist</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Composer</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Genre</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </ul>
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
                    <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
                    <h4>Baby</h4>
                    <span class="text-muted">Justin Bieber</span>
                  </div>
                  <div class="col-xs-6 col-sm-3 placeholder">
                    <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
                    <h4>The Climb</h4>
                    <span class="text-muted">Miley Cyrus</span>
                  </div>
                  <div class="col-xs-6 col-sm-3 placeholder">
                    <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
                    <h4>Call Me Maybe</h4>
                    <span class="text-muted">Carly Rae Jepsen</span>
                  </div>
                  <div class="col-xs-6 col-sm-3 placeholder">
                    <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
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
                  <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                </div>
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div><!-- /.carousel -->
        </div>

         <!-- START WITH A <DIV> YOUR STUFF HERE!!!!!!-->
        <!-- ADD YOUR STUFF HERE!!!!!!-->
         <!-- ADD YOUR STUFF HERE!!!!!!-->
          <!-- ADD YOUR STUFF HERE!!!!!!-->
           <!-- ADD YOUR STUFF HERE!!!!!!-->
            <!-- ADD YOUR STUFF HERE!!!!!!-->
             <!-- ADD YOUR STUFF HERE!!!!!!-->
              <!-- ADD YOUR STUFF HERE!!!!!!-->
               <!-- ADD YOUR STUFF HERE!!!!!!-->
                <!-- ADD YOUR STUFF HERE!!!!!!-->
                 <!-- ADD YOUR STUFF HERE!!!!!!-->
                 <!-- END WITH A <\DIV> YOUR STUFF HERE!!!!!!-->

      </div>

</body>