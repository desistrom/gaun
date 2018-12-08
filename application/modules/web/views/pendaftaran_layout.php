<meta name="description" content="Simple ideas for enhancing text input interactions" />
<meta name="keywords" content="input, text, effect, focus, transition, interaction, inspiration, web design" />
<meta name="author" content="Codrops" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url();?>assets/css/style_register.min.css?t=<?=time();?>">
<link rel="stylesheet" href="<?=base_url();?>assets/css/style_register_2.min.css?t=<?=time();?>">
<style type="text/css">
  option{
    color: black;
  }
</style>
<section class="detail_news" style="">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1>Pendaftaran </h1></div>
            </div>
        </div>
        <div class="container-fluid pentahelix">
            <div class="row content-news">
                <div class="col-md-3 col-sm-4 col-xs-12 content-right">
                    <div class="form-group filter-form ">
                        <h3 class="title-content" style="color: white;margin-bottom: 1.5em;">Register right now <br>and <span class="bold">lets collaborate </span></h3>
                        <h4 style="color: white" class="title-form bold">REGISTER</h4>
                        <div style="display: inline-block;height: 3px;width: 50px;background-color: white;"></div>
                        <form id="register_form">
                            <div class="content">
                                <span class="input input--hoshi">
                                    <input class="input__field input__field--hoshi" type="text" id="input-4 instansi" name="instansi" />
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4"  >
                                        <span class="input__label-content input__label-content--hoshi">Institute Name</span>
                                    </label>
                                    <span class="error" id="ntf_instansi"></span>
                                </span>
                                <span class="input input--hoshi">
                                    <input class="input__field input__field--hoshi" type="text" id="input-4 address" name="address" />
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                        <span class="input__label-content input__label-content--hoshi">Address</span>
                                    </label>
                                    <span class="error" id="ntf_address"></span>
                                </span>

                                <span class="input input--hoshi">
                                    <input class="input__field input__field--hoshi" type="email" id="input-4 email" name="email" />
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                        <span class="input__label-content input__label-content--hoshi">Email </span>
                                    </label>
                                    <span class="error" id="ntf_email"></span>
                                </span>
                                <span class="input input--hoshi">
                                    <input class="input__field input__field--hoshi" type="text" id="input-4 phone" name="phone" />
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                        <span class="input__label-content input__label-content--hoshi">Phone</span>
                                    </label>
                                    <span class="error" id="ntf_phone"></span>
                                </span>
                                 <span class="input input--hoshi">
                                    <input class="input__field input__field--hoshi" type="text" id="input-4 website" name="website" />
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                        <span class="input__label-content input__label-content--hoshi">Website</span>
                                    </label>
                                    <span class="error" id="ntf_website"></span>
                                </span>
                                <span class="input input--hoshi">
                                    <input class="input__field input__field--hoshi" type="text" id="input-4 username" name="username" />
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                        <span class="input__label-content input__label-content--hoshi">Username</span>
                                    </label>
                                    <span class="error" id="ntf_username"></span>
                                </span>
                                <span class="input input--hoshi">
                                    <!-- <input class="input__field input__field--hoshi" type="password" id="input-4 password" name="password" /> -->
                                    <select class="input__field input__field--hoshi" id="input-4 jinstansi" name="jinstansi">
                                      <option value="">-- Select Instansi --</option>
                                      <?php foreach ($instansi as $key => $value) : ?>
                                        <option value="<?php echo $value['id_jenis_instansi']; ?>"><?php echo $value['nm_jenis_instansi']; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                        <!-- <span class="input__label-content input__label-content--hoshi">Instansi</span> -->
                                    </label>
                                    <span class="error" id="ntf_jinstansi"></span>
                                </span>
                                <!-- <span class="input input--hoshi">
                                    <input class="input__field input__field--hoshi" type="password" id="input-4 repassword" name="repassword" />
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                        <span class="input__label-content input__label-content--hoshi">Confirm Password</span>
                                    </label>
                                    <span class="error" id="ntf_repassword"></span>
                                </span> -->
                                <div class="form-group" style="display: block;">
                                  <?php echo $captcha // tampilkan recaptcha ?>
                                  <div class="error" id="ntf_g-recaptcha-response" style="position: relative;"></div>
                                </div>
                    
                             </div>
                             <div class="col col-md-12 col-sm-12 col-xs-12 action-footer">
                                 <!-- <a href="#" style="color: #989898;">Forgot Password?</a> -->
                             </div>
                             <div class="col col-md-6 col-sm-6 col-xs-6 action-footer">
                                 <!-- <a href="#" style="color: #989898;">Forgot Password?</a> -->
                             </div>
                             <div class="col col-md-6 col-sm-6 col-xs-6 text-right action-footer" style="margin-top: 1em;">
                                 <button type="button" id="btn_register" class="btn  btn-submit">Register</button>
                             </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12 content-left box-news">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                      <div class="isi-news" style="padding:25px;color: #919191;"><?php echo $step['step']; ?></div>
                      <div class="col col-md-12 col-sm-12 col-xs-12 text-center">
                        <img class="flowchart" width="" src="<?php echo base_url().$step['picture']; ?>">
                    </div>
                </div>

            </div>
        </div>
    </section>
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
                      <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                      </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>
    <div id="regSukses" class="modal fade modal-register" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center" style="color:#CF090A; ">Registrasi Berhasil</h2>
          </div>
          <div class="modal-body">
            <p class="text-center">Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin</p>
          </div>
        </div>
      </div>
    </div>
    <div id="username-already" class="modal fade modal-register" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center" style="color:#CF090A; ">Registrasi Gagal</h2>
          </div>
          <div class="modal-body">
            <p class="text-center">username sudah terdaftar, ganti unername anda</p>
          </div>
        </div>
      </div>
    </div>  
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
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
          setTimeout(function(){
            $('#progresLoading').modal('hide');
              if(data.state == 1){
                if (data.status == 1) {
                
                    console.log(data);
                    $('#regSukses').modal('show');
                    $('#register_form')[0].reset();
             
              
                    }else{
                      $('#username-already').modal('show');
                      console.log(data.cek)
                    }
                  }
             },3000);
            $.each(data.notif,function(key,value){
            $('.error').show();
            $('#ntf_'+ key).html(value);
            $('#ntf_'+ key).css({'color':'white', 'font-style':'italic'});
            });
            grecaptcha.reset();
      });
    });
    });
 </script>




