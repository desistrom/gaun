<div class="box">
	<?php if($view == 'list'){ ?>
		<div class="box-body">
			<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
				<a href="<?=site_url('admin/keanggotaan/add_instansi');?>" class="btn btn-success">Tambah Instansi</a>
			</div>
			<div class="col col-md-12 col-xs-12">
				<table class="table table-bordered  dataTable">
					<tr>
						<th>No</th>
						<th>Nama Instansi</th>
						<th>Action</th>
					</tr>
					<?php foreach ($instansi as $key => $value): ?>
						<tr>
							<td><?=($key+1);?></td>
							<td><?=$value['nm_instansi'];?></td>
							<td>
								<button class="btn btn-default btn_delete">disable</button>
								<a href="<?=site_url('admin/keanggotaan/edit_instansi/'.$value['id_instansi']);?>"><button class="btn btn-primary" id="edit">Edit</button></a>
							</td>
						</tr>
					<?php endforeach ?>
				</table>
				<div class="col col-md-12 col-xs-12 text-right">
					<!-- <a href="#" class="btn btn-default">Setting</a> -->
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
					<input type="text" name="nama" class="form-control" id="name" placeholder="Masukan Nama Instansi ..." value="">
					<div class="error" id="ntf_nama"></div>
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
					<input type="text" name="nama" class="form-control" id="name" placeholder="Masukan Nama Instansi ..." value="<?=$instansi['nm_instansi'];?>">
					<div class="error" id="ntf_nama"></div>
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
  });
</script>