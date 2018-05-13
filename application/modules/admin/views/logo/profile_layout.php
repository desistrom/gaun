<style type="text/css">
  input{
    background-color: #d4d4d4;
  }
</style>
<div class="box ">
  <div class="box-header with-border">
    <h3 class="box-title">Add Anggota</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- textarea -->
      <div class="form-group">
        <label>Username</label>
        <input type="texr" class="form-control" disabled="true" name="username" id="username" rows="3" placeholder="Enter Username ..." value="<?=$profile['username'];?>">
        <div class="error" id="ntf_username"></div>
      </div>

      <div class="form-group">
      <label>Password</label>
        <input type="password" class="form-control" disabled="true" name="password" id="password" value="" placeholder="Enter Password ...">
        <div class="error" id="ntf_password"></div>
      </div>

      <div class="form-group">
      <label>Re type Password</label>
        <input type="password" class="form-control" disabled="true" name="repassword" id="repassword" value="" placeholder="Enter Re type Password ...">
        <div class="error" id="ntf_repassword"></div>
      </div>
       <div class="form-group edit">
        <button type="button" class="btn btn-info" id="edit">Edit</button>
      </div>
    </form>
  </div>
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#edit',function(){
      $('input').attr('disabled',false);
      var button = '<button type="button" class="btn btn-warning" id="cancel">Cancel</button> <button type="button" class="btn btn-success" id="submit">Submit</button>';
      $('.edit').html(button);
    });
    $('body').on('click','#cancel',function(){
      $('input').attr('disabled',true);
      var button = '<button type="button" class="btn btn-info" id="edit">Edit</button>';
      $('.edit').html(button);
    });
    $('body').on('click','#submit', function(){
      $.ajax({
          url : window.location.href,
          dataType : 'json',
          type : 'POST',
          data : $('form').serialize()
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