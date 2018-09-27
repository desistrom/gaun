<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="box">
	<div class="box-body">
		<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
			<a href="<?=site_url('admin/pengguna/report');?>" class="btn btn-success"><i class="fa fa-table"></i> Download report</a>
		</div>
		<div class="col col-md-12 col-xs-12 table-responsive">
	<table class="table table-bordered  dataTable" id="table">
		<thead>
			<th>No</th>
			<th>Nama User</th>
			<th>Email</th>
			<th>No Hp</th>
			<th>Action</th>
		<thead>
		<tbody>
		<?php foreach ($user as $key => $value): ?>
			<tr>
				<td><?=($key+1);?></td>
				<td id="<?=$value['id_pengguna'];?>" class="detail"><span style="color:blue;"><u><?=$value['nama'];?></u></span></td>
				<td><?=$value['email'];?></td>
				<td><?=$value['no_hp'];?></td>
				<td><a class="btn btn-primary btn-sm" href="<?=site_url('admin/pengguna/reset').'/'.$value['id_pengguna'];?>">Reset</a></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<div class="col col-md-12 col-xs-12 text-right">
		<!-- <a href="#" class="btn btn-default">Setting</a> -->
	</div>
</div>
	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="detail_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
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
		<?php } ?>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		var base_url = '<?=base_url();?>';
		$('body').on('click','.detail',function(){
			var id = $(this).attr('id');
			$.ajax({
		          url : base_url+'admin/pengguna/detail/'+id,
		          dataType : 'json',
		          type : 'POST',
		          data : $('form').serialize()
		      }).done(function(data){
		          console.log(data);
		          $('#detail_modal .modal-body').html(data);
		          $('#detail_modal').modal('show');
		      });
		});
	    $('#modalSuccess').modal('show');
  });
</script>
<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable();
 
});
</script>