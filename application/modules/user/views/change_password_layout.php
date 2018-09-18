<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
    <div class=" title-box">
      <h3>Dashboard</h3>
    </div>

    <div class="box-content">
    	<form>
    		<div class="form-group">
    			<label>Curent Password</label>
    			<input type="password" name="current" class="form-control">
          <div class="error" id="ntf_current"></div>
    			<div class="error" id="ntf_wr"></div>
    		</div>
    		<div class="form-group">
    			<label>New Password</label>
    			<input type="password" name="new" class="form-control">
    			<div class="error" id="ntf_new"></div>
    		</div>
    		<div class="form-group">
    			<label>Re-type New Password</label>
    			<input type="password" name="re" class="form-control">
    			<div class="error" id="ntf_re"></div>
    		</div>
    		<button class="btn btn-info btn_save" type="button">Submit</button>
    	</form>
    </div>
</div>
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
   var base_url = "<?=base_url();?>"
    $(document).ready(function(){
      $('body').on('click','.btn_save', function(){
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
                }
              }else{
              	$('#ntf_current').text('Password Not Match with this account');
              	$('#ntf_current').css({'color':'red', 'font-style':'italic'});
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