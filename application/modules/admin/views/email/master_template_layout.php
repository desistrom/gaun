<style type="text/css">
  .table .thead{
  border-bottom:solid #F4F4F4 3px;
  }
</style>
<div class="col col-md-12 col-sm-12 col-xs-12">
<div class="box">
	<?php if($view == 'list'){ ?>
		<div class="box-body">
			<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
				<!-- <a href="<?=site_url('admin/email/add_kategori');?>" class="btn btn-success">Tambah Notifikasi Email</a> -->
			</div>
			<div class="col col-md-12 col-xs-12">
				<table class="table table-bordered  dataTable">
					<tr class="thead">
						<th>No</th>
						<th>Kategori</th>
            <th>Action</th>
					</tr>
					<?php foreach ($kategori as $key => $value): ?>
						<tr>
							<td><?=($key+1);?></td>
							<td><?=$value['nm_kategori'];?></td>
							<td>
								<!-- <button class="btn btn-default">disable</button> -->
								<a href="<?=site_url('admin/email/edit_template/'.$value['id_kategori_email']);?>" data-toggle="tooltip" title="Edit"><button class="btn btn-info" id="edit"><i class="fa fa-pencil"></i></button></a>
							</td>
						</tr>
					<?php endforeach ?>
				</table>
				<div class="col col-md-12 col-xs-12 text-right">
					<!-- <a href="#" class="btn btn-default">Setting</a> -->
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
	<?php }else{ ?>

		<div class="box-header with-border">
		    <h3 class="box-title">Edit Template</h3>
		  </div>
		  <!-- /.box-header -->
		  <div class="box-body">
		    <form role="form">
		      <!-- text input -->

		      <div class="form-group">
		        <label>Template</label>
		        <textarea class="form-control" name="template" id="template" rows="20"><?php if ($kategori['source_code'] != '') {
		        	echo $kategori['source_code'];
		        } ?></textarea>
		      </div>

		      <button type="button" class="btn btn-primary" id="submit">Submit</button>
		      <div class="error" id="ntf_email"></div>
		    </form>
		  </div>

	<?php } ?>
</div>
  
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript" src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      // console.log($('form').val());
      // $('#content').val(CKEDITOR.instances.content.getData());
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
    $('#modalSuccess').modal('show');
  });
</script>