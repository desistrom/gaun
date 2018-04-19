<div class="box">
	<?php if($view == 'list'){ ?>
		<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
		<div class="box-body">
			<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
				<a href="<?=site_url('admin/keanggotaan/add_instansi');?>" class="btn btn-success">Tambah Instansi</a>
			</div>
			<div class="col col-md-12 col-xs-12">
				<table class="table table-bordered  dataTable" id="example2">
					<thead>
						<th>No</th>
						<th>Nama Instansi</th>
						<th>Image</th>
						<th>Action</th>
					</thead>
					<tbody>
					<?php foreach ($instansi as $key => $value): ?>
						<tr>
							<td><?=($key+1);?></td>
							<td><?=$value['nm_instansi'];?></td>
							<td><img src="<?=base_url().'media/thumbnail/'.$value['gambar'];?>"></td>
							<td>
								<!-- <button class="btn btn-default btn_delete">disable</button> -->
								<a href="<?=site_url('admin/keanggotaan/edit_instansi/'.$value['id_instansi']);?>"><button class="btn btn-primary" id="edit">Edit</button></a>
							</td>
						</tr>
					<?php endforeach; ?>
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
			        <input type="file" class="form-control" name="userfile" id="userfile">
			        <div class="error" id="ntf_userfile"></div>
			        <div class="error" id="ntf_error"></div>
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
			        <label>Username</label>
			        <input type="texr" class="form-control" name="username" id="username" rows="3" placeholder="Enter Username ..." value="<?=$instansi['username'];?>"  >
			        <div class="error" id="ntf_username"></div>
			      </div>

			      <div class="form-group">
			      <label>Password</label>
			        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter Password ..." value="<?=$instansi['password'];?>">
			        <div class="error" id="ntf_password"></div>
			      </div>

			      <div class="form-group">
			      <label>Re type Password</label>
			        <input type="password" class="form-control" name="repassword" id="repassword" value="" placeholder="Enter Re type Password ..." value="<?=$instansi['password'];?>">
			        <div class="error" id="ntf_repassword"></div>
			      <div class="form-group">
			      <label>Logo Instansi</label>
			        <input type="file" class="form-control" name="userfile" id="userfile">
			        <div class="error" id="ntf_userfile"></div>
			        <div class="error" id="ntf_error"></div>
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
      var data_file = $('#userfile').prop('files')[0];
      form_data.append('userfile',data_file);
      form_data.append('name',$('#name').val());
      form_data.append('website',$('#website').val());
      form_data.append('phone',$('#phone').val());
      form_data.append('alamat',$('#alamat').val());
      form_data.append('username',$('#username').val());
      form_data.append('password',$('#password').val());
      form_data.append('repassword',$('#repassword').val());
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