<style type="text/css">
  #cke_content{
    width: 100% !important;
  }
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

<?php if ($view == 'list') { ?>
<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="col col-md-12 col-sm-12 col-xs-12">
  
<div class="box">
	<div class="box-body">
		<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
			<a href="<?=site_url('instansi/user/add');?>" class="btn btn-bg">Tambah Admin Journal</a>
		</div>
		<div class="col col-md-12 col-xs-12 table-responsive">
			<table class="table table-bordered  dataTable" id="table">
				<thead>
					<th>No</th>
					<th>Username</th>
					<th>status</th>
					<th>Opsi</th>
				</thead>
				<tbody>
				</tbody>
			</table>
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
<?php }elseif ($view == 'add') { ?>
<form role="form">
  <div class="col col-md-12 col-sm-12 col-xs-12" style="padding-top: 1em;">
    <div class="panel">
      <div class="panel-header" style="background-color:  #F5F5F5;">
          <div class="box-header with-border">
            <h3 class="box-title"> Add User</h3>
          </div>
      </div>
      <div class="panel-body"><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username ..." value="">
            <div class="error" id="ntf_username"></div>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Enter Username ..." value="">
            <div class="error" id="ntf_email"></div>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <div class="error" id="ntf_password"></div>
          </div>
          <div class="form-group">
            <label>Re-type Password</label>
            <input type="password" name="repassword" id="repassword" class="form-control">
            <div class="error" id="ntf_repassword"></div>
          </div>
         <button type="button" class="btn btn-bg" id="submit">Submit</button>
        </div>
      </div>
    </div>
  </div>
</form>
  
<?php }else{ ?>
<form role="form">
  <div class="col col-md-12 col-sm-12 col-xs-12" style="padding-top: 1em;">
    <div class="panel">
      <div class="panel-header" style="background-color:  #F5F5F5;">
          <div class="box-header with-border">
            <h3 class="box-title"> Add User</h3>
          </div>
      </div>
      <div class="panel-body"><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username ..." value="<?=$user['username']?>">
            <div class="error" id="ntf_username"></div>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <div class="error" id="ntf_password"></div>
          </div>
          <div class="form-group">
            <label>Re-type Password</label>
            <input type="password" name="repassword" id="repassword" class="form-control">
            <div class="error" id="ntf_repassword"></div>
          </div>
         <button type="button" class="btn btn-bg" id="submit">Submit</button>
        </div>
      </div>
    </div>
  </div>
</form>
<?php } ?>
<div class="modal" tabindex="-1" role="dialog" id="modal_comment">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Success</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
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
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      $('#progresLoading').modal('show');
      var form_data = new FormData();
      form_data.append('username', $('#username').val());
      form_data.append('email', $('#email').val());
      form_data.append('password', $('#password').val());
      form_data.append('repassword', $('#repassword').val());
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
    $('body').on('click','.btn_status', function(){
      var id = $(this).attr('id');
      $.ajax({
          url : base_url+'admin/news/status',
          dataType : 'json',
          type : 'POST',
          data : {'id' : id}
      }).done(function(data){
        console.log(data);
        window.location.href = window.location.href;
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
            "url": "<?php echo site_url('instansi/user/ajax_list')?>",
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