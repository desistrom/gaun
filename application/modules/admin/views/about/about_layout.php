<style type="text/css">
  .form-group{
    width: 50%;
  }
</style>
<div class="box ">
  <div class="box-header with-border">
    <h3 class="box-title">General Elements</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- textarea -->
      <div class="form-group">
        <label>About</label>
        <textarea class="form-control" name="content" id="content" placeholder="Enter About Content . .. " ><?php if(isset($about)){ echo $about['content']; } ?></textarea>
        <div class="error" id="ntf_content"></div>
      </div>
      <input type="hidden" name="id" value="<?php if(isset($about)){ echo $about['id_about']; } ?>">

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
              window.location.href = window.location.href;
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