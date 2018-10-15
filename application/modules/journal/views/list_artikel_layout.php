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
   .box-thumbnail .header-box-thumbnail{
    height: 190px;
    overflow: hidden;
    padding: 6px;
    position: relative;
    background-color: white;
   }
    
     .box-thumbnail .header-box-thumbnail .filter-button-action{
      

       top: 0;
       width: 100%;
       text-align: right;
     }
  
   .box-thumbnail .header-box-thumbnail .btn-action{
    height: 30px;
    width: 30px;
    background-color: #5AA7DF;
    box-shadow: 2px 2px 3px 0 #000000;
    border-radius: 50%;
    position: absolute;
    top: 0;
    right: -4em;
    margin:7px;
    transition: 0.4s;
    animation-delay: 0.2s;
    text-align: center;
   }
  
   .box-thumbnail .header-box-thumbnail .btn-action{
    padding-top: 6px;
    display: inline-block;
    color: white;
   }
   
    .box-thumbnail:hover .header-box-thumbnail .btn-action{
      right: 0;
      
    }
  /* 
    .box-thumbnail:hover{
         box-shadow: 1px 1px 2px 0 #000000;
    }
  */
   .box-thumbnail .header-box-thumbnail .btn-action a i{
    color: white;
   }
  
   .box-thumbnail .header-box-thumbnail .btn-action:hover{
    background-color: #247AB8;
   }
 
  .box-thumbnail .thumbnail-cover{
    width: 100%;
  }
  
   .box-thumbnail .body-box-thumbnail{
    padding: 10px 10px;
    background-color: white;
margin-top: -11px;
   }
  
   .box-thumbnail .footer-box-thumbnail{
    padding: 5px 10px;
    background-color: #F7F7F7;

   }
    .box-thumbnail  .title-thumbnail a{
  text-decoration: none;
  text-align: center;
  color: #7B7B7B;
  font-size: 14px;
  font-weight: 600;
}
 .box-thumbnail .body-box-thumbnail{
  color: #A2A2A2;
  font-size: 10px;
  font-weight: 400;
}
 .box-thumbnail{
   background-color: #F7F7F7
}
.sub-footer-box-thumbnail{
  display: inline-block;
}
.sub-footer-box-thumbnail .btn{
  padding-top: 2px;
  padding-bottom: 0;
  margin-top: 5px;
}
.float-right{
  float: right;
}
.btn-upload{
  display: none;
}
</style>

<?php if ($view == 'list') { ?>
<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="col col-md-12 col-sm-12 col-s-12">
  <div class="filter-box-thumbnail col-md-3 col-sm-3 col-xs-3 " style="padding-bottom: 2em;">
        <div class="box-thumbnail" style="border:solid 1px #CBCBCB;">
          <div class="header-box-thumbnail">
            <img class="thumbnail-cover" src="<?=base_url();?>assets/media/<?=$journal['futured_image'];?>">
            <!-- <div class="filter-button-action">
              <div>
                <a href="#">
                  <div class="btn-action">
                    <i class="fa fa-pencil"></i>
                    
                  </div>
                </a>
              </div>
            </div> -->
          </div>
          <div class="body-box-thumbnail">
            <h4 class="title-thumbnail"><a href="#"><?=$journal['judul']?></a></h4>

          </div>

        </div>
      </div>
</div>
<div class="col col-md-12 col-sm-12 col-xs-12">
 
<div class="box">
	<div class="box-body">
		<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
			<!-- <a href="<?=site_url('instansi/add_berita');?>" class="btn btn-success">Tambah News</a> -->
		</div>
		<div class="col col-md-12 col-xs-12 table-responsive">
			<table class="table table-bordered  dataTable" id="table">
				<thead>
					<th>No.</th>
          <th>Judul Artikel</th>
          <th>Volume</th>
          <th>No. Journal</th>
          <!-- <th>Journal</th> -->
          <th>Status</th>
          <th>Action</th>
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
            <h3 class="modal-title"><?=$this->session->flashdata('header');?></h3>
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
  <div class="modal" tabindex="-1" role="dialog" id="modalacc">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Atention</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="id" value="">
            <p>Do You Want To Accept This Article ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-acc_action">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalign">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Atention</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="id" value="">
            <p>Do You Want To Ignore This Article ?</p>
            <label>Type your reason</label>
            <textarea class="form-control" name="reason" id="reason"></textarea>
            <div class="error" id="ntf_reason"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-ign_action">Yes</button>
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
<div class="modal" tabindex="-1" role="dialog" id="modalReason">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Reason</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p></p>
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
    $('body').on('click','.btn-acc', function(){
      var id = $(this).attr('id');
      console.log(id);
      $('#modalacc #id').val(id);
      $('#modalacc').modal('show');
    });

    $('body').on('click','.btn-ign', function(){
      var id = $(this).attr('id');
      $('#modalign #id').val(id);
      $('#modalign').modal('show');
    });

    $('body').on('click','.btn-acc_action', function(){
      var id = $('#modalacc #id').val();
      var status = 1;
      // console.log(id);
      $.ajax({
        url : base_url+'journal/admin/response_artikel/'+'<?=$id;?>',
        data : {'id' : id, 'status' : status},
        dataType: 'json',
        type : 'POST'
      }).done(function(data){
        window.location.href = data.url;
      });
    });


    $('body').on('click','.btn-ign_action', function(){
      var id = $('#modalign #id').val();
      var status = 2;
      var reason = $('#reason').val();
      // console.log(id);
      $.ajax({
        url : base_url+'journal/admin/response_artikel/'+'<?=$id;?>',
        data : {'id' : id, 'status' : status, 'reason' : reason},
        dataType: 'json',
        type : 'POST'
      }).done(function(data){
        window.location.href = data.url;
      });
      // $('#modalign').modal('show');
    });
    $('body').on('click','.btn-detail', function(){
      var id = $(this).attr('id');
      // var status = 1;
      // console.log(id);
      $.ajax({
        url : base_url+'journal/admin/detail_artikel/'+id,
        data : {'id' : id},
        dataType: 'json',
        type : 'POST'
      }).done(function(data){
        $('#modalDetail h3').html(data.judul);
        $('#modalDetail #abs').html(data.abstrak);
        $('#modalDetail #author').html(data.nama);
        $('#modalDetail #volume').html(data.volume);
        $('#modalDetail #nomor').html(data.nomor);
        $('#modalDetail #keyword').html(data.keyword);
        $('#modalDetail #file').html('<a href="'+base_url+'assets/file/'+data.file+'" class="btn btn-success"><i class="fa fa-download"></i></a>');
        $('#modalDetail').modal('show');
        // window.location.href = data.url;

      });
    });

    $('body').on('click','.btn-reason',function(){
      var id = $(this).attr('id');
      $.ajax({
          url : base_url+'journal/admin/reason/'+id,
          dataType : 'json',
          async : false,
          cache : false ,
          contentType : false , 
          processData : false
      }).done(function(data){
        console.log(data);
        $('#modalReason .modal-body').html(data);
        $('#modalReason').modal('show');
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
            "url": "<?php echo site_url('journal/admin/ajax_list/'.$id)?>",
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