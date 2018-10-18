    <!DOCTYPE html>
    <html>
    <head>
       <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>login <?=$breadcumb;?></title>
        <link rel="shortcut icon" href="<?=base_url();?>media/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,600,700" rel="stylesheet">
    <link  href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/fonts/font-awesome.min.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/css/Navbar-with-mega-menu.min.css" rel="stylesheet" >
    <link  type="text/css" href="<?=base_url();?>assets/css/jsCalendar.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/css/owl.transitions.min.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/css/owl.carousel.min.css" rel="stylesheet" >
    <link  href="<?=base_url();?>assets/css/css.min.css?t=<?=time();?>" rel="stylesheet" >
    </head>
    <body>
    
    
    <style type="text/css">
        div.container-fluid.content-comment{
          background-color: white;
        }
        div.container-fluid.content-comment{
          height: auto;
        }
        .google{
          display: inline-block;
          margin-left: 10px;
          float: right;
        }
        .fb{
          display: inline-block;
            margin-right: 10px;
            float: left;
        }
        .fb .btn{
          padding: 10px 20px;
        }
        .google .btn{
          padding: 10px 20px;
        }
        .other-registery{
          text-align: center;
          padding: 0 3em 0 3em;
          height: auto;
          overflow: hidden;
        }
        .content-comment a.btn.btn-post{
          padding: 10px 20px;
        }
        .google .btn-google{
          background-color: white;
          color: black;
          border:solid #A2A2A2 1px;
        }
        .google .btn-google:hover{
          background-color: #CF0909;
          color: white;
         
        }
        .google .btn-google i{
          color: #34A853;
        }
        .logo-google-ico{
              width: 14px;
        }
        .content-comment .sub-comment-right{
          margin-top: 1em;
        }
        div.container-fluid.content-comment{
          padding-top: 1em;
        }
        .title-login{
          color: #9E9E9E;
          padding: 15px 0;
          margin:0;
        }
        .btn-register{
        	background: #5AA7DF;
        	background-color: #5AA7DF
        }
        .content-comment a.btn.btn-register{
        	background: #5AA7DF;
        	background-color: #5AA7DF;
        	color:white;
        }
        .error{
          background-color: white;
          color: black!important;
          margin-top: 4px;
        }
        @media (max-width:1300px) {
          div.container-fluid{
            padding: 0 15px;
          }
          .content-comment .right-comment{
            padding: 0;
          }
          .content-comment .sub-comment-right{
            padding: 15px ;
          }
           .google{
          display: inline-block;
          margin-left: 0;
          margin: 5px;
        }
        .fb{
          display: inline-block;
            margin-right: 0;
            margin: 5px;
        }
        }
        .detail_news{
          margin-top: 9em;
        }
        .nav li a.active.btn-gabung:hover{
          border:none;
        }
    </style>   
    <section class="detail_news" style="background-color: #F2F2F2;">
        
        <div class="container-fluid content-comment " style="" >
                    <div class="row sub-content-comment">
                      <div class="col col-md-3 col-sm-3 col-xs-12"></div>
                      <div class="col col-md-6 col-sm-7 col-xs-12">
                        <h3 class="text-center title-login">Login <?=$breadcumb;?></h3>
                        <div class="other-registery">
                          <div class="fb">
                            <a href="<?php echo $fb_data; ?>">
                            <!-- <a href="<?php //echo $fb_data['loginUrl']; ?>"> -->
                            <!-- <a href="<?php //echo site_url('user/login_user/login_fb'); ?>"> -->
                              <button class="btn btn-primary" type="button"><i class="fa fa-facebook"></i> Login Dengan Facebook</button>
                            </a>
                            <!-- <button class="btn btn-primary"><i class="fa fa-facebook"></i> Daftar Dengan Faceook</button> -->
                          </div>
                          <div class="google">
                            <a href="<?php echo $loginURL; ?>">
                              <button class="btn btn-google " type="button"><i class="fa fa-google"></i> Login Dengan Google</button>
                            </a>
                          </div>
                          <div class="col col-md-12 col-xs-12">
                            
                           <p style="text-align: center;padding-top:20px;">--atau--</p>
                          </div>
                        </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 right-comment">
                              <div class="sub-comment-right" style="box-shadow: 0 0 48px 0 #bdbdbd;">
                                  <div class="form-group">
                                      <h2>Login</h2>
                                
                                      <div class="error" id="ntf_login" style="text-align: center;font-weight: bold"></div>
                                      <form id="register_form">
                                      <div class="text-input">
                                          <input type="text" placeholder="Username" name="username" class="input-comment">
                                          <div class="error" id="ntf_username"></div>
                                      </div>
                                   
                                      <div class="text-input">
                                          <input type="password" placeholder="Password" name="password" class="input-comment">
                                          <div class="error" id="ntf_password"></div>
                                      </div>
                                      
                                      
                                      <div class="text-input">
                                        <?php echo $captcha // tampilkan recaptcha ?>
                                        <div class="error" id="ntf_g-recaptcha-response" style="position: relative;"></div>
                                      </div>
                                      </form>
                                      <div><a style="color: white; font-style: italic;" href="<?=site_url('user/login_user/reset_password')?>"><u>Forgot Password</u></a></div>
                                      <div class="text-right" style="padding-top: 10px;">
                                      	<a href="<?=$url;?>" class="btn btn-post btn-register btn-primary " type="button" style="float: left;">Register</a>
                                      	<a class="btn btn-post" type="button" id="btn_register">Login</a>
                                      </div>
                                      <!-- <div class="text-left"><a class="btn btn-post col-md-12" type="button" id="btn_register">Submit</a></div> -->
                                      
                                  </div>
                              </div>
                          </div>
                      </div>
                        <div class="col col-md-3 col-sm-3 col-xs-12"></div>
                    </div>
          </div>
    </section>

</html>
      <div class="modal fade" id="progresLoading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-body">
                  <div class="box box-danger">
                      <div class="box-header">
                      </div>
                      <div class="box-body">
                      </div>
                      <div class="overlay" style="text-align: center">
                        <i class="fa fa-refresh fa-spin fa-3x"></i>
                      </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>
    <?php if($this->session->userdata("notif") != ''){ ?>
    <div id="regSukses" class="modal fade modal-register" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center" style="color:#CF090A; "><?=$this->session->userdata("header");?></h2>
          </div>
          <div class="modal-body">
            <p class="text-center"><?=$this->session->userdata("notif");?></p>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.12&appId=<?=FACEBOOK_APP_ID;?>&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script> 
   <!--  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?=FACEBOOK_APP_ID;?>',
      xfbml      : true,
      version    : 'v2.1'
    });
    FB.AppEvents.logPageView();
      FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        var accessToken = response.authResponse.accessToken;
      } 
    } );
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>  -->
<!-- <script src="<?=base_url();?>assets/js/jquery.min.js"></script> -->
<!-- <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script> -->
 <script src="<?=base_url();?>assets/js/classie.min.js"></script>
 <script src="<?=base_url();?>assets/js/custom_pendaftaran.min.js"></script>
 <script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
   var base_url = "<?=base_url();?>"
    $(document).ready(function(){
      $('body').on('click','#btn_register', function(){
        $('#progresLoading').modal('show');
      console.log($('form').val());
      $.ajax({
          url : window.location.href,
          dataType : 'json',
          type : 'POST',
          data : $('#register_form').serialize()
      }).done(function(data){
          console.log(data);
          // setTimeout(function(){
            $('#progresLoading').modal('hide');
              if(data.state == 1){
                if (data.status == 1) {
                
                    window.location.href = data.url;
                    
                    }
                  }
             // },3000);
            $.each(data.notif,function(key,value){
            $('.error').show();
            $('#ntf_'+ key).html(value);
            $('#ntf_'+ key).css({'color':'white', 'font-style':'italic'});
            });
            grecaptcha.reset();
      });
    });
      <?php if($this->session->flashdata("notif") != ''){ ?>
          $('#regSukses').modal('show');
        <?php } ?>
    });
 </script>


</body>
    </html>

