<div class="col col-md-12 col-sm-12 col-xs-12">
	
<div class="box">
		<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
		<div class="box-body">
			<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
				<a href="<?=site_url('admin/keanggotaan/add_instansi');?>" class="btn btn-success">Tambah Instansi</a>
			</div>
			<div class="col col-md-12 col-xs-12 table-responsive">
				<table class="table table-bordered  dataTable" id="table">
					<thead>
						<th>No</th>
						<th>Jenis Instansi</th>
						<th>Nama Instansi</th>
						<th>email</th>
						<th>status</th>
						<th>Urutan</th>
						<th>Action</th>
					</thead>
					<tbody>
					</tbody>
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
<div class="modal" tabindex="-1" role="dialog" id="detail_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Instansi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','.status', function(){
    	var id = $(this).attr('id');
    	$('#progresLoading').modal('show');
    	console.log(id);
    	$.ajax({
          url : base_url+"admin/keanggotaan/status_instansi",
          dataType : 'json',
          type : 'POST',
          data : {'id' : id},
          async : false
      }).done(function(data){
      	setTimeout(function(){
	      	$('#progresLoading').modal('hide');
	      	console.log(data);
	        window.location.href = data.url;
        }, 3000);
      });
    });

    $('body').on('click','.btn_detail',function(){
    	var id = $(this).attr("id");
    	$('#progresLoading').modal('show');
    	$.ajax({
          url : base_url+"admin/keanggotaan/detail_instansi",
          dataType : 'json',
          type : 'POST',
          data : {'id' : id}
      }).done(function(data){
    	setTimeout(function(){  
	      	$('#progresLoading').modal('hide');
	      	console.log(data);
	      	$('#detail_modal .modal-body').html(data);
	      	$('#detail_modal').modal('show');
      	}, 3000);
        // window.location.href = data.url;
      });
    });

    $('body').on('click','.btn_delete', function(){
    	var id = $(this).attr('id');
    	console.log(id);
    	if (confirm("Ingin menhapus data ini ?")) {
    		$('#progresLoading').modal('show');
	    	$.ajax({
	          url : base_url+"admin/keanggotaan/delete_instansi",
	          dataType : 'json',
	          type : 'POST',
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
<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/keanggotaan/ajax_list_request/'.$id)?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});
</script>