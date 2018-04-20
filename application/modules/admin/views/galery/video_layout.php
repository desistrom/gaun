<style type="text/css">
  .form-group{
    width: 50%;
  }
</style>
<div class="box ">
  <div class="box-header with-border">
    <h3 class="box-title">Video Galery</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- text input -->
      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" id="judul" placeholder="Enter ..." value="<?php if(isset($galery)){ echo $galery['judul']; } ?>">
        <div class="error" id="ntf_judul"></div>
      </div>
      <!-- textarea -->
      <div class="form-group">
        <label>Deskribsi</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Enter ..." ><?php if(isset($galery)){ echo $galery['deskripsi']; } ?></textarea>
        <div class="error" id="ntf_deskripsi"></div>
      </div>

      <div class="form-group">
      <label>Link</label>
        <input type="text" class="form-control" name="file_name" id="file_name" value="<?php if(isset($galery)){ echo $galery['file_name']; } ?>">
        <div class="error" id="ntf_file_name"></div>
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