<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="col col-md-12 col-sm-12 col-xs-12">
	<div class="box">
	<div class="box-body">
		<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
			<a href="<?=site_url('admin/galery/add_image');?>"><button class="btn btn-success">Tambah Gambar</button></a>
		</div>
		<table class="table table-bordered  dataTable" id="example2">
			  <thead>
			  	<th>No</th>
			  	<th>judul</th>
			  	<th>Deskripsi</th>
			  	<th>Gambar</th>
			  	<th>Aksi</th>
			  </thead>
			  <tbody>
			  	<?php foreach ($galery as $key => $value): ?>

				  <tr id="tr_<?=$value['id_galery'];?>">
				  	<td><?=($key+1);?></td>
				  	<td><?=$value['judul'];?></td>
				  	<td><?=$value['deskripsi'];?></td>
				  	<td><img src="<?=base_url().'assets/media/'.$value['file_name'];?>" width="144px" /></td>
				  	<td>
				  		<!-- <a href="<?=site_url('admin/galery/preview');?>"><button class="btn btn-default">Preview</button></a> -->
				  		<a href="<?=site_url('admin/galery/edit_image').'/'.$value['id_galery'];?>" data-toggle="tooltip" title="Edit"><button class="btn btn-info"><i class="fa fa-pencil"></i></button></a>
				  		<button class="btn btn-danger hapus" id="<?=$value['id_galery'];?>" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
				  	</td>
				  </tr>

			  	<?php endforeach ?>
			  </tbody>
			</table>
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
    $('body').on('click','.hapus', function(){
    	var id = $(this).attr('id');
    	if(confirm('Anda ingin Menghapusnya ??')){
	    	$.ajax({
	    		url : '<?=site_url('admin/galery/delete');?>',
		        type : 'POST',
		        dataType : 'json',
		        data : {'id': id , 'tipe':'gambar'}
	    	}).done(function(data){
	    		console.log(data);
	    		if (data.state == 1) {
	    			$('#tr_'+id).hide(1000);
	    			window.location.href = data.url;
	    		}
	    	});
	    }
    });
    $('#modalSuccess').modal('show');
  });
  </script>