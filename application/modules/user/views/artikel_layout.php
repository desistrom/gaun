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
<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
    <div class=" title-box">
		<h3 class="title">Artikel</h3>
    </div>
    <div class="box-content">
    	<div class="row">
    	<?php if($view == 'list'){ ?>
      <a href="<?=site_url('user/journal/add_artikel');?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Artikel</a>
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
    <div class="modal" tabindex="-1" role="dialog" id="modalDetail">
      <div class="modal-dialog" role="document" style="margin-top: 75px">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Success</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="text-right">
            <button class="btn btn-success btn-add-artikel" type="button" id=""><i class="fa fa-plus"></i> Add Artikel</button>
          </div>
          	<ul>
          		<li>ISSN : <span id="issn_view"></span></li>
          		<li>Visitor : <span id="visitor_view"></span></li>
          	</ul>
            <div class="table-responsive">
            	<table class="table table-striped">
            		<thead>
            			<th>Volume</th>
            			<th>Jumlah No Volume</th>
            			<th>Jumlah Artikel</th>
            		</thead>
                <tbody></tbody>
            	</table>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    		<?php }elseif($view == 'add'){ ?>
          <form role="form">
<div class="col col-md-8 col-sm-8 col-xs-12" style="padding-top: 1em;">
  <div class="panel">
    <div class="panel-header" style="background-color:  #F5F5F5;">
        <div class="box-header with-border">
    <h3 class="box-title"> Artikel Content</h3>
  </div>
    </div>
    <div class="panel-body"><!-- /.box-header -->
  <div class="box-body">
    
      <!-- text input -->
      <div class="form-group">
        <label>Judul Artikel</label>
        <input type="text" name="judul" class="form-control" id="judul" placeholder="Enter Judul Event ..." value="">
        <div class="error" id="ntf_judul"></div>
      </div>
      <div class="form-group">
      <label>Abstraksi Artikel</label>
      <?php echo $this->ckeditor->editor("content", "" ); ?>
        <input type="hidden" name="content" id="content">
        <div class="error" id="ntf_content"></div>
      </div>
  </div></div>

  </div>

</div>
<div class="col col-md-4 col-sm-4 col-xs-12" style="padding-top: 1em;">
  <div class="panel ">
      <div class="panel-header" style="background-color:  #F5F5F5;">
        <div class="box-header with-border">
        <h3 class="box-title">Artikel Setting</h3>
      </div>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <label>Journal</label>
        <select class="form-control" name="journal" id="journal">
          <option value="">-- Pilih Journal --</option>
          <?php foreach ($journal as $key => $value): ?>
            <option value="<?=$value['id_journal']?>"><?=$value['judul'];?></option>
          <?php endforeach ?>
        </select>
        <div class="error" id="ntf_volume"></div>
      </div>
      <div class="form-group">
        <label>Volume Jurnal</label>
        <select class="form-control" name="volume" id="volume">
          <option value="">-- Pilih Volume --</option>
          
        </select>
        <div class="error" id="ntf_volume"></div>
      </div>

      <div class="form-group">
        <label>No Volume Jurnal</label>
        <select class="form-control" name="no_volume" id="no_volume">
          <option value="">-- Pilih No Volume --</option>
        </select>
        <div class="error" id="ntf_no_volume"></div>
      </div>

    <div class="form-group">
      <label>Keyword</label>
      <input type="text" name="keyword" class="form-control" id="keyword" placeholder="Enter keyword Artikel ..." value="">
      <div class="error" id="ntf_keyword"></div>
    </div>

    <div class="form-group">
      <label>Refernces</label>
      <textarea name="ref" class="form-control" id="ref" placeholder="Enter Refernces Artikel"></textarea>
      <div class="error" id="ntf_ref"></div>
    </div>

      <div class="form-group">
      <label>File Artikel</label>
      <div class="col col-md-12 form-goup-file">
        <div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="file_name"><i class="fa fa-upload" ></i>Choose File</label></div>
        <div class="input-file-left"><input type="file" class="form-control file" name="file_name" id="file_name"></div> 
        <div>Max file size 100MB <br>Allowed file type : pdf, docx</i></div> 
        <div class="error" id="ntf_file_name"></div> 
        <div class="error" id="ntf_error"></div> 
      </div>
    </div>

    <div class="form-group">
      <label>Nama Author</label>
      <input type="text" name="nama" class="form-control nama" id="nama" placeholder="Enter Nama Author ..." value="">
      <div class="error" id="ntf_nama"></div>
    </div>

    <div class="form-group">
      <label>Jabatan Author</label>
      <input type="text" name="jabatan" class="form-control jabatan" id="jabatan" placeholder="Enter Jabatan Author ..." value="">
      <div class="error" id="ntf_jabatan"></div>
    </div>
    <div class="more"></div>
    <dir class="text-right">
      <button class="btn btn-info btn_more" type="button"><i class="fa fa-plus"></i> Add More</button>
    </dir>
  <!--     <div class="form-group">
        <label>Gambar Berita</label>
        <input type="file" name="file_name" class="form-control" id="file_name">
        <div class="error" id="ntf_file_name"></div>
      </div> -->
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
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    
    $('body').on('click','#submit_artikel', function(){
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
      $('#content').val(CKEDITOR.instances.content.getData());
      form_data.append('judul', $('#judul').val());
      form_data.append('journal', $('#journal').val());
      form_data.append('volume', $('#volume').val());
      form_data.append('no_volume', $('#no_volume').val());
      form_data.append('content', $('#content').val());
      form_data.append('keyword', $('#keyword').val());
      form_data.append('ref', $('#ref').val());
      form_data.append('nama', nama);
      form_data.append('jabatan', jabatan);
      // form_data.append('tgl_event', $('#tgl_event').val());
      // form_data.append('start_event', $('#start_event').val());
      // form_data.append('end_event', $('#end_event').val());
      form_data.append('file_name', file_data);
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

    $('body').on('click','.btn-add-artikel',function(){
      var id = $(this).attr('id');
      console.log(id);
      console.log('id');
      window.location.href = base_url+'user/journal/add_artikel/'+id;
    });

    $('body').on('click','.btn_more',function(){
      var html = '<div class="form-group"> <label>Nama Author</label> <input type="text" name="nama" class="form-control nama" id="nama" placeholder="Enter Nama Author ..." value=""> <div class="error" id="ntf_nama"></div></div><div class="form-group"> <label>Jabatan Author</label> <input type="text" name="jabatan" class="form-control jabatan" id="jabatan" placeholder="Enter Jabatan Author ..." value=""> <div class="error" id="ntf_jabatan"></div></div>';
      $('.more').append(html);
    });

    $('body').on('click','.detail', function(){
      // $('#progresLoading').modal('show');
      var id = $(this).attr('id');
      $.ajax({
          url : base_url+'user/journal/detail_journal/'+id,
          dataType : 'json',
          async : false,
          cache : false ,
          contentType : false , 
          processData : false
      }).done(function(data){
        console.log(data);
        $('#modalDetail .btn-add-artikel').attr('id',data.id);
        $('#modalDetail #issn_view').html(data.issn);
        $('#modalDetail #visitor_view').html(data.visitor);
        $('#modalDetail tbody').html(data.table);
        $('#modalDetail').modal('show');
        $('.modal-backdrop').remove();
      });
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