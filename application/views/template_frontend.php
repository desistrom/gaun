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
    <link rel="stylesheet" href="<?=base_url();?>assets/css/Navbar-with-mega-menu.min.css">

    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.transitions.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.carousel.min.css">
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
                              <!-- <li><a href="<?php echo site_url('web/layanan/idroam') ?>">IDROAM</a></li>
                              <li><a href="<?php echo site_url('web/layanan/cloud_federation') ?>">Cloud Federation</a></li> -->
                              <li><a href="<?php echo site_url('web/layanan/id_book') ?>">ID-BOOK</a></li>
                              <li><a href="<?php echo site_url('web/layanan/id_journal') ?>">ID-JOURNAL</a></li>
                              <li><a href="<?php echo site_url('web/layanan/id_tube') ?>">ID-TUBE</a></li>
                              <li><a href="<?php echo site_url('web/layanan/id_mail') ?>">ID-MAIL</a></li>
                              <li><a href="<?php echo site_url('web/layanan/id_research') ?>">ID-RESEARCH</a></li>
                              <li><a href="<?php echo site_url('web/layanan/id_link') ?>">ID-LINKS</a></li>
                              <li><a href="<?php echo site_url('web/layanan/id_rank') ?>">ID-RANK</a></li>

                          </ul>
                        </li>
                        <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Konektivitas <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="<?php echo site_url('web/konektivitas') ?>">Topologi</a></li>
                              <li><a href="<?php echo site_url('web/layanan/monitoring') ?>">Monitoring Graph</a></li>

                          </ul>
                        </li>
                        <!-- <li role="presentation" class=""><a <?php if(current_url() == site_url('web/keanggotaan')){ ?> class="active" <?php } ?> href="<?php echo site_url('web/keanggotaan'); ?>">Keanggotaan</a></li> -->
                        <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Keanggotaan <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="<?php echo site_url('web/gabung/register') ?>">Pendaftaran</a></li>
                              <li><a href="<?php echo site_url('web/keanggotaan') ?>">Member</a></li>
                              <li><a href="<?php echo site_url('web/keanggotaan/benefit') ?>">Benefit</a></li>

                          </ul>
                        </li>
                        <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Galery <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="<?php echo site_url('web/galery') ?>">foto</a></li>
                              <li><a href="<?php echo site_url('web/galery/video') ?>">Video</a></li>

                          </ul>
                        </li>
                        <li role="presentation" class=""><a <?php if(current_url() == site_url('web/news')){ ?> class="active" <?php } ?> href="<?php echo site_url('web/news'); ?>">Berita</a></li>
                        <li role="presentation" class=""><a <?php if(current_url() == site_url('web/tentang')){ ?> class="active" <?php } ?> href="<?php echo site_url('web/tentang') ?>">Tentang</a></li>
                  <!--   <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Tentang <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="<?php echo site_url('web/tentang/contact') ?>">Contact Us</a></li>
                              <li><a href="<?php echo site_url('web/tentang') ?>">Tentang IDren</a></li>

                          </ul>
                        </li> -->
                        
                        
                        
                      

                      <!-- <li role="presentation" class="active"><a href="#">Masuk</a></li> -->
                   <!--    <li role="presentation" class=""><a class="active btn-gabung" href="<?php echo site_url('web/gabung/register') ?>" data-toggle="modal" >Gabung</a></li> -->

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
                        <li><?php echo footer_helper()['data']['address']; ?></li>
                        <!-- <li>Gedung Alfamidi Lt.4</li>
                        <li>Jl. Budi Utomo No. 3 Kav.56</li>
                        <li>Sukun Jota Malang</li> -->
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 footer-right text-right">
                    <h3 class="title-footer">Sosial Media</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="<?php echo footer_helper()['data']['FacebookLink']; ?>" class="facebook" target="blank" > <i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="text-left">
                            <a href="<?php echo footer_helper()['data']['TwitterLink']; ?>" target="blank" > <i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="<?php echo footer_helper()['data']['InstagramLink']; ?>" target="blank" > <i class="fa fa-instagram"></i></a>
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
                  <?php foreach (instansi_helper()['data'] as $key => $value): ?>
                    <option value="<?=$value['id'];?>"><?=$value['instansi'];?></option>  
                  <?php endforeach ?>
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

<!--     <div id="regSukses" class="modal fade modal-register" role="dialog" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">


        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center" style="color:#CF090A; ">Registrasi Berhasil</h2>
          </div>
          <div class="modal-body">
          </div>

        </div>

      </div>
    </div> -->
    <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
   
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
   
    <script src="<?=base_url();?>assets/js/owl.carousel.min.js"></script>
    <script src="<?=base_url();?>assets/js/main-owl.min.js"></script>
      <script src="<?=base_url();?>assets/js/scrolling-nav.min.js"></script>
 <script src="<?=base_url();?>assets/js/jquery.easing.min.js"></script>
<?php if(current_url() == site_url('web/galery/video')){ ?> 
   <script type="text/javascript" src="<?=base_url();?>assets/js/jquery.waterwheelCarousel.miny.js"></script>
 <?php } ?>
 
<!--  <script type="text/javascript">
   var base_url = "<?=base_url();?>"
    $(document).ready(function(){
      $(".btn-gabung").click(function(){
          $("#myModal").modal();
      });

      $('body').on('click','#btn_register', function(){
      // console.log($('form').val());
      // $('#content').val(CKEDITOR.instances.content.getData());
      // return false;
      $.ajax({
          url : base_url+"web/home/insert_user",
          dataType : 'json',
          type : 'POST',
          data : $('#register_form').serialize()
      }).done(function(data){
          console.log(data);
          if(data.state == 1){
            if (data.status == 1) {
              $('#regSukses').modal('show');
            }else{
              $('.error_pass').show();
              $('.error_pass').css({'color':'red', 'font-style':'italic', 'text-align':'center'});
              console.log(data);
              $('.error_pass').html(data.error);
            }
          }
            $.each(data.notif,function(key,value){
            $('.error').show();
            $('#ntf_'+ key).html(value);
            $('#ntf_'+ key).css({'color':'red', 'font-style':'italic'});
            });
      });
    });

    });
 </script> -->
 <!--  <script type="text/javascript">
   var base_url = "<?=base_url();?>"
    $(document).ready(function(){

      $('body').on('click','#btn_register', function(){
      // console.log($('form').val());
      // $('#content').val(CKEDITOR.instances.content.getData());
      // return false;
      $.ajax({
          url : base_url+"web/gabung/insert_user",
          dataType : 'json',
          type : 'POST',
          data : $('#register_form').serialize()
      }).done(function(data){
          console.log(data);
          if(data.state == 1){
            if (data.status == 1) {
              $('#regSukses').modal('show');
            }else{
              $('.error_pass').show();
              $('.error_pass').css({'color':'red', 'font-style':'italic', 'text-align':'center'});
              console.log(data);
              $('.error_pass').html(data.error);
            }
          }
            $.each(data.notif,function(key,value){
            $('.error').show();
            $('#ntf_'+ key).html(value);
            $('#ntf_'+ key).css({'color':'red', 'font-style':'italic'});
            });
      });
    });

    });
 </script> -->
</body>

</html>