<div class="col col-md-12 col-sm-12 col-xs-12">
  
<div class="box">
<div class="box-header with-border">
	    <h3 class="box-title">Title Website</h3>
	  </div>
	  <!-- /.box-header -->
	  <div class="box-body">
	    <form role="form">
	      <!-- text input -->

	      <div class="form-group">
	        <label>Title</label>
	        <input type="text" name="content" class="form-control" id="content" placeholder="Enter Title" value="<?=$title['title'];?>">
	        <div class="error" id="ntf_content"></div>
	      </div>
	      <input type="hidden" name="id" value="<?php if(isset($title)){ echo $title['id_logo']; } ?>">
	      <button type="button" class="btn btn-primary" id="submit">Submit</button>
	    </form>
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
</div>
  
</div>

<div class="modal fade" id="progresLoading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-body">
                  <div class="box box-danger">
                      <div class="box-header">
                      </div>
                      <div class="box-body">
                      </div>
                      <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                      </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
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
    $('#modalSuccess').modal('show');
    });
</script>