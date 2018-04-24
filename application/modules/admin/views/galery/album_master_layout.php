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
      <th>Tanggal Kegiatan</th>
      <th>aksi</th>
    </tr>
    <?php foreach ($album as $key => $value): ?>
      <tr>
        <td><?=($key+1);?></td>
        <td><?=$value['judul_album'];?></td>
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

      <button type="button" class="btn btn-primary" id="submit">Submit</button>

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

      <button type="button" class="btn btn-primary" id="submit">Submit</button>

    </form>
  </div>
<?php } ?>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript" src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      // console.log($('form').val());
      // $('#content').val(CKEDITOR.instances.content.getData());
      // return false;
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
    $('#modalSuccess').modal('show');
  });
</script>