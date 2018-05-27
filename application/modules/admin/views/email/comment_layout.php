<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="col col-md-12 col-sm-12 col-xs-12">
	
<div class="box">
	<?php if($view == 'list'){ ?>
		<div class="box-body">
			<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
				<a href="<?=site_url('admin/email/add_email');?>" class="btn btn-success">Tambah Notifikasi Email</a>
			</div>
			<div class="col col-md-12 col-xs-12">
				<table class="table table-bordered  dataTable" id="example2">
					<thead>
						<th>No</th>
						<th>News</th>
						<th>From</th>
						<th>Email</th>
						<th>Subject</th>
						<th>Action</th>
					</thead>
					<tbody>
					<?php if(!empty($comment)){ foreach ($comment as $key => $value): ?>
						<tr>
							<td><?=($key+1);?></td>
							<td><div class="judul"><?=$value['judul'];?></div></td>
							<td><div class="from"><?=$value['nama'];?></div></td>
							<td><div class="email"><?=$value['email'];?></div></td>
							<td><div class="subject"><?=word_limiter($value['content'],5);?></div></td>
							<td>
								<!-- <button class="btn btn-default">disable</button> -->
								<button class="btn btn-primary btn-sm btn_replay" id="<?=$value['id_comment'];?>">Reply</button>
							</td>
						</tr>
					<?php endforeach; } ?>
					</tbody>
				</table>
				<div class="col col-md-12 col-xs-12 text-right">
					<!-- <a href="#" class="btn btn-default">Setting</a> -->
				</div>
			</div>
		</div>
		<div class="modal" tabindex="-1" role="dialog" id="modal_reply">
	      <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h3 class="modal-title">Success</h3>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body">
	            <form role="form">
			      <div class="form-group">
			        <label>Email to</label>
			        <input type="text" name="subject" class="form-control" style="cursor:not-allowed;pointer-events: none;background-color: #dedede" id="subject" placeholder="Enter Email Destination ..." value="">
			        <div class="error" id="ntf_subject"></div>
			      </div>
			      <!-- textarea -->
			      <div class="form-group">
			        <label>Subject Email</label>
			        <input type="text" class="form-control" name="title" style="cursor:not-allowed;pointer-events: none; background-color: #dedede" id="title" rows="3" placeholder="Enter Subject ..." >
			        <div class="error" id="ntf_title"></div>
			      </div>

			      <div class="form-group">
			      <label>Content</label>
			        <?php echo $this->ckeditor->editor("content", "" ); ?>
			        <input type="hidden" name="content" id="content">
			        <div class="error" id="ntf_content"></div>
			      </div>

			      <button type="button" class="btn btn-primary" id="submit">Submit</button>
			      <div class="error" id="ntf_email"></div>
			    </form>
	          </div>
	          <div class="modal-footer">
	            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          </div>
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
  <?php } } ?>
</div>
	
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript" src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      // console.log($('form').val());
      $('#content').val(CKEDITOR.instances.content.getData());
      // return false;
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
    $('body').on('click','.btn_replay',function(){
    	var email = $(this).parent().parent().find('.email').text();
    	var subject = 'Membalas "'+$(this).parent().parent().find('.subject').text()+'"';
    	$('form #title').val(subject);
    	$('form #subject').val(email);
    	$('#modal_reply').modal('show');
    });
    $('#modalSuccess').modal('show');
  });
</script>