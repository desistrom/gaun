<div class="col col-md-12 col-sm-12 col-xs-12">
	<div class="box">
	<div class="box-body">
		<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
			<a href="<?=site_url('admin/galery/add_video');?>"><button class="btn btn-success">Tambah video</button></a>
		</div>
		<table class="table table-bordered  dataTable">
			  <thead>
			  	<th>No</th>
			  	<th>judul</th>
			  	<th>Deskribsi</th>
			  	<th>Aksi</th>
			  </thead>
			  <tbody>
			  	<?php foreach ($galery as $key => $value): ?>

				  <tr id="tr_<?=$value['id_galery'];?>">
				  	<td><?=($key+1);?></td>
				  	<td><?=$value['judul'];?></td>
				  	<td><?=$value['deskripsi'];?></td>
				  	<td>
				  		<!-- <a href="<?=site_url('admin/galery/preview');?>"><button class="btn btn-default">Preview</button></a> -->
				  		<a href="<?=site_url('admin/galery/edit_video').'/'.$value['id_galery'];?>"><button class="btn btn-primary">Edit</button></a>
				  		<button class="btn btn-danger hapus" id="<?=$value['id_galery'];?>">Hapus</button>
				  	</td>
				  </tr>

			  	<?php endforeach ?>
			  </tbody>
			</table>
	</div>
</div>
</div>
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
		        data : {'id': id }
	    	}).done(function(data){
	    		console.log(data);
	    		if (data == 1) {
	    			$('#tr_'+id).hide(1000);
	    		}
	    	});
	    }
    });
  });
  </script>