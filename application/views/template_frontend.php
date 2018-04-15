<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IDren</title>
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/fonts/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/Navbar-with-mega-menu.css">

    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.transitions.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/css.css">
    <style type="text/css">
      .modal .ntf_err{
          color: red;
      }
    </style>
</head>

<body>
        <nav class="navbar navbar-fixed-top " id="main-navigation">
      <div class="">
            <div class="container-fluid">
              <div class="navbar-header"><a href="<?php echo site_url('web/home'); ?>" class="navbar-brand navbar-link"><img class="logo" src="<?=base_url()."media/".logo_helper()['data']['image'];?>" /> </a>
                  <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
              </div>
              <div class="collapse navbar-collapse" id="navcol-1">

                  <ul class="nav navbar-nav navbar-right">
                      <li role="presentation" ><a <?php if(current_url() == site_url('web/home') || current_url() == site_url()){ ?> class="active" <?php } ?> href="<?php echo site_url('web/home'); ?>">Home</a></li>
                      <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle <?php if(current_url() == site_url('web/a')){ ?> active <?php } ?>">Layanan <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="<?php echo site_url('web/layanan/idroam') ?>">IDROAM</a></li>
                              <li><a href="<?php echo site_url('web/layanan/cloud_federation') ?>">Cloud Federation</a></li>

                          </ul>
                        </li>
                    <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Tentang <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="<?php echo site_url('web/tentang/contact') ?>">Contact Us</a></li>
                              <li><a href="<?php echo site_url('web/tentang') ?>">Tentang IDren</a></li>

                          </ul>
                        </li>
                        <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Galery <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="#">foto</a></li>
                              <li><a href="#">Video</a></li>

                          </ul>
                        </li>
                        <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Konektivitas <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="<?php echo site_url('web/konektivitas') ?>">Topologi</a></li>

                          </ul>
                        </li>
                        <li role="presentation" class=""><a <?php if(current_url() == site_url('web/keanggotaan')){ ?> class="active" <?php } ?> href="<?php echo site_url('web/keanggotaan'); ?>">Keanggotaan</a></li>
                      <li role="presentation" class=""><a <?php if(current_url() == site_url('web/news')){ ?> class="active" <?php } ?> href="<?php echo site_url('web/news'); ?>">Berita</a></li>

                      <!-- <li role="presentation" class="active"><a href="#">Masuk</a></li> -->
                      <li role="presentation" class="active btn-gabung"><a href="#" data-toggle="modal" >Gabung</a></li>

                  </ul>
              </div>
          </div>
      </div>
  </nav>

          <ci:doc type="modules"/>







    <div class="container wraper">
        <footer>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 footer-left">
                    <h3 class="title-footer">Didukung oleh</h3>
                    <ul class="list-inline">
                        <li><img src="<?=base_url();?>assets/images/logo/Logo-Ristekdikti-Arza.jpg" class="logo-sponsor logo2"></li>
                        <li><img src="<?=base_url();?>assets/images/logo/images_telkom.jpg" class="logo-sponsor"></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 footer-center text-center">
                    <h3 class="title-footer">Kantor Pusat</h3>
                    <ul class="list-unstyled">
                        <li>Gedung Alfamidi Lt.4</li>
                        <li>Jl. Budi Utomo No. 3 Kav.56</li>
                        <li>Sukun Jota Malang</li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 footer-right text-right">
                    <h3 class="title-footer">Sosial Media</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="facebook"> <i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="text-left">
                            <a href="#"> <i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"> <i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
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
            <h4 class="modal-title text-center">Registerr</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="" class="form-control" id="name" placeholder="Name">
                  <div class="ntf_err">harus diisi</div>
                </div>
                <div class="form-group">
                  <label for="name_institusi"> Institusi Name</label>
                  <input type="" class="form-control" id="name_institusi" placeholder="Institusi Name">
                  <div class="ntf_err">harus diisi</div>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email">
                  <div class="ntf_err">harus diisi</div>
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="" class="form-control" id="phone" placeholder="Phone">
                  <div class="ntf_err">harus diisi</div>
                </div>
                <div class="form-group">
                  <label for="username">username</label>
                  <input type="username" class="form-control" id="username" placeholder="username">
                  <div class="ntf_err">harus diisi</div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Password">
                  <div class="ntf_err">harus diisi</div>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-danger btn-default">Simpan</button>
                </div>
              </form>
          </div>

        </div>

      </div>
    </div>

    <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
   
    <script src="<?=base_url();?>assets/js/owl.carousel.min.js"></script>
    <script src="<?=base_url();?>assets/js/main-owl.js"></script>
      <script src="<?=base_url();?>assets/js/scrolling-nav.js"></script>
 <script src="<?=base_url();?>assets/js/jquery.easing.min.js"></script>
 <script type="text/javascript">
   
    $(document).ready(function(){
      $(".btn-gabung").click(function(){
          $(".modal-register").modal();
      });
    });
 </script>
</body>

</html>