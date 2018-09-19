<style type="text/css">
	.form-goup-file{
    height: auto;
    overflow: hidden;
    padding: 0;
  }
  .form-goup-file div{
    display: inline-block;
  }
  .form-goup-file .input-file-left{
    width: 100%;
  }
  .form-goup-file .input-file-left input{
  width: 100%;
  }
  .form-goup-file .input-file-right{
    position: absolute;
    left: 0;
    top: 0;
  }
  .form-goup-file .input-file-right .btn-choose-foto{
    height: 34px;
    width: 105px;
    border-radius: 0;
    padding-left: 7px;
  }
  .logo-fav{
    width: 100px;
  }
  .fa-upload{
    padding-right: 10px;
  }
</style>
<div class="col col-md-12 col-sm-12 col-xs-12">
	
<div class="box">
	<?php if($view == 'list'){ ?>
		<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
		<div class="box-body">
			<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
				<!-- <a href="<?=site_url('admin/keanggotaan/add_instansi');?>" class="btn btn-success">Tambah Instansi</a> -->
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
						<th>Visible</th>
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
		<?php }elseif($view == 'add'){ ?>
		<div class="box-header with-border">
			<h3 class="box-title">Add Instansi</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<form role="form">
				<!-- text input -->
				<div class="form-group">
					<label>Nama Instansi</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Masukan Nama Instansi ..." value="">
					<div class="error" id="ntf_name"></div>
				</div>
				<div class="form-group">
			      <label>website</label>
			        <input type="text" class="form-control" name="website" id="website" value="" placeholder="Enter Link Website ...">
			        <div class="error" id="ntf_website"></div>
			      </div>

			     <div class="form-group">
			      <label>Email</label>
			        <input type="text" class="form-control" name="email" id="email" value="" placeholder="Enter Link Website ...">
			        <div class="error" id="ntf_email"></div>
			      </div>

			      <div class="form-group">
			      <label>Kategori Instansi</label>
			      	<select name="jenis" id="jenis" class="form-control">
			      		<option value="">-- Select Kategori --</option>
			      		<?php foreach ($kategori as $key => $value): ?>
			      			<option value="<?=$value['id_jenis_instansi'];?>"><?=$value['nm_jenis_instansi'];?></option>
			      		<?php endforeach ?>
			      	</select>
			        <div class="error" id="ntf_jenis"></div>
			      </div>

			      <div class="form-group">
			      <label>Phone Number</label>
			        <input type="text" class="form-control" name="phone" id="phone" value="" placeholder="Enter Phone Number ...">
			        <div class="error" id="ntf_phone"></div>
			      </div>
			      <div class="form-group">
			      	<label>Alamat Instansi</label>
			      	<textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat ...."></textarea>
			      	<div class="error" id="ntf_alamat"></div>
			      </div>
			      <div class="form-group">
			        <label>Username</label>
			        <input type="texr" class="form-control" name="username" id="username" rows="3" placeholder="Enter Username ..." >
			        <div class="error" id="ntf_username"></div>
			      </div>

			      <div class="form-group">
			      <label>Password</label>
			        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter Password ...">
			        <div class="error" id="ntf_password"></div>
			      </div>

			      <div class="form-group">
			      <label>Re type Password</label>
			        <input type="password" class="form-control" name="repassword" id="repassword" value="" placeholder="Enter Re type Password ...">
			        <div class="error" id="ntf_repassword"></div>
			      </div>
			       <div class="form-group">
			            <label>Logo Instansi</label>
			            <div class="col col-md-12 form-goup-file">
			              <div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="userfile"><i class="fa fa-upload" ></i>Choose File</label></div>
			              <div class="input-file-left"><input type="file" class="form-control file" name="userfile" id="userfile"></div>
			              <div><i>*for best result use 450x240 px. <br> Max file size 400KB, Width 200px - 1024px. <br>Allowed file type : jpeg, jpg, png, gif.</i></div> 
			              <div class="error" id="ntf_userfile"></div>
			              <div class="error" id="ntf_error"></div> 
			            </div>
			      </div>
			      <!-- <div class="form-group">
			      <label>Logo Instansi</label>
			        <input type="file" class="form-control" name="userfile" id="userfile">
			        <div class="error" id="ntf_userfile"></div>
			        <div class="error" id="ntf_error"></div>
			      </div> -->
			      <div class="form-group">
			      <label>Urutan</label>
			        <input type="number" class="form-control" name="sort" id="sort" value="" placeholder="">
			        <div class="error" id="ntf_sort"></div>
			      </div>
				<button type="button" class="btn btn-primary" id="submit">Submit</button>
			</form>
		</div>
	<?php }else{ ?>
		<div class="box-header with-border">
			<h3 class="box-title">Edit Instansi</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<form role="form">
				<!-- text input -->
				<div class="form-group">
					<label>Nama Instansi</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Masukan Nama Instansi ..." value="<?=$instansi['nm_instansi'];?>">
					<div class="error" id="ntf_name"></div>
				</div>
				<div class="form-group">
			      <label>website</label>
			        <input type="text" class="form-control" name="website" id="website" value="<?=$instansi['website'];?>" placeholder="Enter Link Website ...">
			        <div class="error" id="ntf_website"></div>
			      </div>

			      <div class="form-group">
			      <label>Email</label>
			        <input type="text" class="form-control" name="email" id="email" value="<?=$instansi['email'];?>" placeholder="Enter Link Website ...">
			        <div class="error" id="ntf_email"></div>
			      </div>

			      <div class="form-group">
			      <label>Kategori Instansi</label>
			      	<select name="jenis" id="jenis" class="form-control">
			      		<option value="">-- Select Kategori --</option>
			      		<?php foreach ($kategori as $key => $value): ?>
			      			<option <?php if($value['id_jenis_instansi'] == $instansi['id_jenis_instansi']){ ?> selected <?php } ?> value="<?=$value['id_jenis_instansi'];?>"><?=$value['nm_jenis_instansi'];?></option>
			      		<?php endforeach ?>
			      	</select>
			        <div class="error" id="ntf_jenis"></div>
			      </div>

			      <div class="form-group">
			      <label>Phone Number</label>
			        <input type="text" class="form-control" name="phone" id="phone" value="<?=$instansi['phone'];?>" placeholder="Enter Phone Number ...">
			        <div class="error" id="ntf_phone"></div>
			      </div>

			      <div class="form-group">
			      	<label>Alamat Instansi</label>
			      	<textarea class="form-control" id="alamat" name="alamat"><?=$instansi['alamat'];?></textarea>
			      	<div class="error" id="ntf_alamat"></div>
			      </div>
			      <div class="form-group">
			            <label>Logo Instansi</label>
			            <div class="col col-md-12 form-goup-file">
			              <div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="userfile"><i class="fa fa-upload" ></i>Choose File</label></div>
			              <div class="input-file-left"><input type="file" class="form-control file" name="userfile" id="userfile"></div> 
			              <div><i>*for best result use 450x240 px. <br> Max file size 400KB, Width 200px - 1024px. <br>Allowed file type : jpeg, jpg, png, gif.</i></div> 
			              <div class="error" id="ntf_userfile"></div>
			              <div class="error" id="ntf_error"></div> 
			            </div>
			      </div>
			      <!-- <div class="form-group">
			      	<label>Logo Instansi</label>
			        <input type="file" class="form-control" name="userfile" id="userfile">
			        <div class="error" id="ntf_userfile"></div>
			        <div class="error" id="ntf_error"></div>
			      </div> -->

			      <?php if ($instansi['gambar'] != ''): ?>
			      	<img width="450px" src="<?=base_url().'media/'.$instansi['gambar'];?>">
			      <?php endif ?>

			      <div class="form-group">
			      <label>Urutan</label>
			        <input type="number" class="form-control" name="sort" id="sort" value="<?=$instansi['sort'];?>" placeholder="">
			        <div class="error" id="ntf_sort"></div>
			      </div>
				<button type="button" class="btn btn-primary" id="submit">Submit</button>
			</form>
		</div>
	<?php } ?>
</div>
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      var form_data = new FormData();
      var data_file = $('#userfile').prop('files')[0];
      form_data.append('userfile',data_file);
      form_data.append('name',$('#name').val());
      form_data.append('website',$('#website').val());
      form_data.append('phone',$('#phone').val());
      form_data.append('alamat',$('#alamat').val());
      form_data.append('email',$('#email').val());
      form_data.append('jenis',$('#jenis').val());
      form_data.append('username',$('#username').val());
      form_data.append('password',$('#password').val());
      form_data.append('repassword',$('#repassword').val());
      form_data.append('sort',$('#sort').val());
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

    $('body').on('click','.btn_active',function(){
    	var id = $(this).attr('id');
    	$('#progresLoading').modal('show');
    	console.log(id);
    	$.ajax({
          url : base_url+"admin/keanggotaan/active_instansi/"+id,
          dataType : 'json',
          type : 'POST',
          data : {'id' : id},
          // async : false
      }).done(function(data){
      	setTimeout(function(){  
	      	// console.log(data);
	      	if(data.status == 1){
	      		$('#progresLoading').modal('hide');
		        window.location.href = data.url;
		    }
        }, 2000);
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
            "url": "<?php echo site_url('admin/keanggotaan/ajax_list')?>",
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