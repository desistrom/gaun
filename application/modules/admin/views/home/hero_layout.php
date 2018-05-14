<style type="text/css">
  .form-group{
    width: 50%;
  }
</style>
<div class="box ">
  <div class="box-header with-border">
    <h3 class="box-title">Hero Layout</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <div class="form-group">
        <label>Link Video</label>
        <input type="text" name="link" class="form-control" id="link" placeholder="Enter Link Video ..." value="<?=$hero['link_video'];?>">
        <span style="color: #3c8dbc;font-style: italic;">your link must be embed format like this : https://www.youtube.com/embed/-QhronPdyWM</span>
        <div class="error" id="ntf_link"></div>
      </div>
      <div class="form-group">
        <label>Judul Hero</label>
        <?php echo $this->ckeditor->editor("judul", $hero['title'] ); ?>
        <input type="hidden" name="judul" class="form-control" id="judul" placeholder="Enter judul Hero ..." >
        <div class="error" id="ntf_judul"></div>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <?php echo $this->ckeditor->editor("content", $hero['content'] ); ?>
        <input type="hidden" name="content" value="<?php if(isset($hero)){ echo $hero['content']; } ?>" id="content">
        <div class="error" id="ntf_content"></div>
      </div>
      <input type="hidden" name="id" value="<?php if(isset($hero)){ echo $hero['id_hero']; } ?>">

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
      // console.log($('form').val());
      $('#content').val(CKEDITOR.instances.content.getData());
      $('#judul').val(CKEDITOR.instances.judul.getData());
      console.log($('#judul').val());
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