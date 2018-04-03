<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
<!--     <link rel="stylesheet" href="<?=base_url();?>assets/css/styles1.css"> -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/Navbar-with-mega-menu.css">
    <style type="text/css">
    .navbar{
      box-shadow: 1px 1px 15px -2px rgba(0,0,0,0.75);
      background-color:white;
    }
.nav li a{
color: black;
font-weight: bold;
}
.nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
background-color: white;
}
.nav>li>a:focus, .nav>li>a:hover {
background-color: white;
color: #E72A2A;
}
ul.dropdown-menu{
  background: white;
}
ul.dropdown-menu li a:hover{
  color: #E72A2A;
}
.logo{
  width:150px;
}

.navbar-brand{
  padding:0;
}

.navbar{
  padding:15px 0 15px 15px;
}

.search-img{
  text-align:right;
}

input.input-search{
  height:35px;
  width:300px;
}

.btn-search{
  height:35px;
  border-radius:0;
  margin-top:-2px;
}

div.box{
  position:relative;
  width:100%;
  height:240px;
  overflow:hidden;
}

div.box{
  position:relative;
  width:100%;
  height: auto;
  max-height:240px;
  overflow:hidden;
  cursor:pointer;
     border-radius: 5px;
}

.filter-img{
  padding:15px;
}

div.sub-box{
  top:0;
/*  position:absolute;*/
  left:0;
}

img.image-gallery{
  -webkit-transition:0.4s ease;
  transition:0.4s ease;
  width:380px;

}

div.box:hover img.image-gallery{
  -webkit-transform:scale(2);
  transform:scale(2);

}
.box .thumbnail{
  padding: 0;
  border-radius: 5px;
}
.box .thumbnail:hover{
border-color: white !important;
}
.filter-image{
  position: absolute;
  height: 100%;
  width: 100%;
  background-color: black;
  display: none;
   transition:0.4s ease;
}
div.box:hover .filter-image{
display: block;
opacity: 0.5;
    -webkit-transform:scale(2);
  transform:scale(2);
  z-index: 1;

}
.modal img.image-gallery{
  margin: 0;
  width: 100%;
}
.video-up{
  -webkit-transition:0.4s ease;
  transition:0.4s ease;
  width: 360px;
  height: 300px;
}
.modal iframe{
  margin: 0;
width: 100%;
height: 320px;
}
.modal .modal-content .close{
font-size: 50px;margin-right: 15px;margin-bottom: -48px;color: white; opacity: 0.7;
}
.modal .modal-content .close:hover{
  opacity: 0.9 !important;
  color: white;
}
.date-upload{
  font-weight:bold;
}
.filter-image .glyphicon-zoom-in{
  font-size: 26px;
  left: 50%;
  top: 48%;
  position: absolute;
  z-index: 5;
  margin-left: -12px;
  color: white;
  transition: 0.6s;
}
.filter-image .glyphicon-zoom-in:hover{
  color: #D51B1B;
}

.none-padding{
  padding:0;
}

.author{
}

h5.text-date{
  color:black;
  transition:0.5s;
}



    </style>
</head>

<body>
    <nav class="navbar navbar-fixed-top" id="main-navigation">
    <div class="container-fluid">
        <div class="navbar-header"><a href="index.html" class="navbar-brand navbar-link"><img class="logo" src="<?=base_url();?>assets/images/logo/IDREN-2.png" /> </a>
            <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav hidden-xs hidden-sm navbar-left">
                <li role="presentation" class="active"><a href="#" data-change="boxed" data-toggle="tooltip" data-placement="bottom" title="Toggle boxed version"><i class="fa fa-arrows-alt"></i></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li role="presentation" class="active"><a href="<?php echo site_url('web/home') ?>">Home</a></li>
                <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Galery <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo site_url('web/galery') ?>">foto</a></li>
                        <li><a href="<?php echo site_url('web/galery/video') ?>">Video</a></li>

                    </ul>
                  </li>
                <li role="presentation" class=""><a href="practice-areas.html">News</a></li>

                <li role="presentation" class="active"><a href="practice-areas.html">Keanggotaan</a></li>

            </ul>
        </div>
    </div>
</nav>

          <ci:doc type="modules"/>


    <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>assets/js/modal-custom.js"></script>

</body>

</html>