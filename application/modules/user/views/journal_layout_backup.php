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
  .panel .panel-header{
    border-bottom: solid 1px #A8A8A8;
    padding-left: 15px;
    
  }

</style>
<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="col col-md-12 col-sm-12 col-xs-12 right-content" style="padding: 0 30px;">
    <div class=" title-box">
		<h3 class="title"><?php if(isset($breadcumb)){ ?><?=$breadcumb;?><?php }else{ ?> Journal <?php } ?></h3>
    </div>
    <div class="box-content">
    	<div class="row">
    	<?php if($view == 'list'){ ?>
      <a href="<?=site_url('user/journal/add');?>" class="btn btn-success"><i class="fa fa-plus"></i> Journal</a>
    		<div class="table-responsive">
    			<table class="table table-striped" id="table">
    				<thead>
    					<th>No.</th>
    					<th>Nama Journal</th>
    					<th>ISSN</th>
    					<th>Judul</th>
    					<th>Visitor</th>
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
    		
  
  
    		<?php }elseif($view == 'add'){ ?>
    			<form role="form">
<div class="col col-md-8 col-sm-8 col-xs-12" style="padding-top: 1em;padding-left: 0;">
  <div class="panel">
    <div class="panel-header" ">
        <div class="box-header with-border">
    <h3 class="box-title"> Journal Content</h3>
  </div>
    </div>
    <div class="panel-body"><!-- /.box-header -->
  <div class="box-body">
    
      <!-- text input -->
      <div class="form-group">
        <label>Judul Journal</label>
        <input type="text" name="judul" class="form-control new-input" id="judul" placeholder="Enter Judul Journal ..." value="">
        <div class="error" id="ntf_judul"></div>
      </div>
      <div class="form-group">
      <label>Deskripsi Journal</label>
      <?php echo $this->ckeditor->editor("content", "" ); ?>
        <input type="hidden" name="content" id="content">
        <div class="error" id="ntf_content"></div>
      </div>
  </div></div>

  </div>

</div>
<div class="col col-md-4 col-sm-4 col-xs-12" style="padding-top: 1em;padding-right: 0;">
  <div class="panel ">
      <div class="panel-header" ">
        <div class="box-header with-border">
        <h3 class="box-title">Journal Setting</h3>
      </div>
    </div>
    <div class="panel-body">
      <!-- textarea -->
      <div class="form-group">
        <label>ISSN JOURNAL</label>
        <input type="text" name="issn" class="form-control new-input" placeholder="ISSN Journal" id="issn">
        <div class="error" id="ntf_issn"></div>
      </div>
      <div class="form-group">
        <label>Kategori JOURNAL</label>
        <select class="form-control new-input" name="kategori" id="kategori">
          <option value="">-- Pilih Kategori --</option>
          <?php foreach ($kategori as $key => $value): ?>
            <option value="<?=$value['id_kategori'];?>"><?=$value['nama'];?></option>
          <?php endforeach ?>
        </select>
        <div class="error" id="ntf_kategori"></div>
      </div>
      <div class="form-group">
      <label>Journal Cover</label>
      <div class="col col-md-12 form-goup-file">
        <div class="input-file-right"><label class="btn btn-success btn-choose-foto btn-warning btn-bg" for="file_name"><i class="fa fa-upload" ></i>Choose File</label></div>
        <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
        <div><i>*for best result use 450x240 px. <br> Max file size 400KB, Width 200px - 1024px. <br>Allowed file type : jpeg, jpg, png, gif.</i></div> 
        <div class="error" id="ntf_file_name"></div> 
        <div class="error" id="ntf_error"></div> 
      </div>

    </div>
  <!--     <div class="form-group">
        <label>Gambar Berita</label>
        <input type="file" name="file_name" class="form-control" id="file_name">
        <div class="error" id="ntf_file_name"></div>
      </div> -->
       <button type="button" class="btn btn-warning btn-bg" id="submit">Submit</button>
    </div>


</div>
</div>
  </form>
    		<?php }else{ ?> 
<form role="form">
<div class="col col-md-8 col-sm-8 col-xs-12" style="padding-top: 1em;">
  <div class="panel">
    <div class="panel-header" style="">
        <div class="box-header with-border">
    <h3 class="box-title"> Journal Content</h3>
  </div>
    </div>
    <div class="panel-body"><!-- /.box-header -->
  <div class="box-body">
    
      <!-- text input -->
      <div class="form-group">
        <label>Judul Journal</label>
        <input type="text" name="judul" class="form-control new-input" id="judul" placeholder="Enter Judul Journal ..." value="<?=$journal['judul'];?>">
        <div class="error" id="ntf_judul"></div>
      </div>
      <div class="form-group">
      <label>Deskripsi Journal</label>
      <?php echo $this->ckeditor->editor("content", $journal['deskripsi'] ); ?>
        <input type="hidden" name="content" id="content">
        <div class="error" id="ntf_content"></div>
      </div>
  </div></div>

  </div>

</div>
<div class="col col-md-4 col-sm-4 col-xs-12" style="padding-top: 1em;">
  <div class="panel ">
      <div class="panel-header" style="">
        <div class="box-header with-border">
        <h3 class="box-title">Journal Setting</h3>
      </div>
    </div>
    <div class="panel-body">
      <!-- textarea -->
      <div class="form-group">
        <label>ISSN JOURNAL</label>
        <input type="text" name="issn" class="form-control new-input" placeholder="ISSN Journal" id="issn" value="<?=$journal['issn'];?>">
        <div class="error" id="ntf_issn"></div>
      </div>
      <div class="form-group">
        <label>Kategori JOURNAL</label>
        <select class="form-control new-input" name="kategori" id="kategori">
          <option value="">-- Pilih Kategori --</option>
          <?php foreach ($kategori as $key => $value): ?>
            <option <?php if ($journal['id_kategori_ref'] == $value['id_kategori']): ?>
              selected
            <?php endif; ?> value="<?php echo $value['id_kategori'];?>"><?php echo $value['nama'];?></option>
          <?php endforeach ?>
        </select>
        <div class="error" id="ntf_kategori"></div>
      </div>
      <div class="form-group">
      <label>Journal Cover</label>
      <div class="col col-md-12 form-goup-file">
        <div class="input-file-right"><label class="btn btn-success btn-choose-foto btn-bg btn-warning" for="file_name"><i class="fa fa-upload" ></i>Choose File</label></div>
        <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
        <div><i>*for best result use 450x240 px. <br> Max file size 400KB, Width 200px - 1024px. <br>Allowed file type : jpeg, jpg, png, gif.</i></div> 
        <br>
        <div class="error" id="ntf_file_name"></div> 
        <div class="error" id="ntf_error"></div> 
      </div>
      <img src="<?php echo base_url().'assets/media/'.$journal['futured_image'];?>" style="width: 100%;">
    </div>
  <!--     <div class="form-group">
        <label>Gambar Berita</label>
        <input type="file" name="file_name" class="form-control" id="file_name">
        <div class="error" id="ntf_file_name"></div>
      </div> -->
       <button type="button" class="btn btn-warning btn-bg" id="submit">Submit</button>
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
            <h3 class="modal-title"><?php if ($this->session->flashdata('header') != '') { echo $this->session->flashdata('header'); }else{ echo "Sukses"; } ?></h3>
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
  <div class="modal fade" id="progresLoading" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-body">
                  <div class="box box-danger">
                      <div class="box-header">
                      </div>
                      <div class="box-body">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="0"
                          aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            0%
                          </div>
                        </div>
                      </div>
                      <!-- <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                      </div> -->
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
    $('body').on('click','#submit', function(){
      $('.error').hide();
      $('.error').text('');

      var file_data = $('#file_name').prop('files')[0];
      var er = '';
      $('#content').val(CKEDITOR.instances.content.getData());
      if ($('#judul').val() == '') {
        er = 1;
        $('#ntf_judul').html('The Judul Journal field is required.');
      }
      // if ($('#issn').val() == '') {
      //   er = 1;
      //   $('#ntf_issn').html('The Judul Journal field is required.');
      // }
      // console.log($('#file_name').prop('files'));
      if ($('#content').val() == '') {
        er = 1;
        $('#ntf_content').html('The Content field is required.');
      }
      if ($('#kategori').val() == '') {
        er = 1;
        $('#ntf_kategori').html('The Kategori field is required.');
      }
      var uri = get_url(window.location.href);
      if ($.isNumeric(uri)) {
        if (file_data != undefined) {
          if (file_data.size > 400000) {
            er = 1;
            $('#ntf_file_name').html('The file size is too large.');
          }
          var img = new Image();
          img.src = window.URL.createObjectURL( file_data );
          img.onload = function() {
              var width = img.naturalWidth,
                  height = img.naturalHeight;

              window.URL.revokeObjectURL( img.src );

              if( width > 1024) {
                  er = 1;
                  $('#ntf_error').html('The File Width is too large.');
              }
          };
          if (file_data.type != 'image/jpg' && file_data.type != 'image/png' && file_data.type != 'image/jpeg' && file_data.type != 'image/gif') {
            er = 1;
            $('#ntf_error').html('File Type not Allowed.');
          }
        }
      }else{
        if (file_data == undefined) {
          er = 1;
          $('#ntf_file_name').html('The Journal Cover field is required.');
        }else{
          if (file_data.size > 400000) {
            er = 1;
            $('#ntf_file_name').html('The file size is too large.');
          }
          var img = new Image();
          img.src = window.URL.createObjectURL( file_data );
          img.onload = function() {
              var width = img.naturalWidth,
                  height = img.naturalHeight;

              window.URL.revokeObjectURL( img.src );

              if( width > 1024) {
                  er = 1;
                  $('#ntf_error').html('The File Width is too large.');
              }
          };
          if (file_data.type != 'image/jpg' && file_data.type != 'image/png' && file_data.type != 'image/jpeg' && file_data.type != 'image/gif') {
            er = 1;
            $('#ntf_error').html('File Type not Allowed.');
          }
        }
      }
      
      $('#progresLoading').modal('show');

      if (er == 1) {
        $('.error').show();
        $('.error').css({'color':'red', 'font-style':'italic','display':'block'});
        $('#progresLoading').modal('hide');
        return false;
      }
      var form_data = new FormData();
      form_data.append('judul', $('#judul').val());
      form_data.append('issn', $('#issn').val());
      form_data.append('content', $('#content').val());
      form_data.append('kategori', $('#kategori').val());
      form_data.append('file_name', file_data);
      $.ajax({
          url : window.location.href,
          dataType : 'json',
          type : 'POST',
          data : form_data,
          xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',progress, false);
                }
                return myXhr;
        },
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
            $('#ntf_'+ key).css({'color':'red', 'font-style':'italic','display':'block'});
            });
      });

    });

    function progress(e){

      if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;

        var Percentage = (current * 100)/max;
        var st = String(Percentage);
        var a = st.split('.');
        Percentage = a[0];
        $('#progresLoading .progress-bar').prop('aria-valuenow',Percentage);
        $('#progresLoading .progress-bar').text(Percentage+'%');
        $('#progresLoading .progress-bar').css({'width': Percentage+'%'});
        console.log(Percentage);


        if(Percentage >= 100)
        {
           // process completed  
        }
      }  
     }

    function get_url(url){
      return url.split('/').pop()
    }

    // $('body').on('click','#submit_artikel', function(){
    //   $('#progresLoading').modal('show');
    //   var nama = [];
    //   var jabatan = [];
    //   var form_data = new FormData();
    //   $.each($('.nama'),function(i){
    //     nama.push($(this).val());
    //   });

    //   $.each($('.jabatan'),function(i){
    //     jabatan.push($(this).val());
    //   });
    //   var file_data = $('#file_name').prop('files')[0];
    //   $('#content').val(CKEDITOR.instances.content.getData());
    //   form_data.append('judul', $('#judul').val());
    //   form_data.append('volume', $('#volume').val());
    //   form_data.append('no_volume', $('#no_volume').val());
    //   form_data.append('content', $('#content').val());
    //   form_data.append('keyword', $('#keyword').val());
    //   form_data.append('ref', $('#ref').val());
    //   // form_data.append('tgl_event', $('#tgl_event').val());
    //   // form_data.append('start_event', $('#start_event').val());
    //   // form_data.append('end_event', $('#end_event').val());
    //   form_data.append('file_name', file_data);
    //   $.ajax({
    //       url : window.location.href,
    //       dataType : 'json',
    //       type : 'POST',
    //       data : form_data,
    //       async : false,
    //       cache : false ,
    //       contentType : false , 
    //       processData : false
    //   }).done(function(data){
    //       console.log(data);
    //       $('#progresLoading').modal('hide');
    //       if(data.state == 1){
    //         if (data.status == 1) {
    //           window.location.href = data.url;
    //         }else{
    //           $('.error_pass').show();
    //           $('.error_pass').css({'color':'red', 'font-style':'italic', 'text-align':'center'});
    //           console.log(data);
    //           $('.error_pass').html(data.error);
    //         }
    //       }
    //         $.each(data.notif,function(key,value){
    //         $('.error').show();
    //         $('#ntf_'+ key).html(value);
    //         $('#ntf_'+ key).css({'color':'red', 'font-style':'italic'});
    //         });
    //   });

    // });

    // $('body').on('click','.btn-add-artikel',function(){
    //   var id = $(this).attr('id');
    //   console.log(id);
    //   console.log('id');
    //   window.location.href = base_url+'user/journal/add_artikel/'+id;
    // });

    // $('body').on('click','.btn_more',function(){
    //   var html = '<div class="form-group"> <label>Nama Author</label> <input type="text" name="nama" class="form-control nama" id="nama" placeholder="Enter Nama Author ..." value=""> <div class="error" id="ntf_nama"></div></div><div class="form-group"> <label>Jabatan Author</label> <input type="text" name="jabatan" class="form-control jabatan" id="jabatan" placeholder="Enter Jabatan Author ..." value=""> <div class="error" id="ntf_jabatan"></div></div>';
    //   $('.more').append(html);
    // });

    // $('body').on('click','.detail', function(){
    //   // $('#progresLoading').modal('show');
    //   var id = $(this).attr('id');
    //   $.ajax({
    //       url : base_url+'user/journal/detail_journal/'+id,
    //       dataType : 'json',
    //       async : false,
    //       cache : false ,
    //       contentType : false , 
    //       processData : false
    //   }).done(function(data){
    //     console.log(data);
    //     $('#modalDetail .btn-add-artikel').attr('id',data.id);
    //     $('#modalDetail #issn_view').html(data.issn);
    //     $('#modalDetail #visitor_view').html(data.visitor);
    //     $('#modalDetail tbody').html(data.table);
    //     $('#modalDetail').modal('show');
    //     $('.modal-backdrop').remove();
    //   });
    // });

    // $('body').on('click','#volume', function(){
    //   // $('#progresLoading').modal('show');
    //   var id = $(this).val();
    //   if (id == '') {

    //   }
    //   $.ajax({
    //       url : base_url+'user/journal/no_volume/'+id,
    //       dataType : 'json',
    //       async : false,
    //       cache : false ,
    //       contentType : false , 
    //       processData : false
    //   }).done(function(data){
    //     console.log(data);
    //     $('#no_volume').html(data);
    //   });
    // });

    // $('body').on('click','#volume', function(){
    //   // $('#progresLoading').modal('show');
    //   var id = $(this).val();
    //   if (id == '') {

    //   }
    //   $.ajax({
    //       url : base_url+'user/journal/no_volume/'+id,
    //       dataType : 'json',
    //       async : false,
    //       cache : false ,
    //       contentType : false , 
    //       processData : false
    //   }).done(function(data){
    //     console.log(data);
    //     $('#no_volume').html(data);
    //   });
    // });
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
            "url": "<?php echo site_url('user/journal/ajax_list')?>",
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