<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Logo Website</h3>
    </div>
    <div class="box-body">
    <div class="form-group">
      <label>Favicon</label>
        <input type="file" class="form-control" name="userfile" id="userfile">
        <div class="error" id="ntf_userfile"></div>
        <div class="error" id="ntf_error"></div>
      </div>
        <button type="button" class="btn btn-primary" id="submit">Submit</button>
    </div>
    <?php if ($image['favicon'] != ''): ?>
      <img src="<?=base_url();?>media/crop/<?=$image['favicon'];?>">
    <?php endif ?>
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
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      var form_data = new FormData();
      var data_file = $('#userfile').prop('files')[0];
      form_data.append('userfile',data_file);
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