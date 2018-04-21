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
						<th>email</th>
						<th>status</th>
						<th>Action</th>
					</thead>
					<tbody>
					<?php foreach ($instansi as $key => $value): ?>
						<tr>
							<td><?=($key+1);?></td>
							<td><?=$value['nm_instansi'];?></td>
							<td><?=$value['email'];?></td>
							<td><?php if($value['status'] == 0){ ?> <span class="text-info">Not Actived</span> <?php }elseif($value['status']==1){ ?> <span class="text-primary">On Proces</span> <?php }else{ ?> <span class="text-success">Active</span> <?php } ?></td>
							<td>
								<!-- <button class="btn btn-default btn_delete">disable</button> -->
								<a href="<?=site_url('admin/keanggotaan/edit_instansi/'.$value['id_instansi']);?>"><button class="btn btn-primary btn-sm" id="edit">Edit</button></a> <a href="#"><button class="btn btn-info status btn-sm" id="<?=$value['status'];?>##<?=$value['id_instansi'];?>"><?php if($value['status'] == 0){ ?> Proses <?php }elseif($value['status']==1){ ?> Done <?php }else{ ?> Active <?php } ?></button></a> <button class="btn btn-info btn_detail btn-sm" id="<?=$value['id_instansi'];?>"> Detail </button>
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
			      <label>Emial</label>
			        <input type="text" class="form-control" name="email" id="email" value="" placeholder="Enter Link Website ...">
			        <div class="error" id="ntf_email"></div>
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
			      <label>Email</label>
			        <input type="text" class="form-control" name="email" id="email" value="<?=$instansi['email'];?>" placeholder="Enter Link Website ...">
			        <div class="error" id="ntf_email"></div>
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
      form_data.append('email',$('#email').val());
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

    $('#modalSuccess').modal('show');
    
  });
</script>