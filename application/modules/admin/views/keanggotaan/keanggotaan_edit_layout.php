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
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name ..." value="<?=$anggota['name'];?>">
        <div class="error" id="ntf_name"></div>
      </div>

      <div class="form-group">
      <label>E - Mail</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Enter E-mail ..." value="<?=$anggota['email'];?>">
        <div class="error" id="ntf_email"></div>
      </div>

      <div class="form-group">
      <label>Phone Number</label>
        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number ..." value="<?=$anggota['phone'];?>">
        <div class="error" id="ntf_phone"></div>
      </div>

      <div class="form-group">
      <label>Instansi </label>
        <select name="instansi" class="form-control">
          <option value="">--- Select Instansi ---</option>
          <?php foreach ($instansi as $key => $value): ?>
            <option value="<?=$value['id_instansi'];?>" <?php if ($anggota['id_instansi_ref'] == $value['id_instansi']){ ?> selected <?php } ?> ><?=$value['nm_instansi'];?></option>  
          <?php endforeach ?>
        </select>
        <div class="error" id="ntf_instansi"></div>
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