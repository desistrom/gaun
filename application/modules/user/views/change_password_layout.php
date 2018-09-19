<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
    <div class=" title-box">
      <h3>Dashboard</h3>
    </div>

    <div class="box-content">
    	<form>
    		<div class="form-group">
    			<label>Current Password</label>
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
<div id="regSukses" class="modal fade modal-register" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center" style="color:#CF090A; ">Success</h2>
          </div>
          <div class="modal-body">
            <p class="text-center">Change Password Berhasil</p>
          </div>
        </div>
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
      <?php if($this->session->flashdata("notif") != ''){ ?>
          $('#regSukses').modal('show');
        <?php } ?>
    });
 </script>