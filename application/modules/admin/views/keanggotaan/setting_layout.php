<style type="text/css">
  .form-group{
    width: 50%;
  }
</style>
<div class="box ">
  <div class="box-header with-border">
    <h3 class="box-title">Benefit dan Tata Cara Page</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- textarea -->
        

      <!-- <button type="button" class="btn btn-primary" id="submit">Submit</button> -->
      <?php if($view == 'cara'){ ?>
      <div class="form-group">
        <label>Image</label>
        <input type="file" name="userfile" value="" class="form-control" id="userfile">
        <div class="error" id="ntf_userfile"></div>
      </div>

      <img src="<?=base_url();?>media/<?=$content['image'];?>" width="450px">

      <div class="form-group">
        <label>Tata Cara</label>
        <?php echo $this->ckeditor->editor("cara", $content['cara'] ); ?>
        <input type="hidden" name="cara" value="<?php if(isset($content)){ echo $content['cara']; } ?>" id="cara">
        <div class="error" id="ntf_cara"></div>
      </div>
      <?php }else{ ?>
      <div class="form-group">
        <label>Benefit</label>
        <?php echo $this->ckeditor->editor("benefit", $content['profit'] ); ?>
        <input type="hidden" name="benefit" value="<?php if(isset($content)){ echo $content['profit']; } ?>" id="benefit">
        <div class="error" id="ntf_cara"></div>
      </div>
      <?php } ?>
      <input type="hidden" name="id" id="id" value="<?php if(isset($content)){ echo $content['id_setting']; } ?>">

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
      var form_data = new FormData();
      form_data.append('id',$('#id').val());
      <?php if($view == 'cara'){ ?>
      $('#cara').val(CKEDITOR.instances.cara.getData());
      var data_file = $('#userfile').prop('files')[0];
      form_data.append('userfile',data_file);
      form_data.append('cara',$('#cara').val());
      <?php }else{ ?>
      $('#benefit').val(CKEDITOR.instances.benefit.getData());
      form_data.append('benefit',$('#benefit').val());
      <?php } ?>
      // return false;
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
    $(document).ready(function () {
      $('#modalSuccess').modal('show');
    });
  });
</script>