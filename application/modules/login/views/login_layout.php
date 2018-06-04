<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=strtoupper($this->general->title());?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?=base_url();?>media/favicon.ico" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="shortcut icon" href="<?=base_url();?>media/crop/favicon.png" />
  <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Roboto:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/flat/blue.css">
  <style type="text/css">
    .ntf_err{
      color: red;
    }
    .login-box-body h1{
      text-align: center;font-size: 36px;margin: 0 0 1em 0;color: #2B679C; font-family: 'Roboto', sans-serif;
    }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <div class="login-logo">
    <a href="#"><img style="width: 200px;" src="<?=base_url();?>assets/images/logo/Asset_16@4x.png"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
      <h1 style="">LOGIN</h1>
    <form>
      
      
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <div class="error" id="ntf_username"></div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <div class="error" id="ntf_password"></div>
      </div>
      <div class="form-group has-feedback">
        <?php echo $captcha // tampilkan recaptcha ?>
        <div class="error" id="ntf_g-recaptcha-response"></div>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <div class="error" id="ntf_login"></div>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-primary btn-block btn-flat" id="login">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url();?>assets/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url();?>assets/js/icheck.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click','#login', function(){
                $.ajax({
                    url: window.location.href,
                    type : 'POST',
                    dataType : 'json',
                    data : $('form').serializeArray(),
                    async : false,
                    cache : false ,
                }).done(function(data){
                    console.log(data);
                    if(data.state == 1){
                        if (data.status == 1) {
                            window.location = data.url;
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
                }).fail(function(xhr, status, error){
                    alert(xhr.responseText);
                });
            });

            $('form').keypress(function(){
              if (event.which == 13) {
                $.ajax({
                    url: window.location.href,
                    type : 'POST',
                    dataType : 'json',
                    data : $('form').serializeArray(),
                    async : false,
                    cache : false ,
                }).done(function(data){
                    console.log(data);
                    if(data.state == 1){
                        if (data.status == 1) {
                            window.location = data.url;
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
                }).fail(function(xhr, status, error){
                    alert(xhr.responseText);
                });
              }
            });
        });
    </script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
