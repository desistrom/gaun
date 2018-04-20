<div class="box">
<?php if ($view == 'list') { ?>
	<div class="box-body">
		<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
			<a href="<?=site_url('admin/news/add');?>" class="btn btn-success">Tambah News</a> | <a href="<?=site_url('admin/news/get_rss');?>" class="btn btn-info">Get rss</a>
		</div>
		<div class="col col-md-12 col-xs-12">
			<table class="table table-bordered  dataTable" id="example2">
				<thead>
					<th>No</th>
					<th>Judul</th>
					<th>Content</th>
					<th>Kategori</th>
					<th>Create Date</th>
					<th>Opsi</th>
				</thead>
				<tbody>
        <?php foreach ($news as $key => $value): ?>
          <tr>
						<td><?=($key+1);?></td>
						<td><?=$value['judul'];?></td>
						<td><?=word_limiter($value['content'], 12);?></td>
						<td><?=$value['nm_kategori'];?></td>
						<td><?=$value['created'];?></td>
						<td>
							<!-- <button class="btn btn-default">disable</button> -->
							<a href="<?=site_url('admin/news/edit/'.$value['id_news']);?>"><button class="btn btn-primary" id="edit">Edit</button></a>
						</td>
          </tr>
        <?php endforeach; ?>
				</tbody>
			</table>
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
<?php }elseif ($view == 'add') { ?>
	<div class="box-header with-border">
    <h3 class="box-title">Add News</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- text input -->
      <div class="form-group">
        <label>Judul Berita</label>
        <input type="text" name="judul" class="form-control" id="judul" placeholder="Enter Judul Berita ..." value="">
        <div class="error" id="ntf_judul"></div>
      </div>
      <div class="form-group">
        <label>Gambar Berita</label>
        <input type="file" name="file_name" class="form-control" id="file_name">
        <div class="error" id="ntf_file_name"></div>
      </div>
      <!-- textarea -->
      <div class="form-group">
        <label>Kategori Berita</label>
        <select class="form-control" name="kategori" id="kategori" >
        	<option value="">-- Pilih Kategori --</option>
        	<?php foreach ($kategori as $key => $value): ?>
        		<option value="<?=$value['id_kategori_news'];?>"><?=$value['nm_kategori'];?></option>
        	<?php endforeach ?>
        </select>
        <div class="error" id="ntf_kategori"></div>
      </div>

      <div class="form-group">
      <label>Content News</label>
      <?php echo $this->ckeditor->editor("content", "" ); ?>
        <input type="hidden" name="content" id="content">
        <div class="error" id="ntf_content"></div>
      </div>

      <button type="button" class="btn btn-primary" id="submit">Submit</button>

    </form>
  </div>
<?php }else{ ?>
	<div class="box-header with-border">
    <h3 class="box-title">Edit News</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- text input -->
      <div class="form-group">
        <label>Judul Berita</label>
        <input type="text" name="judul" class="form-control" id="judul" placeholder="Enter Judul Berita ..." value="<?=$news['judul'];?>">
        <div class="error" id="ntf_judul"></div>
      </div>
      <div class="form-group">
        <label>Gambar Berita</label>
        <input type="file" name="file_name" class="form-control" id="file_name">
        <div class="error" id="ntf_file_name"></div>
      </div>
      <!-- textarea -->
      <div class="form-group">
        <label>Kategori Berita</label>
        <select class="form-control" name="kategori" id="kategori" >
        	<option value="">-- Pilih Kategori --</option>
        	<?php foreach ($kategori as $key => $value): ?>
        		<option <?php if ($news['id_kategori_ref'] == $value['id_kategori_news']){ ?> selected <?php } ?> value="<?=$value['id_kategori_news'];?>"><?=$value['nm_kategori'];?></option>
        	<?php endforeach ?>
        </select>
        <div class="error" id="ntf_kategori"></div>
      </div>

      <div class="form-group">
      <label>Content News</label>
      <?php echo $this->ckeditor->editor("content", $news['content'] ); ?>
        <input type="hidden" name="content" id="content">
        <div class="error" id="ntf_content"></div>
      </div>

      <button type="button" class="btn btn-primary" id="submit">Submit</button>

    </form>
  </div>
<?php } ?>
	
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      var form_data = new FormData();
      var file_data = $('#file_name').prop('files')[0];
      $('#content').val(CKEDITOR.instances.content.getData());
      form_data.append('judul', $('#judul').val());
      form_data.append('kategori', $('#kategori').val());
      form_data.append('content', $('#content').val());
      form_data.append('file_name', file_data);
      $.ajax({
          url : window.location.href,
          dataType : 'json',
          type : 'POST',
          data : form_data,
          async : false,
          cache : false ,
          contentType : false , 
          processData : false
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