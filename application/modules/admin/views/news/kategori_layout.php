<div class="box">
<?php if ($view == 'list') { ?>
<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
	<div class="box-body">
		<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
			<a href="<?=site_url('admin/kategori_news/add');?>" class="btn btn-success">Tambah Kategori News</a>
		</div>
		<div class="col col-md-12 col-xs-12">
			<table class="table table-bordered  dataTable" id="example2">
				<thead>
					<th>No</th>
					<th>Nama Kategori</th>
					<th>Opsi</th>
				</thead>
				<tbody>
        <?php foreach ($kategori as $key => $value): ?>
          <tr>
						<td><?=($key+1);?></td>
						<td><?=$value['nm_kategori'];?></td>
						<td>
							<a href="<?=site_url('admin/kategori_news/edit/'.$value['id_kategori_news']);?>"><button class="btn btn-primary btn-sm" id="edit">Edit</button></a>
							<button class="btn btn-danger btn-sm btn_delete" id="<?=$value['id_kategori_news'];?>">Delete</button>
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
	    <h3 class="box-title">Add Kategori</h3>
	  </div>
	  <!-- /.box-header -->
	  <div class="box-body">
	    <form role="form">
	      <!-- text input -->

	      <div class="form-group">
	        <label>Kategori</label>
	        <input type="text" name="kategori" class="form-control" id="kategori" placeholder="Enter Kategori ..." value="">
	        <div class="error" id="ntf_kategori"></div>
	      </div>

	      <button type="button" class="btn btn-primary" id="submit">Submit</button>
	      <div class="error" id="ntf_email"></div>
	    </form>
	</div>

<?php }else{ ?>

	<div class="box-header with-border">
	    <h3 class="box-title">Edit Kategori</h3>
	  </div>
	  <!-- /.box-header -->
	  <div class="box-body">
	    <form role="form">
	      <!-- text input -->

	      <div class="form-group">
	        <label>Kategori</label>
	        <input type="text" name="kategori" class="form-control" id="kategori" placeholder="Enter Kategori ..." value="<?=$kategori['nm_kategori'];?>">
	        <div class="error" id="ntf_kategori"></div>
	      </div>

	      <button type="button" class="btn btn-primary" id="submit">Submit</button>
	      <div class="error" id="ntf_email"></div>
	    </form>
	</div>

<?php } ?>
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

    $('body').on('click','.btn_delete', function(){
    	var id = $(this).attr('id');
    	console.log(id);
    	if (confirm("Ingin menhapus data ini ?")) {
    		$('#progresLoading').modal('show');
	    	$.ajax({
	          url : base_url+"admin/kategori_news/delete/"+id,
	          dataType : 'json',
	          type : 'post',
	          data : {'id' : id},
	          async : false
	      	}).done(function(data){
	      	setTimeout(function(){  
		      	$('#progresLoading').modal('hide');
		      	console.log(data);
		        window.location.href = window.location.href;
	        }, 3000);
	      });
  		}
    });
    $('#modalSuccess').modal('show');
    });
</script>