<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>w1</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/css/Navbar-with-mega-menu.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/css/gallery-3-columns-minimal.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/bootstrap/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/css/css.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/css/admin-user.css">
</head>

<body>
           <nav class="navbar navbar-fixed-top " id="main-navigation">
      <div class="">
            <div class="container-fluid">
              <div class="navbar-header"><a href="index.html" class="navbar-brand navbar-link"><img class="logo" src="<?=base_url();?>assets/user/img/IDREN-2.png" /> </a>
                  <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
              </div>
              <div class="collapse navbar-collapse" id="navcol-1">

                  <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown active"><a class="link_dropdown"  href="index.html" class="dropdown-toggle">Dashboard </a>
                          <ul class="drop-menu open active  col col-md-2" role="menu">
                              <li><a href="#"> <i class="fa fa-user"></i>Profil</a></li>
                              <li><a href="#"> <i class="fa fa-gear"></i>Akun</a></li>

                          </ul>
                        </li>
                   <!--  <li class="dropdown not-active"><a class="link_dropdown"  href="datatable.html" class="dropdown-toggle">tables </a>
                          <ul class="drop-menu sub-menu not-active  col col-md-2" >
                              <li><a href="datatable.html">Data tables</a></li>
                              <li><a href="#">submenu 2</a></li>

                          </ul>
                        </li>
                        <li class="dropdown not-active"><a class="link_dropdown" data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Menu 3 </a>
                          <ul class="drop-menu sub-menu not-active  col col-md-2" >
                              <li><a href="#">submenu 3</a></li>
                              <li><a href="#">submenu 3</a></li>

                          </ul>
                        </li>
                        <li class="dropdown not-active"><a class="link_dropdown" data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Menu 4 </a>
                          <ul class="drop-menu sub-menu not-active  col col-md-2" >
                              <li><a href="#">submenu 4</a></li>
                              <li><a href="#">submenu 4</a></li>

                          </ul>
                        </li> -->
                        

                  </ul>
                  <ul class="nav navbar-nav navbar-right navbar-log">
                    <li><a href="#">User</a></li>
                    <li><a href="<?=site_url('user/login_user/logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                  </ul>
              </div>
          </div>
      </div>
  </nav>
  <div class="container-fluid as-content">
      <div class="row">
          <div class="col col-md-2 col-sm-2 col-xs-12 left-content">
              
          </div>


 <ci:doc type="modules"/>

    </div>
      </div>
  </div>

     <div class="container-fluid footer-bottom">
        <div class="row">
            <div class=" col col-md-2 col-sm-2 col-xs-12"></div>
            <div class="col-md-10 col-sm-10 col-xs-12 text-left">
                <ul class="list-inline">
                    <li><a href="#"><i class="fa fa-copyright"></i>IDren 2018</a></li>
                    
                </ul>
            </div>
        </div>
    </div>
    <script src="<?=base_url();?>assets/user/js/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/user/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/user/bootstrap/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/user/bootstrap/datatables/dataTables.bootstrap.min.js"></script>
     <script src="<?=base_url();?>assets/user/js/script.js"></script>
    <script type<?=base_url();?>assets/user/javascript">
        $(document).ready(function() {
            $(".dropdown").click(function(){

                // console.log($(this).find(".drop-menu"));
                if ($(".drop-menu").hasClass("not-active")) {
                    $(".drop-menu").removeClass("active").addClass("not-active");
                    $(this).find(".drop-menu").addClass("active").removeClass("not-active"); 

                }
            });
            $(".dropdown").click(function(){
                // console.log($(this).find(".drop-menu"));
                if ($(".dropdown").hasClass("not-active")) {
                    $(".dropdown").removeClass("active").addClass("not-active");
                    $(this).addClass("active").removeClass("not-active"); 
                }
            });
        } );
    </script>
    <script type="text/javascript">
      
    </script>
</body>

</html>   