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
		<h3 class="title">Nomor Volume</h3>
    </div>
    <div class="box-content">
    	<div class="row">
        <div class="col col-md-12 col-sm-12 col-xs-12">
    	<?php if($view == 'list'){ ?>
      <a href="<?=site_url('user/journal/add_no_volume');?>" class="btn btn-success"><i class="fa fa-plus"></i> Add No Volume</a>
    		<div class="table-responsive">
    			<table class="table table-striped" id="table">
    				<thead>
    					<th>No.</th>
    					<th>Nomor Volume</th>
              <th>Volume</th>
    					<th>Journal</th>
    					<th>Action</th>
    				</thead>
    				<tbody>
    					
    				</tbody>
    			</table>
    		</div>
    		
    		<?php }elseif($view == 'add'){ ?>
    			<form role="form">
<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-top: 1em;">
  <div class="panel ">
      <div class="panel-header" style="background-color:  #F5F5F5;">
        <div class="box-header with-border">
        <h3 class="box-title">Volume</h3>
      </div>
    </div>
    <div class="panel-body">
      <!-- textarea -->
      <div class="form-group">
        <label>No Volume</label>
        <input type="text" name="noro" class="form-control" placeholder="No Volume" id="nomor">
        <div class="error" id="ntf_volume"></div>
      </div>
      <div class="form-group">
        <label>Jurnal</label>
        <select class="form-control" name="journal" id="journal">
          <option value="">-- Pilih Journal --</option>
          <?php foreach ($journal as $key => $value): ?>
            <option value="<?=$value['id_journal']?>"><?=$value['judul'];?></option>
          <?php endforeach ?>
        </select>
        <div class="error" id="ntf_journal"></div>
      </div>
      <div class="form-group">
        <label>Volume</label>
        <select class="form-control" name="volume" id="volume">
          <option value="">-- Pilih Volume --</option>
        </select>
        <div class="error" id="ntf_volume"></div>
      </div>
       <button type="button" class="btn btn-primary" id="submit">Submit</button>
    </div>


</div>
</div>
  </form>
    		<?php }else{ ?>
<form role="form">
<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-top: 1em;">
  <div class="panel ">
      <div class="panel-header" style="background-color:  #F5F5F5;">
        <div class="box-header with-border">
        <h3 class="box-title">Volume</h3>
      </div>
    </div>
    <div class="panel-body">
      <!-- textarea -->
      <div class="form-group">
        <label>No Volume</label>
        <input type="text" name="noro" class="form-control" placeholder="No Volume" id="nomor" value="<?=$nomor['nomor']?>">
        <div class="error" id="ntf_volume"></div>
      </div>
       <button type="button" class="btn btn-primary" id="submit">Submit</button>
    </div>


</div>
</div>
  </form>
        <?php } ?>
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
    $('body').on('click','#submit', function(){
      $('#progresLoading').modal('show');
      var form_data = new FormData();
      form_data.append('nomor', $('#nomor').val());
      form_data.append('volume', $('#volume').val());
      form_data.append('journal', $('#journal').val());
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

    $('body').on('click','#journal', function(){
      // $('#progresLoading').modal('show');
      var id = $(this).val();
      if (id == '') {

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
            "url": "<?php echo site_url('user/journal/ajax_list_no_volume')?>",
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