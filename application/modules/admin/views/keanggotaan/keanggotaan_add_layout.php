<style type="text/css">
  .form-group{
    width: 50%;
  }
</style>
<div class="box ">
  <div class="box-header with-border">
    <h3 class="box-title">Add Anggota</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- text input -->
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
      </div>z

      <div class="form-group">
      <label>Instansi</label>
        <select name="instansi" class="form-control" id="instansi">
          <option value="">--- Select Instansi ---</option>
          <?php foreach ($instansi as $key => $value): ?>
            <option value="<?=$value['id_instansi'];?>"><?=$value['nm_instansi'];?></option>  
          <?php endforeach ?>
        </select>
        <div class="error" id="ntf_instansi"></div>
      </div>
      <div class="form-group">
      <label>Logo Instansi</label>
        <input type="file" class="form-control" name="userfile" id="userfile">
        <div class="error" id="ntf_userfile"></div>
        <div class="error" id="ntf_error"></div>
      </div>
      <button type="button" class="btn btn-primary" id="submit">Submit</button>

    </form>
  </div>
  <!-- /.box-body -->
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      var form_data = new FormData();
      var data_file = $('#userfile').prop('files')[0];
      form_data.append('userfile',data_file);
      form_data.append('name',$('#name').val());
      form_data.append('username',$('#username').val());
      form_data.append('password',$('#password').val());
      form_data.append('repassword',$('#repassword').val());
      form_data.append('email',$('#email').val());
      form_data.append('phone',$('#phone').val());
      form_data.append('instansi',$('#instansi').val());
      $.ajax({
          url : window.location.href,
          dataType : 'json',
          type : 'POST',
          data : form_data,
          async : false,
          cache : false ,
          contentType : false , 
          processData : false
      }).done(function(data){
          console.log(data);
          if(data.state == 1){
            if (data.status == 1) {
              window.location.href = data.url;
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
</script>