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
  .box-content{
    background-color: transparent;
  }
  .panel-header{
     border-bottom: solid 1px #A8A8A8;
    padding-left: 15px;
  }
  .btn-bg{
      }
  #cke_references{
    width: 100%!important;
  }
  .btn-create-new{
    float: right;
    border-radius: 4px;
    padding: 3px 10px;

  }
  .form-group{
    height: auto;
    overflow: hidden;
  }
</style>
<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="col col-md-12 col-sm-12 col-xs-12 right-content" style="padding: 0 30px;">
    <div class=" title-box">
		<h3 class="title">Artikel</h3>
    </div>
    <div class="box-content">
    	<div class="row">
    	<?php if($view == 'list'){ ?>
      <a href="<?=site_url('user/journal/add_artikel');?>" class="btn btn-warning btn-bg" style="margin-bottom: 15px;"><i class="fa fa-plus"></i> Add Artikel</a>
    		<div class="table-responsive">
    			<table class="table table-striped" id="table">
    				<thead>
    					<th>No.</th>
    					<th>Judul Artikel</th>
    					<th>No. Journal</th>
    					<th>Volume</th>
    					<th>Journal</th>
    					<th>Status</th>
    					<th>Action</th>
    				</thead>
    				<tbody>
    					
    				</tbody>
    			</table>
    		</div>
    		
    		<?php }elseif($view == 'add'){ ?>
<form role="form">
  <div class="col col-md-8 col-sm-8 col-xs-12" style="padding-top: 1em;">
    <div class="panel">
      <div class="panel-header">
          <div class="box-header with-border">
      <h3 class="box-title"> Artikel Content</h3>
    </div>
      </div>
      <div class="panel-body"><!-- /.box-header -->
    <div class="box-body">
      
        <!-- text input -->
        <div class="form-group">
          <label>Judul Artikel</label>
          <input type="text" name="judul" class="form-control new-input" id="judul" placeholder="Enter Judul Event ..." value="">
          <div class="error" id="ntf_judul"></div>
        </div>
        <div class="form-group">
        <label>Abstraksi Artikel</label>
        <?php echo $this->ckeditor->editor("content", "" ); ?>
          <input type="hidden" name="content" id="content">
          <div class="error" id="ntf_content"></div>
        </div>
         <div class="form-group">
          <label>Keyword</label>
          <input type="text" name="keyword" class="form-control new-input" id="keyword" placeholder="Enter keyword Artikel ..." value="">
          <div class="error" id="ntf_keyword"></div>
        </div>

        <div class="form-group">
          <label>Refernces</label>
          <?php
          $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '297px';
        $this->ckeditor->config['height'] = '300px'; 
            echo $this->ckeditor->editor("references", "" ); ?>
          <input type="hidden" name="references" id="ref">
          <div class="error" id="ntf_ref"></div>
       </div>
    </div></div>

    </div>

  </div>
  <div class="col col-md-4 col-sm-4 col-xs-12" style="padding-top: 1em;">
    <div class="panel ">
        <div class="panel-header"">
          <div class="box-header with-border">
          <h3 class="box-title">Artikel Setting</h3>
        </div>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label>Journal</label>
          <select class="form-control new-input" name="journal" id="journal">
            <option value="">-- Pilih Journal --</option>
            <?php foreach ($journal as $key => $value): ?>
              <option value="<?=$value['id_journal']?>"><?=$value['judul'];?></option>
            <?php endforeach ?>
          </select>
          <div class="error" id="ntf_journal"></div>
        </div>
        <div class="form-group">
          <label>Volume Jurnal</label>
          <select class="form-control new-input" name="volume" id="volume" style="margin-bottom: 10px;">
            <option value="">-- Pilih Volume --</option>   
          </select>
          <div class="error" id="ntf_volume"></div>
          <a href="<?=site_url('user/journal/add_volume');?>" class="btn-bg btn-warning btn-create-new"><i>Create New Volume</i></a>
        </div>

        <div class="form-group">
          <label>No Volume Jurnal</label>
          <select class="form-control new-input" name="no_volume" id="no_volume" style="margin-bottom: 10px;">
            <option value="">-- Pilih No Volume --</option>
          </select>
          <div class="error" id="ntf_no_volume"></div>
          <a href="<?=site_url('user/journal/add_no_volume');?>" class="btn-bg btn-warning btn-create-new"><i>Create New No Volume</i></a>
        </div>

       

        <div class="form-group">
          <label>File Artikel</label>
          <div class="col col-md-12 form-goup-file">
            <div class="input-file-right">
              <label class="btn btn-success btn-choose-foto btn-warning btn-bg" for="file_name"><i class="fa fa-upload" ></i>Choose File</label>
            </div>
            <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
            <div><i>Max file size 100MB <br>Allowed file type : pdf, docx</i></div> 
            <div class="error" id="ntf_file_name"></div> 
            <div class="error" id="ntf_error"></div> 
          </div>
        </div>

        <div class="form-group">
          <label>File Abstrak</label>
          <div class="col col-md-12 form-goup-file">
            <div class="input-file-right">
              <label class="btn btn-success btn-choose-foto btn-warning btn-bg" for="file_name_abs"><i class="fa fa-upload" ></i>Choose File</label>
            </div>
            <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name_abs" id="file_name_abs"></div> 
            <div><i>Max file size 100MB <br>Allowed file type : pdf, docx</i></div> 
            <div class="error" id="ntf_file_name_abs"></div> 
            <div class="error" id="ntf_abs_error"></div> 
          </div>
        </div>

        <div class="col col-md-12 col-sm-12 col-xs-12" style="padding: 10px;border:solid #A8A8A8 1px; margin-top:15px;">
          <div class="form-group">
            <label>Nama Author</label>
            <input type="text" name="nama" class="form-control nama new-input" id="nama" placeholder="Enter Nama Author ..." value="">
            <div class="error" id="ntf_nama"></div>
          </div>

          <div class="form-group" style=" ">
            <label>Jabatan Author</label>
            <input type="text" name="jabatan" class="form-control jabatan new-input" id="jabatan" placeholder="Enter Jabatan Author ..." value="">
            <div class="error" id="ntf_jabatan"></div>
          </div>
        </div>

        <div class="more"></div>
        <div class="text-right" >
          <button class="btn btn-warning btn-bg btn_more" type="button" style="margin-top: 15px;"><i class="fa fa-plus"></i> Add More</button>
        </div>
    <!--     <div class="form-group">
          <label>Gambar Berita</label>
          <input type="file" name="file_name" class="form-control" id="file_name">
          <div class="error" id="ntf_file_name"></div>
        </div> -->
        <div class="form-group" style="padding-top: 15px;" >
          <table>
            <tr style="background-color: #EF7314;padding: 10px;">
              <td style="padding-top:15px;padding-left: 10px;"><input type="checkbox" name="agree" id="agree" value="1" style="float: left;margin-top: -1.5em; margin-right: 5px;"></td>
              <td><p class="form-control-static" style="color: white;padding: 0;">Saya Telah membaca dan menyetujui semua persayratan dan peraturan yang di ajukan</p></td>
            </tr>
          </table>
          
          
          <div class="error" id="ntf_agree"></div>
        </div>
         <button type="button" class="btn btn-warning btn-bg" id="submit_artikel">Submit</button>
      </div>
    </div>
  </div>
</form>
    		<?php }else{ ?>
<form role="form">
  <div class="col col-md-8 col-sm-8 col-xs-12" style="padding-top: 1em;">
    <div class="panel">
      <div class="panel-header" >
          <div class="box-header with-border">
      <h3 class="box-title"> Artikel Content</h3>
    </div>
      </div>
      <div class="panel-body"><!-- /.box-header -->
    <div class="box-body">
      
        <!-- text input -->
        <div class="form-group">
          <label>Judul Artikel</label>
          <input type="text" name="judul" class="form-control new-input" id="judul" placeholder="Enter Judul Event ..." value="<?=$artikel['judul'];?>">
          <div class="error" id="ntf_judul"></div>
        </div>
        <div class="form-group">
        <label>Abstraksi Artikel</label>
        <?php echo $this->ckeditor->editor("content", $artikel['abstrak'] ); ?>
          <input type="hidden" name="content" id="content">
          <div class="error" id="ntf_content"></div>
        </div>
            <div class="form-group">
          <label>Keyword</label>
          <input type="text" name="keyword" class="form-control new-input" id="keyword" placeholder="Enter keyword Artikel ..." value="<?=$artikel['keyword'];?>">
          <div class="error" id="ntf_keyword"></div>
        </div>

        <div class="form-group">
          <label>References</label>
          <?php
          $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '297px';
        $this->ckeditor->config['height'] = '300px'; 
           ?>
          <?php echo $this->ckeditor->editor("references", $artikel['references'] ); ?>
          <input type="hidden" name="references" id="ref">
          <!-- <textarea name="ref" class="form-control" id="ref" placeholder="Enter Refernces Artikel"><?=$artikel['references'];?></textarea> -->
          <div class="error" id="ntf_ref"></div>
       </div>
    </div></div>

    </div>

  </div>
  <div class="col col-md-4 col-sm-4 col-xs-12" style="padding-top: 1em;">
    <div class="panel ">
        <div class="panel-header" ">
          <div class="box-header with-border">
          <h3 class="box-title">Artikel Setting</h3>
        </div>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label>Journal</label>
          <select class="form-control new-input" name="journal" id="journal">
            <option value="">-- Pilih Journal --</option>
            <?php foreach ($journal as $key => $value): ?>
              <option <?php if($artikel['id_journal_ref'] = $value['id_journal']){ echo "selected"; } ?> value="<?=$value['id_journal']?>"><?=$value['judul'];?></option>
            <?php endforeach ?>
          </select>
          <div class="error" id="ntf_journal"></div>
        </div>
        <div class="form-group">
          <label>Volume Jurnal</label>
          <select class="form-control new-input" name="volume" id="volume" style="margin-bottom: 10px;">
            <option value="">-- Pilih Volume --</option>
            <option selected value="<?=$artikel['id_volume'];?>">Volume. <?=$artikel['volume'];?></option>
            
          </select>
          <div class="error" id="ntf_volume"></div>
          <a href="<?=site_url('user/journal/add_volume');?>" class="btn-bg btn-warning btn-create-new"><i>Create New Volume</i></a>
        </div>

        <div class="form-group">
          <label>No Volume Jurnal</label>
          <select class="form-control new-input" name="no_volume" id="no_volume" style="margin-bottom: 10px;">
            <option value="">-- Pilih No Volume --</option>
            <option selected value="<?=$artikel['id_no_volume'];?>">No. <?=$artikel['nomor'];?></option>
          </select>
          <div class="error" id="ntf_no_volume"></div>
          <a href="<?=site_url('user/journal/add_no_volume');?>" class="btn-bg btn-warning btn-create-new"><i>Create New No Volume</i></a>
        </div>

    

        <div class="form-group">
          <label>File Artikel</label>
          <div class="col col-md-12 form-goup-file">
            <div class="input-file-right">
              <label class="btn btn-warning btn-choose-foto btn-bg" for="file_name"><i class="fa fa-upload" ></i>Choose File</label>
            </div>
            <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
            <div><i>Max file size 100MB <br>Allowed file type : pdf, docx</i></div> 
            <div class="error" id="ntf_file_name"></div> 
            <div class="error" id="ntf_error"></div> 
          </div>
        </div>
        <div class="form-group">
          <label>File Abstrak</label>
          <div class="col col-md-12 form-goup-file">
            <div class="input-file-right">
              <label class="btn btn-warning btn-choose-foto btn-bg" for="file_name_abs"><i class="fa fa-upload" ></i>Choose File</label>
            </div>
            <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name_abs" id="file_name_abs"></div> 
            <div><i>Max file size 100MB <br>Allowed file type : pdf, docx</i></div> 
            <div class="error" id="ntf_file_name_abs"></div> 
            <div class="error" id="ntf_abs_error"></div> 
          </div>
        </div>
        <?php foreach ($author as $key => $value): ?>
        <div class="card_<?=$value['id_author'];?>" style="margin-bottom: 10px">
          <div class="col col-md-12 col-sm-12 col-xs-12" style="padding: 10px;border:solid #A8A8A8 1px; margin-top:15px;">
        <div class="form-group">
          <label>Nama Author</label>
          <input type="text" name="nama" class="form-control new-input nama_<?=$value['id_author'];?>" id="nama_<?=$value['id_author'];?>" placeholder="Enter Nama Author ..." value="<?=$value['nama'];?>" disabled="true">
          <div class="error" id="ntf_nama_<?=$value['id_author'];?>"></div>
        </div>

        <div class="form-group" >
          <label>Jabatan Author</label>
          <input type="text" name="jabatan" class="form-control new-input jabatan_<?=$value['id_author'];?>" id="jabatan_<?=$value['id_author'];?>" placeholder="Enter Jabatan Author ..." value="<?=$value['jabatan'];?>" disabled="true">
          <div class="error" id="ntf_jabatan_<?=$value['id_author'];?>"></div>
        </div>
      </div>
        <button class="btn btn-danger btn-delete btn-xs" type="button" id="<?=$value['id_author'];?>">delete</button><button class="btn btn-info btn-edit btn-xs" type="button" id="<?=$value['id_author'];?>" style="float: right">edit</button>
        </div>
        <?php endforeach ?>
        <div class="more"></div>
        <div class="text-right">
          <button class="btn btn-info btn_more" type="button" style="margin: 15px 0;"><i class="fa fa-plus"></i> Add More</button>
        </div>
    <!--     <div class="form-group">
          <label>Gambar Berita</label>
          <input type="file" name="file_name" class="form-control" id="file_name">
          <div class="error" id="ntf_file_name"></div>
        </div> -->
        <div class="form-group">
          <table style="padding-top: 15px;">
            <tr style="background-color: #EF7314;padding: 10px;">
              <td style="padding-top:15px;padding-left: 10px;">
                <input type="checkbox" name="agree" id="agree" value="1" style="float: left;margin-top: -1.5em; margin-right: 5px;">
              </td>
              <td>
                <p class="form-control-static" style="color: white;padding: 0;">Saya Telah membaca dan menyetujui semua persayratan dan peraturan yang di ajukan</p>
              </td>
            </tr>
          </table>
          
          
          <div class="error" id="ntf_agree"></div>
        </div>
         <button type="button" class="btn btn-primary" id="submit_artikel">Submit</button>
      </div>
    </div>
  </div>
</form>
        <?php } ?>
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
<div class="modal" tabindex="-1" role="dialog" id="modalDetail">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label>Volume</label>
      <div class="form-control-static" id="volume"></div>
      <label>Nomor Volume</label>
      <div class="form-control-static" id="nomor"></div>
      <label>Abstraksi</label>
      <div class="form-control-static" id="abs"></div>
      <label>Author</label>
      <div id="author"></div>
      <label>Keyword</label>
      <div id="keyword"></div>
      <label>File</label>
      <div id="file"></div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="progresLoading" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
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
<!-- <script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script> -->
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    
    $('body').on('click','#submit_artikel', function(){
      $('.error').html('');
      $('#progresLoading').modal('show');
      var nama = [];
      var jabatan = [];
      var form_data = new FormData();
      $.each($('.nama'),function(i){
        nama.push($(this).val());
      });

      $.each($('.jabatan'),function(i){
        jabatan.push($(this).val());
      });
      console.log(nama);
      var file_data = $('#file_name').prop('files')[0];
      var file_data_abs = $('#file_name_abs').prop('files')[0];
      $('#content').val(CKEDITOR.instances.content.getData());
      $('#ref').val(CKEDITOR.instances.references.getData());
      form_data.append('judul', $('#judul').val());
      form_data.append('journal', $('#journal').val());
      form_data.append('volume', $('#volume').val());
      form_data.append('no_volume', $('#no_volume').val());
      form_data.append('content', $('#content').val());
      form_data.append('keyword', $('#keyword').val());
      form_data.append('ref', $('#ref').val());
      form_data.append('nama', nama);
      form_data.append('jabatan', jabatan);
      if ($('#agree').is(':checked')) {
        form_data.append('agree', 1);
      }
      // console.log($('#ref').val());
      // return false;
      // form_data.append('tgl_event', $('#tgl_event').val());
      // form_data.append('start_event', $('#start_event').val());
      // form_data.append('end_event', $('#end_event').val());
      form_data.append('file_name', file_data);
      form_data.append('file_name_abs', file_data_abs);
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
          $('#progresLoading').modal('hide');
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

    $('body').on('click','.btn-delete',function(){
      var id = $(this).attr('id');
      if ($('.btn-delete').length == 1) {
        alert('Minimal harus satu author');
        return false;
      }
      if (confirm('Anda Ingin Menghapus Author ini ?')) {
      $.ajax({
        url : base_url+'user/journal/delete_author/'+id,
        // data : {'nama' : nama, 'jabatan' : jabatan},
        dataType: 'json',
        type : 'POST'
      }).done(function(data){
        // console.log($(this));
        if (data.status == 1) {
          $('.card_'+id).remove();
          // ini.addClass('btn-edit');
          // ini.removeClass('btn-save');
          // ini.addClass('btn-info');
          // ini.removeClass('btn-success');
          // ini.text('Edit');
          // $('.nama_'+id).prop('disabled',true);
          // $('.jabatan_'+id).prop('disabled',true);
          // window.location.href = data.url;
        }
        $.each(data.notif,function(key,value){
          $('.error').show();
          $('#ntf_'+ key+'_'+id).html(value);
          $('#ntf_'+ key+'_'+id).css({'color':'red', 'font-style':'italic'});
        });
      });
      }
      console.log(id);
    });

    $('body').on('click','.btn-edit',function(){
      var id = $(this).attr('id');
      $(this).removeClass('btn-edit');
      $(this).addClass('btn-save');
      $(this).removeClass('btn-info');
      $(this).addClass('btn-success');
      $(this).text('Save');
      $('.nama_'+id).prop('disabled',false);
      $('.jabatan_'+id).prop('disabled',false);
      console.log(id);
    });

    $('body').on('click','.btn-save', function(){
      var id = $(this).attr('id');
      var nama = $('.nama_'+id).val();
      var jabatan =  $('.jabatan_'+id).val();
      var ini = $(this);
      // var status = 1;
      console.log($(this));
      $.ajax({
        url : base_url+'user/journal/save_author/'+id,
        data : {'nama' : nama, 'jabatan' : jabatan},
        dataType: 'json',
        type : 'POST'
      }).done(function(data){
        console.log($(this));
        if (data.status == 1) {
          ini.addClass('btn-edit');
          ini.removeClass('btn-save');
          ini.addClass('btn-info');
          ini.removeClass('btn-success');
          ini.text('Edit');
          $('.nama_'+id).prop('disabled',true);
          $('.jabatan_'+id).prop('disabled',true);
          // window.location.href = data.url;
        }
        $.each(data.notif,function(key,value){
          $('.error').show();
          $('#ntf_'+ key+'_'+id).html(value);
          $('#ntf_'+ key+'_'+id).css({'color':'red', 'font-style':'italic'});
        });
      });
    });

    $('body').on('click','.btn-add-artikel',function(){
      var id = $(this).attr('id');
      console.log(id);
      console.log('id');
      window.location.href = base_url+'user/journal/add_artikel/'+id;
    });

    $('body').on('click','.btn_more',function(){
      var html = '<div class="col col-md-12 col-sm-12 col-xs-12" style="padding: 10px;border:solid #A8A8A8 1px; margin-top:15px;"><div class="form-group" > <label>Nama Author</label> <input type="text" name="nama" class="form-control nama new-input" id="nama" placeholder="Enter Nama Author ..." value=""> <div class="error" id="ntf_nama"></div></div><div class="form-group" > <label>Jabatan Author</label> <input type="text" name="jabatan" class="form-control jabatan new-input" id="jabatan" placeholder="Enter Jabatan Author ..." value=""> <div class="error" id="ntf_jabatan"></div></div></div>';
      $('.more').append(html);
    });

    $('body').on('click','.detail', function(){
      var id = $(this).attr('id');
        window.location.href = base_url+'user/journal/detail_artikel/'+id;
    });

    $('body').on('click','#volume', function(){
      // $('#progresLoading').modal('show');
      var id = $(this).val();
      if (id == '') {

      }
      $.ajax({
          url : base_url+'user/journal/no_volume/'+id,
          dataType : 'json',
          async : false,
          cache : false ,
          contentType : false , 
          processData : false
      }).done(function(data){
        console.log(data);
        $('#no_volume').html(data);
      });
    });

    $('body').on('click','#journal', function(){
      // $('#progresLoading').modal('show');
      var id = $(this).val();
      if (id == '') {
        return false;
      }
      $.ajax({
          url : base_url+'user/journal/select_volume/'+id,
          dataType : 'json',
          async : false,
          cache : false ,
          contentType : false , 
          processData : false
      }).done(function(data){
        console.log(data);
        $('#volume').html(data);
      });
    });

    $('body').on('click','#volume', function(){
      // $('#progresLoading').modal('show');
      var id = $(this).val();
      if (id == '') {
        return false;
      }
      $.ajax({
          url : base_url+'user/journal/no_volume/'+id,
          dataType : 'json',
          async : false,
          cache : false ,
          contentType : false , 
          processData : false
      }).done(function(data){
        console.log(data);
        $('#no_volume').html(data);
      });
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
            "url": "<?php echo site_url('user/journal/ajax_list_artikel')?>",
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