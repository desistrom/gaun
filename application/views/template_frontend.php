<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
<!--     <link rel="stylesheet" href="<?=base_url();?>assets/css/styles1.css"> -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.transitions.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.carousel.css">
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

.filter-img div.box{
  position:relative;
  width:100%;
  height:240px;
  overflow:hidden;
}

.filter-img div.box{
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

.filter-img div.sub-box{
  top:0;
/*  position:absolute;*/
  left:0;
}

img.image-gallery{
  -webkit-transition:0.4s ease;
  transition:0.4s ease;
  width:380px;

}

.filter-img div.box:hover img.image-gallery{
  -webkit-transform:scale(2);
  transform:scale(2);

}
..filter-img box .thumbnail{
  padding: 0;
  border-radius: 5px;
}
.filter-img .box .thumbnail:hover{
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
      <div class="container">
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
                      <li role="presentation" class=""><a href="#">News</a></li>

                      <li role="presentation" class="active"><a href="<?php echo site_url('web/keanggotaan') ?>">Keanggotaan</a></li>
                      <li role="presentation" class="active"><a href="#" data-toggle="modal" data-target="#myModal">Register</a></li>

                  </ul>
              </div>
          </div>
      </div>
  </nav>

          <ci:doc type="modules"/>






        <!-- Modal -->
          <div class="modal fade modal-notif" id="myModal" role="dialog" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <!-- <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div> -->
                <div class="modal-body" style="height: auto;overflow: hidden;"">
                  <h2 class="text-center" style="padding: 0 0 15px 0">Register</h2>
                  <div class="">
                    <form method="post" action="" id="form-register"> 
                      <div class="form-group"> 
                        <label for="exampleInputEmail1">Nama Institusi</label> 
                        <!-- <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Institusi">  -->
                        <select class="form-control" name="name_institusi">
                          <option>Kampus</option>
                          <option>SMK</option>
                        </select>
                      </div> 
                      <div class="form-group"> 
                        <label for="">Alamat</label> 
                        <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat"> 
                      </div>
                      <div class="form-group"> 
                        <label for="">Email</label> 
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email"> 
                      </div>
                      <div class="form-group"> 
                        <label for="">No Telp.</label> 
                        <input type="text" class="form-control" id="no" placeholder="No Telephone" name="no_telp"> 
                      </div>
                      <div class="form-group"> 
                        <div class="col col-md-6 col-sm-6 col-xs-12" style="padding-left: 0;">
                          <label for="">Password</label> 
                          <input type="password" class="form-control" id="pass" placeholder="Password" name="password">
                        </div> 
<!--                          <div class="col col-md-6 col-sm-6 col-xs-12" style="padding-right: 0;">
                          <label for="">Confirm Password</label> 
                          <input type="password" class="form-control" id="confirm_pass" placeholder="Password">
                        </div> -->
                      </div>  
                        <div class="col col-md-12 col-sm-12 col-xs-12 text-right" style="padding-right: 0;">
                          <button  class="btn btn-default " data-dismiss="modal" style="margin-top:15px;">Batal</button>
                          <button type="submit" class="btn btn-register btn-primary" id="register" data-toggle="modal" data-dismiss="modal" style="margin-top:15px;">Register</button>
                        </div> 
                      </form>
                  </div>

                </div>
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
              </div>
            </div>
          </div>


        <!-- Modal berhasil -->
          <div class="modal fade modal-notif-berhasil" id="myModal-berhasil" role="dialog" >
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <!-- <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div> -->
                <div class="modal-body" style="height: auto;overflow: hidden;"">
                  <h2 class="text-center" style="padding: 0 0 15px 0">Register Berhasil</h2>
                  </div>

                </div>
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
              </div>
            </div>
          </div>
  
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js/owl.carousel.min.js"></script>
<script src="<?=base_url();?>assets/js/main-owl.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/modal-custom.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        $("#register").click(function(){
        $("#myModal-berhasil").modal();
        });
        // $('body').on('click','.btn-register',function(){
        //     var data = $('#form-register').serialize();
            
        //         // window.location.href = '<?=base_url();?>web/galery/search_foto?data='+data;
        //         $.ajax({
        //         url : '<?=base_url();?>web/keanggotaan/insert_user',
        //         type : 'POST',
        //         dataType : 'json',
        //         data :data
        //     }).done(function(data){
        //         console.log(data);
        //         $('.replace-content').html(data);
        //     });
           
        // });
    });
</script>
</script>

</body>

</html>