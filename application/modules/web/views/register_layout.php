<meta name="description" content="Simple ideas for enhancing text input interactions" />
<meta name="keywords" content="input, text, effect, focus, transition, interaction, inspiration, web design" />
<meta name="author" content="Codrops" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url();?>assets/css/style_register.min.css?t=<?=time();?>">
    <style type="text/css">
        /* Hoshi */
        .input {
    position: relative;
    z-index: 1;
    display: inline-block;
    margin: 0 1em;
    max-width: 100%;
    width: calc(100% - 2em);
    vertical-align: top;

}

.input__field {
    position: relative;
    display: block;
    float: right;
    padding: 0.8em;
    width: 60%;
    border: none;
    border-radius: 0;
    background: #f0f0f0;

    
    -webkit-appearance: none; /* for box shadows to show on iOS */
}

.input__field:focus {
    outline: none;
}

.input__label {
    display: inline-block;
    float: right;
    padding: 0 1em;
    width: 40%;
    color: #6a7989;
    font-weight: bold;
    font-size: 90%;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
     font-weight: 400;
}

.input__label-content {
    position: relative;
    display: block;
    padding: 1em 0;
    width: 100%;
}

.graphic {
    position: absolute;
    top: 0;
    left: 0;
    fill: none;
}



/* Individual styles */
.input--hoshi {
    overflow: hidden;
}

.input__field--hoshi {
    margin-top: 1em;
    padding: 1em 0.15em;
    width: 100%;
    background: transparent;
    color: #595F6E;
}

.input__label--hoshi {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 0 0.25em;
    width: 100%;
    height: calc(100% - 1em);
    text-align: left;
    pointer-events: none;
}

.input__label-content--hoshi {
    position: absolute;
}

.input__label--hoshi::before,
.input__label--hoshi::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: calc(100% - 10px);
    border-bottom: 1px solid #B9C1CA;
}

.input__label--hoshi::after {
    margin-top: 2px;
    border-bottom: 4px solid red;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    -webkit-transition: -webkit-transform 0.3s;
    transition: transform 0.3s;
}

.input__label--hoshi-color-1::after {
    border-color:#CF090A;
}


.input__field--hoshi:focus + .input__label--hoshi::after,
.input--filled .input__label--hoshi::after {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}

.input__field--hoshi:focus + .input__label--hoshi .input__label-content--hoshi,
.input--filled .input__label-content--hoshi {
    -webkit-animation: anim-1 0.3s forwards;
    animation: anim-1 0.3s forwards;
}
.error{
    position: absolute;
    bottom: -3px;
}


@-webkit-keyframes anim-1 {
    50% {
        opacity: 0;
        -webkit-transform: translate3d(1em, 0, 0);
        transform: translate3d(1em, 0, 0);
    }
    51% {
        opacity: 0;
        -webkit-transform: translate3d(-1em, -40%, 0);
        transform: translate3d(-1em, -40%, 0);
    }
    100% {
        opacity: 1;
        -webkit-transform: translate3d(0, -40%, 0);
        transform: translate3d(0, -40%, 0);
    }
}

@keyframes anim-1 {
    50% {
        opacity: 0;
        -webkit-transform: translate3d(1em, 0, 0);
        transform: translate3d(1em, 0, 0);
    }
    51% {
        opacity: 0;
        -webkit-transform: translate3d(-1em, -40%, 0);
        transform: translate3d(-1em, -40%, 0);
    }
    100% {
        opacity: 1;
        -webkit-transform: translate3d(0, -40%, 0);
        transform: translate3d(0, -40%, 0);
    }

}
.box-danger{
    text-align: center;
    padding: 1em 0;
    border-top: solid 4px red;
}
.box-danger i{
    font-size: 36px;
}

    </style>
</head>

<body>
   
    <section class="page_register" style="margin-top: 6em;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 content-right-register text-center">
                    <h1 class="title-content">Register right now <br>and <span class="bold">lets collaborate </span></h1>
                
                </div>
                <div class="col-md-6 col-sm- col-xs-12 content-left-register">
                    <div class="form-group filter-form ">
                        <div class="logo-login text-center">
                            <img src="<?=base_url();?>assets/images/logo/Asset_16@4x.png" >
                        </div>
                        <h2 class="title-form bold">REGISTER</h2>
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
                                    <input class="input__field input__field--hoshi" type="password" id="input-4 password" name="password" />
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                        <span class="input__label-content input__label-content--hoshi">Password</span>
                                    </label>
                                    <span class="error" id="ntf_password"></span>
                                </span>
                                <span class="input input--hoshi">
                                    <input class="input__field input__field--hoshi" type="password" id="input-4 repassword" name="repassword" />
                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                        <span class="input__label-content input__label-content--hoshi">Confirm Password</span>
                                    </label>
                                    <span class="error" id="ntf_repassword"></span>
                                </span>
                    
                             </div>
                             <div class="col col-md-6 col-sm-6 col-xs-6 action-footer">
                                 <!-- <a href="#" style="color: #989898;">Forgot Password?</a> -->
                             </div>
                             <div class="col col-md-6 col-sm-6 col-xs-6 text-right action-footer">
                                 <button type="button" id="btn_register" class="btn btn-danger btn-submit">Register</button>
                             </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <div class="container-fluid bg-white bg-white-none" style="margin-bottom: 12em;"></div>


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
 <script src="<?=base_url();?>assets/js/classie.js"></script>
    <script>
            (function() {
                // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
                if (!String.prototype.trim) {
                    (function() {
                        // Make sure we trim BOM and NBSP
                        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                        String.prototype.trim = function() {
                            return this.replace(rtrim, '');
                        };
                    })();
                }

                [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
                    // in case the input is already filled..
                    if( inputEl.value.trim() !== '' ) {
                        classie.add( inputEl.parentNode, 'input--filled' );
                    }

                    // events:
                    inputEl.addEventListener( 'focus', onInputFocus );
                    inputEl.addEventListener( 'blur', onInputBlur );
                } );

                function onInputFocus( ev ) {
                    classie.add( ev.target.parentNode, 'input--filled' );
                }

                function onInputBlur( ev ) {
                    if( ev.target.value.trim() === '' ) {
                        classie.remove( ev.target.parentNode, 'input--filled' );
                    }
                }
            })();





        </script>


         <script type="text/javascript">
   var base_url = "<?=base_url();?>"
    $(document).ready(function(){

      $('body').on('click','#btn_register', function(){
        $('#progresLoading').modal('show');
      console.log($('form').val());
      // $('#content').val(CKEDITOR.instances.content.getData());
      // return false;
      $.ajax({
          url : base_url+"web/gabung/insert_user",
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
            $('#ntf_'+ key).css({'color':'red', 'font-style':'italic'});
            });
      });
    });

    });
 </script>