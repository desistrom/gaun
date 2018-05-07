<style type="text/css">
  .form-group{
    width: 50%;
  }
</style>
<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="box ">
<?php if($view == 'list'){ ?>
<div class="box">
  <div class="box-body">
    <div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
      <a href="<?=site_url('admin/galery/add_album');?>" class="btn btn-success">Tambah Album</a>
    </div>
    <div class="col col-md-12 col-xs-12">
  <table class="table table-bordered  dataTable" id="example2">
    <tr>
      <th>No</th>
      <th>Nama alnum</th>
      <th>key album</th>
      <th>Tanggal Kegiatan</th>
      <th>aksi</th>
    </tr>
    <?php foreach ($album as $key => $value): ?>
      <tr>
        <td><?=($key+1);?></td>
        <td><?=$value['judul_album'];?></td>
        <td><?=$value['key_album'];?></td>
        <td><?= date("d M Y", strtotime($value['tgl_kegiatan']));?></td>
        <td>
          <!-- <button class="btn btn-default">disable</button> -->
          <a href="<?=site_url('admin/galery/edit_album/'.$value['id_album']);?>"><button class="btn btn-primary" id="edit">Edit</button></a>
        </td>
      </tr>
    <?php endforeach ?>
  </table>
  <div class="col col-md-12 col-xs-12 text-right">
    <!-- <a href="#" class="btn btn-default">Setting</a> -->
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
  <div class="box-header with-border">
    <h3 class="box-title">Add Testimoni</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- textarea -->
      <div class="form-group">
        <label>Nama Album</label>
        <input type="text" name="name" class="form-control" value="" id="name" placeholder="Masukan Judul Album ...">
        <div class="error" id="ntf_name"></div>
      </div>

      <div class="form-group">
        <label>Tanggal Kegiatan</label>
        <input type="date" name="tgl" class="form-control" value="" id="tgl">
        <div class="error" id="ntf_tgl"></div>
      </div>

      <button type="button" class="btn btn-primary" id="submit_add">Submit</button>

    </form>
  </div>
<?php }else{ ?>
  <div class="box-header with-border">
    <h3 class="box-title">Add Testimoni</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- textarea -->
      <div class="form-group">
        <label>Nama Album</label>
        <input type="text" name="name" class="form-control" value="<?=$content['judul_album'];?>" id="name" placeholder="Masukan Judul Album ...">
        <div class="error" id="ntf_name"></div>
      </div>

      <div class="form-group">
        <label>Tanggal Kegiatan</label>
        <input type="date" name="tgl" class="form-control" value="<?=$content['tgl_kegiatan'];?>" id="tgl">
        <div class="error" id="ntf_tgl"></div>
      </div>
      <!-- <div class="col-md-12"> -->
      <div class="form-group">
        <label>Photo Album</label>
        <input type="file" name="file_name[]" class="form-control file" id="file_name">
        <div class="error" id="ntf_name"></div>
      </div>
      <div class="add_file"></div>
      <div class="form-group">
        <button style="float: right; margin-right: -120px; margin-top: -50px" type="button" class="btn btn-danger btn_add"><i class="fa fa-plus"></i> Add More</button>
      </div>
      <div class="form-group">
        <button type="button" class="btn btn-primary" id="submit">Submit</button>
      </div>

      <!-- </div> -->
      <div style="margin-top: 10px" class="col-md-12">
      <?php if($image != ''){ foreach ($image as $key => $value): ?>
        <div class="col-md-3">
          <img class="col-md-12" style="margin:10px 0px" src="<?=base_url().'assets/media/'.$value['file_name'];?>">
          <button type="button" style="position: absolute; margin-left: -35px; margin-top: 10px" class="btn btn-danger btn-xs btn_remove" id="<?=$value['id_galery'];?>"><i class="fa fa-times"></i></button>
        </div>
      <?php endforeach; } ?>
      </div>

    </form>
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
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript" src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit_add', function(){
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
    $('body').on('click','#submit', function(){
      $('.error').text('');
      var form_data = new FormData();
      $('#progresLoading').modal('show');
      var file_data = [];
      var data_error = '';
      $('.file').each(function(i) {
          form_data.append('file_names[]', $(this).prop('files')[0]);
          if ($(this).prop('files')[0] != undefined) {
            file_data.push(i);
            var file = $(this).prop('files')[0];
            var fileType = file["type"];
            var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
            if ($.inArray(fileType, ValidImageTypes) < 0) {
                 var image_error = $(this).parent().find('#ntf_file_name').text('Your type file is false');
                 $('.error').css({'color':'red', 'font-style':'italic'});
            }
          }
      });
      if ($('#nama').val() == '') {
        $('.error').css({'color':'red', 'font-style':'italic'});
        data_error = $('#ntf_nama').text('The Judul field is required.');
      }
      if ($('#tgl').val() == '') {
        $('.error').css({'color':'red', 'font-style':'italic'});
        data_error = $('#ntf_tgl').text('The Deskripsi field is required.');
      }
      if (data_error != '') {
        $('#progresLoading').modal('hide');
        return;
      }
      form_data.append('name', $('#name').val());
      form_data.append('tgl', $('#tgl').val());
      
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
        $('#progresLoading').modal('hide');
          console.log(data);
          if(data.state == 1){
            if (data.status == 1) {
              window.location.href = window.location.href;
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
    $('body').on('click','.btn_remove',function(){
      var id = $(this).attr('id');
      if(confirm('Anda ingin Menghapusnya dari album ??')){
        $.ajax({
          url : base_url+'admin/galery/change',
          dataType : 'json',
          data : {'id' : id},
          type : 'POST'
        }).done(function(data){
          if (data.status == 1) {
            window.location.href = window.location.href;
          }
        });
      }
    });
    $('body').on('click','.btn_add',function(){
      var html = '<div class="form-group"><label>Photo Album</label><input type="file" name="file_name" class="form-control file" id="file_name"><div class="error" id="ntf_name"></div></div>';
      $('.add_file').append(html);
    });
    $('#modalSuccess').modal('show');
  });
</script>