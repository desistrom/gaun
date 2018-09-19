<style type="text/css">
  .file-group{
    padding-bottom: 1em;
  }
  .file-group .error{
    position: absolute;
    bottom: 0;
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
  .fa-upload{
    padding-right: 10px;
  }
</style>
<div class="col col-md-12 col-sm-12 col-xs-12">
<div class="box" style="padding-top: 1.5em;">
  <!--   <div class="box-header with-border">
        <h3 class="box-title">Logo Website</h3>
    </div> -->
    <div class="box-body">
    <div class="col col-md-6 col-sm-7 col-xs-12">
      <div class="form-group">
      <label>Picture</label>
        <div class="col col-md-12 form-goup-file">
          <div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="userfile"><i class="fa fa-upload"></i>Choose File</label></div>
          <div class="input-file-left"><input type="file" class="form-control file" name="userfile" id="userfile"></div> 
          <div><i>*for best result use 450x240 px. <br> Max file size 400KB, Width 200px - 1024px. <br>Allowed file type : jpeg, jpg, png, gif.</i></div> 
          <div class="error" id="ntf_userfile"></div>
          <div class="error" id="ntf_error"></div> 
        </div>
      <!-- <label>Picture</label>
        <input type="file" class="form-control" name="userfile" id="userfile">
        <div class="error" id="ntf_userfile"></div>
        <div class="error" id="ntf_error"></div> -->
      </div>
      
    </div>
       <div class="col col-md-6 col-sm-5 col-xs-12" style="text-align: center;"><img width="50%" src="<?=base_url();?>media/<?=$image['logo'];?>"></div>
       <div class="col col-md-12 col-sm-12 col-xs-12"><button type="button" class="btn btn-primary" id="submit">Submit</button></div> 
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