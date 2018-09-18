<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" Cache-Control:public;>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="public">
    <!-- <meta http-equiv="Cache-control" content="private">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache-control" content="no-store"> -->
    <link rel="shortcut icon" href="<?=base_url();?>media/favicon.ico">
    <link  href="<?=base_url();?>assets/fonts/fonts.min.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/fonts/font-awesome.min.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/css/Navbar-with-mega-menu.min.css" rel="stylesheet" >
    <link  type="text/css" href="<?=base_url();?>assets/css/jsCalendar.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/css/owl.transitions.min.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/css/owl.carousel.min.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/css/css.min.css?t=<?=time();?>" rel="stylesheet" >
    <?php if (isset($share)){ ?>
      <title><?=strtoupper($this->general->title());?>: <?=$share['title'];?></title>
      <meta name="description" content="<?=$share['description'];?>"/>
      <meta property="og:site_name" content="idren.id"/>
      <meta property="fb:app_id" content="173869386564200"/>
      <meta property="og:url" content="<?=$share['url'];?>"/>
      <meta property="og:title" content="<?=$share['title'];?>"/>
      <meta property="og:type" content="article"/>
      <meta property="og:image" content="<?=$share['image'];?>"/>
      <link rel="image_src" type="image/jpeg" href="<?=$share['image'];?>" />
    <?php }else{ ?>
      <title><?=strtoupper($this->general->title());?></title>
    <?php } ?>
    <style type="text/css">
      .modal .ntf_err{color:red}.jsCalendar.material-theme thead{background-color:#D10909!important}.jsCalendar tbody td.jsCalendar-current{background-color:#D10909!important;border-radius:0;transition:0}.jsCalendar tbody{margin:0!important;padding:0!important}.jsCalendar thead{margin:0!important;padding:0!important}.jsCalendar thead .jsCalendar-week-days th,.jsCalendar tbody td{margin:0;height:30px;width:35px}.jsCalendar tbody td:hover{background-color:#EFDBDB;border-radius:0}.waubutton.wau.push{width:100%!important}#ifrm{display:none!important}.address-foot{font-size:14px;word-wrap:break-word}.flag-count{width:100%}.flagcounter-foot{height:auto;overflow:hidden;padding-top:20px}.sub-flagcounter-foot{margin-top:-1em;display:inline-block}.list-inline>li{display:inline!important}.nav li a.active.btn-gabung{background-color:white;color:#D10909;border-radius:5px;border:solid 2px #D10909}.nav li a.active.btn-gabung:hover{background-color:white;color:#891111;border-radius:5px;border:solid 2px #891111}ul.dropdown-menu li a{border:0}.calender_footer{width:100%}.calender_footer table{width:100%}.calender_footer table tr td{padding:6px 5px}.calender_footer .heading,.calender_footer .week{background-color:#D10909!important;color:white}.calender_footer .heading,.calender_footer .week:hover{background-color:#D10909!important;color:white}.calender_footer table tr td,.calender_footer table tr th{border:none;cursor:default}.calender_footer table tr td:hover{background-color:#EFDBDB!important}.calender_footer .highlight{background-color:#D10909!important;color:white}.heading i.fa{background-color:#D10909!important}


       /*   ul.dropdown-menu li a:hover{
            color: #D10909;
            border: 0;
            border-bottom: solid 0 #E72A2A;
            background-color: white;
          }*/
           .nav li.sub-btn-gabung .dropdown-menu{
                /*border: solid 1px #D10909;
                border-radius: 4px;*/
                left: -6em;
          }
    </style>
    <include expiration=’7d’ path=’*.css’/><include expiration=’7d’ path=’*.js’/><include expiration=’3d’ path=’*.gif’/><include expiration=’3d’ path=’*.jpeg’/><include expiration=’3d’ path=’*.jpg’/><include expiration=’3d’ path=’*.png’/><meta http-equiv=”expires” content=”sat, 02 jun 2020 00:00:00 GMT”/>
<?php 
     header("Cache-Control: private, max-age=10800, pre-check=10800");
     header("Pragma: private");
     header("Expires: " . date(DATE_RFC822,strtotime("+7 day")));
?>
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
</head>

<body>
        <nav class="navbar navbar-fixed-top " id="main-navigation">
      <div class="">
            <div class="container-fluid">
              <div class="navbar-header"><a href="<?php echo site_url('web/home'); ?>" class="navbar-brand navbar-link"><img class="logo" src="<?=base_url().logo_helper()['image'];?>" alt="logo idren"/> </a>
                  <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
              </div>
              <div class="collapse navbar-collapse" id="navcol-1">

                  <ul class="nav navbar-nav navbar-right">
                      <?=$this->general->menu();?>

                       <li class="dropdown  sub-btn-gabung"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle active btn-gabung">Login <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="<?php echo site_url('user/login_user') ?>">Dosen</a></li>
                              <li><a href="<?php echo site_url('user/login_user/login_mahasiswa') ?>">Mahasiswa</a></li>

                          </ul>
                        </li>

                  </ul>
              </div>
          </div>
      </div>
  </nav>

          <ci:doc type="modules"/>


    <div class="container wraper">
        <footer>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 footer-left">
                    <h3 class="title-footer">Didukung oleh</h3>
                    <ul class="list-inline">
                        <li><img src="<?=base_url();?>assets/images/logo/Logo-Ristekdikti-Arza.jpg" class="logo-sponsor logo2" alt="logo sponsor"></li>
                        <li><img src="<?=base_url();?>assets/images/logo/images_telkom.jpg" class="logo-sponsor" alt="logo sponsor"></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 footer-center text-center address-foot">
                	<h3 class="title-footer">Kantor Pusat</h3>
                	<div class="col-md-6 col-sm-12 col-xs-12 address-foot" style=""><?php echo footer_helper()['data']['address']; ?></div>
                	<div class="col-md-6 col-sm-12 col-xs-12 address-foot" style=""><?php echo footer_helper()['data']['address2']; ?></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 footer-right text-center">
                  <h3 class="title-footer">Kalender</h3>
                    <ul class="list-unstyled calender_footer" style="">
                      <li><?php echo kalender_helper();?></li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12 footer-right text-right" ">
                  <h3 class="title-footer">Hits Counter</h3>
                  <div style="text-align:center;" id="_wau4yv"></div>
                  <div align="left" class="flagcounter-foot">
                      <div class="sub-flagcounter-foot">
                        <a name="flag" href="https://info.flagcounter.com/XLv2" ><img style="width: 100%;" src="https://s01.flagcounter.com/count2/XLv2/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_10/viewers_3/labels_1/pageviews_1/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
                      </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="container-fluid footer-bottom">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <ul class="list-inline">
                    <li><a href="#"><i class="fa fa-copyright"></i>IDren 2018</a></li>
                    <li><a href="#">kebijakan Privasi</a></li>
                    <li><a href="#">FAQ </a></li>
                    <li><a href="#">Syarat dan Ketentuan</a></li>
                    <li><a href="<?php echo site_url('web/sitemap'); ?>">sitemap</a></li>
                </ul>
            </div>
        </div>
    </div>
<!-- Modal -->
    <div id="myModal" class="modal fade modal-register" role="dialog" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center" style="color:#CF090A; ">Registrasi</h2>
          </div>
          <div class="modal-body" methode="POST" >
            <form id="register_form">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name ..." value="">
                <div class="error" id="ntf_name"></div>
              </div>
              <!-- textarea -->
              <div class="form-group">
                <label>Username</label>
                <input type="texr" class="form-control" name="username" id="username" rows="3" placeholder="Enter Username ..." >
                <div class="error" id="ntf_username"></div>
              </div>

              <div class="form-group">
              <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter Password ...">
                <div class="error" id="ntf_password"></div>
              </div>

              <div class="form-group">
              <label>Re type Password</label>
                <input type="password" class="form-control" name="repassword" id="repassword" value="" placeholder="Enter Re type Password ...">
                <div class="error" id="ntf_repassword"></div>
              </div>

              <div class="form-group">
              <label>E - Mail</label>
                <input type="text" class="form-control" name="email" id="email" value="" placeholder="Enter E-mail ...">
                <div class="error" id="ntf_email"></div>
              </div>

              <div class="form-group">
              <label>Phone Number</label>
                <input type="text" class="form-control" name="phone" id="phone" value="" placeholder="Enter Phone Number ...">
                <div class="error" id="ntf_phone"></div>
              </div>

              <div class="form-group">
              <label>Instansi</label>
                <select name="instansi" class="form-control" id="instansi">
                  <option value="">--- Select Instansi ---</option>

                </select>
                <div class="error" id="ntf_instansi"></div>
              </div>
                <div class="text-right">
                  <button type="button" id="btn_register" class="btn btn-danger btn-default">Simpan</button>
                </div>
              </form>
          </div>

        </div>

      </div>
    </div>


  
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/owl.carousel.min.js"></script>
    <script src="<?=base_url();?>assets/share_link/js/social-share-kit.min.js"></script>
    <script type="text/javascript">
    
        
    </script>
    <script type="text/javascript">
SocialShareKit.init({
    onBeforeOpen: function(targetElement, network, paramsObj){
        console.log(arguments);
    },
    onOpen: function(targetElement, network, networkUrl, popupWindow){
        console.log(arguments);
    },
    onClose: function(targetElement, network, networkUrl, popupWindow){
        console.log(arguments);
    }
});
</script>
    <script src="<?=base_url();?>assets/js/main-owl.min.js"></script>
      <script src="<?=base_url();?>assets/js/scrolling-nav.min.js"></script>
      <script id="_wau4yv">var _wau = _wau || []; _wau.push(["dynamic", "tmevyyvsq3", "4yv", "c4302bffffff", "big"]);</script><script async src="//waust.at/d.js"></script>

      <script type="text/javascript" src="<?=base_url();?>assets/js/jsCalendar.js"></script>
 <script src="<?=base_url();?>assets/js/jquery.easing.min.js"></script>
<?php if(current_url() == site_url('web/galery/video')||current_url() == site_url('web/layanan/id_tube')){ ?>
   <script type="text/javascript" src="<?=base_url();?>assets/js/jquery.waterwheelCarousel.miny.js"></script>
 <?php } ?>
</body>
</html>