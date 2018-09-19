<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
    <div class=" title-box">
      <h3>Profil</h3>
    </div>

    <div class="box-content">
    	<form>
    		<div class="form-group">
    			<label>Nama Lengkap</label>
    			<input type="text" name="nama" class="form-control" value="<?=$user['nama'];?>">
          <div class="error" id="ntf_nama"></div>
    		</div>
    		<div class="form-group">
    			<label>Jenis Kelamin</label>
    			<select class="form-control" name="jk">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option <?php if ($user['jeniskelamin'] == 'L'): ?> selected <?php endif ?> value="L">Laki - Laki</option>   
            <option <?php if ($user['jeniskelamin'] == 'P'): ?> selected <?php endif ?> value="P">Perempuan</option>   
          </select>
    			<div class="error" id="ntf_jk"></div>
    		</div>
    		<div class="form-group">
    			<label>Nomor HP</label>
    			<input type="text" name="hp" class="form-control" value="<?=$user['no_hp'];?>">
    			<div class="error" id="ntf_hp"></div>
    		</div>
        <div class="form-group">
          <label>Alamat</label>
          <textarea class="form-control" name="alamat"><?=$user['alamat'];?></textarea>
          <div class="error" id="ntf_alamat"></div>
        </div>
        <div class="form-group">
          <label>Instansi</label>
          <select class="form-control" name="instansi">
            <option value="">-- Pilih Instansi --</option> 
            <?php foreach ($instansi as $key => $value): ?>
              <option <?php if ($user['instansi'] == $value['id_instansi']): ?> selected <?php endif ?>  value="<?=$value['id_instansi'];?>"><?=$value['nm_instansi'];?></option>   
            <?php endforeach ?>
          </select>
          <div class="error" id="ntf_instansi"></div>
        </div>
        <?php if ($role == 'tb_mahasiswa'): ?>
          <div class="form-group">
          <label>Tahun Angkatan</label>
          <input type="number" name="angkatan" class="form-control" value="<?=$user['angkatan'];?>">
          <div class="error" id="ntf_angkatan"></div>
        </div>
        <div class="form-group">
          <label>Jurusan</label>
          <input type="text" name="jurusan" class="form-control" value="<?=$user['jurusan'];?>">
          <div class="error" id="ntf_jurusan"></div>
        </div>
        <?php endif ?>
    		<button class="btn btn-info btn_save" type="button">Submit</button>
    	</form>
    </div>
</div>
<div id="regSukses" class="modal fade modal-register" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center" style="color:#CF090A; ">Success</h2>
          </div>
          <div class="modal-body">
            <p class="text-center">Update Profil Berhasil</p>
          </div>
        </div>
      </div>
    </div>
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
   var base_url = "<?=base_url();?>"
    $(document).ready(function(){
      $('body').on('click','.btn_save', function(){
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
                }
              }else{
              	$('#ntf_current').text('Password Not Match with this account');
              	$('#ntf_current').css({'color':'red', 'font-style':'italic'});
              }
            $.each(data.notif,function(key,value){
            $('.error').show();
            $('#ntf_'+ key).html(value);
            $('#ntf_'+ key).css({'color':'red', 'font-style':'italic'});
            });
      });
    });
      <?php if($this->session->flashdata("notif") != ''){ ?>
          $('#regSukses').modal('show');
        <?php } ?>
    });
 </script>