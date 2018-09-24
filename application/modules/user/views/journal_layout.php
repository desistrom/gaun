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
		<h3>Journal</h3>
    </div>
    <div class="box-content">
    	<div class="row">
    	<?php if($view == 'list'){ ?>
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
          	<ul>
          		<li>ISSN : <span id="issn_view"></span></li>
          		<li>Visitor : <span id="visitor_view"></span></li>
          	</ul>
            <div class="table-responsive">
            	<table class="table table-striped">
            		<thead>
            			<th>Volume & Nomor</th>
            			<th>Publish</th>
            			<th>Artikel</th>
            		</thead>
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
    <h3 class="box-title"> Journal Content</h3>
  </div>
    </div>
    <div class="panel-body"><!-- /.box-header -->
  <div class="box-body">
    
      <!-- text input -->
      <div class="form-group">
        <label>Judul Journal</label>
        <input type="text" name="judul" class="form-control" id="judul" placeholder="Enter Judul Event ..." value="">
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
<div class="col col-md-4 col-sm-4 col-xs-12" style="padding-top: 1em;">
  <div class="panel ">
      <div class="panel-header" style="background-color:  #F5F5F5;">
        <div class="box-header with-border">
        <h3 class="box-title">Journal Setting</h3>
      </div>
    </div>
    <div class="panel-body">
      <!-- textarea -->
      <div class="form-group">
        <label>ISSN JOURNAL</label>
        <input type="text" name="issn" class="form-control" placeholder="Lokasi Event" id="issn">
        <div class="error" id="ntf_issn"></div>
      </div>
      <div class="form-group">
      <label>Futured Image Journal</label>
      <div class="col col-md-12 form-goup-file">
        <div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="file_name"><i class="fa fa-upload" ></i>Choose File</label></div>
        <div class="input-file-left"><input type="file" class="form-control file" name="file_name" id="file_name"></div> 
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
       <button type="button" class="btn btn-primary" id="submit">Submit</button>
    </div>


</div>
</div>
  </form>
    		<?php }else{ ?>
    		<?php } ?>
    	</div>
    </div>
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      $('#progresLoading').modal('show');
      var form_data = new FormData();
      var file_data = $('#file_name').prop('files')[0];
      $('#content').val(CKEDITOR.instances.content.getData());
      form_data.append('judul', $('#judul').val());
      form_data.append('issn', $('#issn').val());
      form_data.append('content', $('#content').val());
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

    $('body').on('click','.detail', function(){
      // $('#progresLoading').modal('show');
      $('#modalDetail').modal('show');
      var id = $(this).attr('id');
      $('.modal-backdrop').remove();
      // $.ajax({
      //     url : window.location.href,
      //     dataType : 'json',
      //     type : 'POST',
      //     data : {'id' : id},
      //     async : false,
      //     cache : false ,
      //     contentType : false , 
      //     processData : false
      // }).done(function(data){
          
      // });
    });
    // $('#modalSuccess').modal('show');
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