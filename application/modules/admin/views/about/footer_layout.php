<div class="box">
	<div class="box-header with-border">
	    <h3 class="box-title">Setting footer</h3>
	</div>
	  <!-- /.box-header -->
	<div class="box-body">
	    <form role="form">
		    <div class="form-group">
		        <label>Alamat</label>
		        <?php echo $this->ckeditor->editor("alamat", $footer['alamat'] ); ?>
		        <input type="hidden" name="alamat" id="alamat" value="">
		        <div class="error" id="ntf_alamat"></div>
		    </div>

		    <div class="form-group">
		        <label>Alamat Ke - 2</label>
		        <?php echo $this->ckeditor->editor("alamat2", $footer['alamat2'] ); ?>
		        <input type="hidden" name="alamat2" id="alamat2" value="">
		        <div class="error" id="ntf_alamat2"></div>
		    </div>

		    <div class="form-group">
		        <label>Link Facebook</label>
		        <input type="text" name="facebook" class="form-control" id="facebook" placeholder="Enter Link Facebook ..." value="<?=$footer['facebook'];?>">
		        <div class="error" id="ntf_facebook"></div>
		    </div>

		    <div class="form-group">
		        <label>Link Twitter</label>
		        <input type="text" name="twitter" class="form-control" id="twitter" placeholder="Enter Link Twitter ..." value="<?=$footer['twitter'];?>">
		        <div class="error" id="ntf_twitter"></div>
		    </div>

		    <div class="form-group">
		        <label>Link Instagram</label>
		        <input type="text" name="instagram" class="form-control" id="instagram" placeholder="Enter Link Instagram ..." value="<?=$footer['instagram'];?>">
		        <div class="error" id="ntf_instagram"></div>
		    </div>

		    <button type="button" class="btn btn-primary" id="submit">Submit</button>
	    </form>
	</div>
</div>
<?php if ($this->session->flashdata('notif') != '') { ?>
		<div class="modal" tabindex="-1" role="dialog" id="modalSuccess">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title">Success</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p><?=$this->session->flashdata('notif');?></p>
		      </div>
		      <div class="modal-footer">
		        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<?php } ?>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript" src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
  	// console.log();
  	$('#alamat').val(CKEDITOR.instances.alamat.getData());
  	$('#alamat2').val(CKEDITOR.instances.alamat2.getData());
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
    $('#modalSuccess').modal('show');
    
  });
</script>