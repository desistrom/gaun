<style type="text/css">
  .form-group{
    width: 50%;
  }
</style>
<div class="box ">
  <div class="box-header with-border">
    <h3 class="box-title">Manage Layanan</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <div class="form-group">
      <label>Logo Instansi</label>
        <input type="file" class="form-control" name="userfile" id="userfile">
        <div class="error" id="ntf_userfile"></div>
        <div class="error" id="ntf_error"></div>
      </div>
      <img width="50%" src="<?=base_url();?>media/<?=$layanan['gambar'];?>">
      <div class="form-group">
        <label>Judul layanan</label>
        <input type="text" name="judul" class="form-control" id="judul" placeholder="Enter judul layanan ..." value="<?=$layanan['title'];?>">
        <div class="error" id="ntf_judul"></div>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <?php echo $this->ckeditor->editor("content", $layanan['content'] ); ?>
        <input type="hidden" name="content" value="<?php if(isset($layanan)){ echo $layanan['content']; } ?>" id="content">
        <div class="error" id="ntf_content"></div>
      </div>
      <input type="hidden" name="id" value="<?php if(isset($layanan)){ echo $layanan['id_layanan']; } ?>">

      <button type="button" class="btn btn-primary" id="submit">Submit</button>

    </form>
  </div>
  <!-- /.box-body -->
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
<script type="text/javascript" src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      var form_data = new FormData();
      var data_file = $('#userfile').prop('files')[0];
      form_data.append('userfile',data_file);
      form_data.append('judul',$('#judul').val());
      $('#content').val(CKEDITOR.instances.content.getData());
      form_data.append('content',$('#content').val());
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
    $('#modalSuccess').modal('show');
  });
</script>