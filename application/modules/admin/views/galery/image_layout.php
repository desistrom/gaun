<style type="text/css">
  .form-group{
    width: 50%;
  }
</style>
<div class="box ">
  <div class="box-header with-border">
    <h3 class="box-title">Image Galery</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- text input -->
      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" id="judul" placeholder="Enter ..." value="<?php if(isset($galery)){ echo $galery['judul']; } ?>">
        <div class="error" id="ntf_judul"></div>
      </div>
      <!-- textarea -->
      <div class="form-group">
        <label>Deskribsi</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Enter ..." ><?php if(isset($galery)){ echo $galery['deskripsi']; } ?></textarea>
        <div class="error" id="ntf_deskripsi"></div>
      </div>

      <div class="form-group">
        <label>Album</label>
        <select class="form-control" name="album" id="album">
          <option value="">--- Select Album ---</option>
          <?php foreach ($album as $key => $value): ?>
            <option <?php if(isset($galery)){ if($galery['id_album'] == $value['id_album']){ echo " selected "; } } ?> value="<?=$value['id_album'];?>"><?=$value['judul_album'];?></option>
          <?php endforeach ?>
        </select>
        <div class="error" id="ntf_album"></div>
      </div>

      <div class="form-group">
      <label>File</label>
        <input type="file" class="form-control file" name="file_name[]" id="file_name">
        <div style="font-style: italic;">*for best result use 450x240 px</div>
        <div class="error" id="ntf_file_name"></div>
        <div class="error" id="ntf_error"></div>
      </div>

      <div class="form-group">
      <label>File</label>
        <input type="file" class="form-control file" name="file_name[]" id="file_name">
        <div style="font-style: italic;">*for best result use 450x240 px</div>
        <div class="error" id="ntf_file_name"></div>
        <div class="error" id="ntf_error"></div>
      </div>

      <div class="form-group">
      <label>File</label>
        <input type="file" class="form-control file" name="file_name[]" id="file_name">
        <div style="font-style: italic;">*for best result use 450x240 px</div>
        <div class="error" id="ntf_file_name"></div>
        <div class="error" id="ntf_error"></div>
      </div>

      <div class="form-group">
      <label>File</label>
        <input type="file" class="form-control file" name="file_name[]" id="file_name">
        <div style="font-style: italic;">*for best result use 450x240 px</div>
        <div class="error" id="ntf_file_name"></div>
        <div class="error" id="ntf_error"></div>
      </div>

      <div class="form-group">
      <label>File</label>
        <input type="file" class="form-control file" name="file_name[]" id="file_name">
        <div style="font-style: italic;">*for best result use 450x240 px</div>
        <div class="error" id="ntf_file_name"></div>
        <div class="error" id="ntf_error"></div>
      </div>

      <div class="add_more"></div>

      <button type="button" class="btn btn-danger" id="add"><i class="fa fa-plus"></i> Add More</button> | <button type="button" class="btn btn-primary" id="submit">Submit</button>

    </form>
  </div>
  <!-- /.box-body -->
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      var form_data = new FormData();
      var file_data = [];
      var data_error = '';
      $('.file').each(function() {
          form_data.append('file_names[]', $(this).prop('files')[0]);
          if ($(this).prop('files')[0] != undefined) {
            var file = $(this).prop('files')[0];
            var fileType = file["type"];
            var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
            if ($.inArray(fileType, ValidImageTypes) < 0) {
                 data_error = $(this).parent().find('#ntf_file_name').text('Your type file is false');
                 $('.error').css({'color':'red', 'font-style':'italic'});
            }
          }else{
            data_error = $(this).parent().find('#ntf_file_name').text('Please Select File');
          }
      });
      if ($('#judul').val() == '') {
        $('.error').css({'color':'red', 'font-style':'italic'});
        data_error = $('#ntf_judul').text('The Judul field is required.');
      }
      if ($('#deskripsi').val() == '') {
        $('.error').css({'color':'red', 'font-style':'italic'});
        data_error = $('#ntf_deskripsi').text('The Deskripsi field is required.');
      }
      if ($('#album').val() == '') {
        $('.error').css({'color':'red', 'font-style':'italic'});
        data_error = $('#ntf_album').text('The Judul field is required.');
      }
      if (data_error != '') {
        return;
      }
      form_data.append('judul', $('#judul').val());
      form_data.append('deskripsi', $('#deskripsi').val());
      form_data.append('album', $('#album').val());
      
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
    $('body').on('click','#add',function(){
      var data = '<div class="form-group"><label>File</label><input type="file" class="form-control file" name="file_name[]" id="file_name"><div style="font-style: italic;">*for best result use 450x240 px</div><div class="error" id="ntf_file_name"></div><div class="error" id="ntf_error"></div></div>';
      $('.add_more').append(data);
    });
    /*$('body').on('keyup','#judul',function(){
      var file = $('.file').val();
      var form_data = new FormData();
      var file_data = [];
      $('.file').each(function(key,value){
        file_data.push($(this).prop('files')[0]);
      });
      console.log(file_data);
    });*/
    // $.each(file,function(key,value){
    //   array_push(file,$);
    // });
  });
</script>