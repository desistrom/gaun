<div class="col col-md-12 col-sm-12 col-xs-12">
<div class="box">
	<div class="box-header with-border">
	    <h3 class="box-title">Setting Email</h3>
	</div>
	  <!-- /.box-header -->
	<div class="box-body">
	    <form role="form">
		    <div class="form-group">
		        <label>Email Pengirim</label>
		        <input type="text" name="email" class="form-control" id="email" placeholder="Enter Kategori ..." value="<?=$email['email'];?>">
		        <div class="error" id="ntf_email"></div>
		    </div>

		    <div class="form-group">
		        <label>Nama Pengirim</label>
		        <input type="text" name="nama" class="form-control" id="nama" placeholder="Enter Kategori ..." value="<?=$email['nama_user'];?>">
		        <div class="error" id="ntf_nama"></div>
		    </div>

		    <button type="button" class="btn btn-primary" id="submit">Submit</button>
	    </form>
	</div>
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
    $('#modalSuccess').modal('show');
    
  });
</script>