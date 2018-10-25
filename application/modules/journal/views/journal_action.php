
<style type="text/css">
     .new-input{
      background-color: #EEE8E8;
    }
    .btn-green{
      background-color: #269913;
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
  .box-content{
    background-color: transparent;
  }
  .panel .panel-header{
    border-bottom: solid 1px #A8A8A8;
    padding-left: 15px;
    
  }
  #cke_content{
    width: 100%!important;
  }
</style>
<div class="col col-md-8">
          <!-- Horizontal Form -->
          <div class=" box box-bordered col-col-md-12 col0sm-12 col-xs-12 ">
            <div class="box-header ">
              <h3 class="box-title">Create Journal</h3>
            </div>
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="judul journal" class="  text-left">judul journal*</label>

                  <div class="">
                    <input type="text" class="form-control new-input" id="judul" placeholder="judul journal" value="<?php $a=''; if(isset($journal)){ echo $journal['judul']; $a=$journal['deskripsi']; } ?>">
                    <div class="error" id="ntf_judul"></div>
                  </div>
                </div>
                <?php if(!isset($journal)){ ?>
                <div class="form-group">
                  <label>User Author*</label>
                  <select class="form-control select2" style="width: 100%;" id="user">
                    <option value="">--Pilih User--</option>
                    <?php foreach ($user as $key => $value): ?>
                      <option value="<?=$value['id_pengguna'];?>"><?=$value['nama'];?></option>             
                    <?php endforeach ?>
                  </select>
                  <div class="error" id="ntf_user"></div>
                </div>
                <?php } ?>
                <div class="form-group">
                  <label for="judul journal" class="  text-left">Deskripsi*</label>

                  <div class="">
                    <?php echo $this->ckeditor->editor("content",$a ); ?>
                    <input type="hidden" name="content" id="content">
                    <div class="error" id="ntf_content"></div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="box box-bordered col col-md-12 col-sm-12 col-xs-12">
            <div class="box-header">
              <h3 class="box-title">Create Journal</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="judul journal" class="  text-left">ISSN journal</label>

                <div class="">
                  <input type="text" class="form-control new-input" id="issn" placeholder="ISSN journal" value="<?php if(isset($journal)){ $journal['issn']; }?>">
                </div>
              </div>
              <div class="form-group">
                <label for="kategori" class="  text-left">Kategori journal*</label>

                <div class="">
                  <select class="form-control new-input" id="kategori" placeholder="Kategori journal">
                    <option value="">--Pilih Kategori--</option>
                    <?php foreach ($kategori as $key => $value): ?>
                      <option <?php if(isset($journal)){ if($journal['id_kategori_ref'] == $value['id_kategori']){ ?> selected <?php } } ?> value="<?=$value['id_kategori'];?>"><?=$value['nama'];?></option>  
                    <?php endforeach ?>
                  </select>
                  <div class="error" id="ntf_kategori"></div>
                </div>
                <div class="form-group">
                  <label for="gambar_journal" class="  text-left">gambar journal*</label>

                  <div class="">
                    <div class="col col-md-12 form-goup-file">
                    <div class="input-file-right text-left"><label class="btn btn-success btn-choose-foto btn-green" style="text-align: left;" for="file_name"><i class="fa fa-film" ></i> image*</label></div>
                    <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
                    <div><i>*for best result use 450x240 px. <br> Max file size 400KB, Width 200px - 1024px. <br>Allowed file type : jpeg, jpg, png, gif.</i></div> 
        <div class="error" id="ntf_file_name"></div> 
        <div class="error" id="ntf_error"></div> 
                  </div>
                  </div>
                  <?php if(isset($journal)){ ?>
                  <img src="<?=base_url();?>assets/media/<?=$journal['futured_image'];?>" style="width: 100%;" >
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="box-footer">
                <button type="button" id="submit" class="btn btn-success btn-green pull-right ">Save</button>
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
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="0"
                          aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            0%
                          </div>
                        </div>
                      </div>
                      <!-- <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                      </div> -->
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Loading" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
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
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      // $('#progresLoading').modal('show');
      var form_data = new FormData();
      var file_data = $('#file_name').prop('files')[0];
      $('#content').val(CKEDITOR.instances.content.getData());
      $('.error').hide();
      $('.error').text('');

      var file_data = $('#file_name').prop('files')[0];
      var er = '';
      $('#content').val(CKEDITOR.instances.content.getData());
      if ($('#judul').val() == '') {
        er = 1;
        $('#ntf_judul').html('The Judul Journal field is required.');
      }
      // if ($('#issn').val() == '') {
      //   er = 1;
      //   $('#ntf_issn').html('The Judul Journal field is required.');
      // }
      // console.log($('#file_name').prop('files'));
      if ($('#content').val() == '') {
        er = 1;
        $('#ntf_content').html('The Content field is required.');
      }
      if ($('#kategori').val() == '') {
        er = 1;
        $('#ntf_kategori').html('The Kategori field is required.');
      }
      if ($('#user').val() == '') {
        er = 1;
        $('#ntf_user').html('The user field is required.');
      }
      var uri = get_url(window.location.href);
      if ($.isNumeric(uri)) {
        if (file_data != undefined) {
          if (file_data.size > 400000) {
            er = 1;
            $('#ntf_file_name').html('The file size is too large.');
          }
          var img = new Image();
          img.src = window.URL.createObjectURL( file_data );
          img.onload = function() {
              var width = img.naturalWidth,
                  height = img.naturalHeight;

              window.URL.revokeObjectURL( img.src );

              if( width > 1024) {
                  er = 1;
                  $('#ntf_error').html('The File Width is too large.');
              }
          };
          if (file_data.type != 'image/jpg' && file_data.type != 'image/png' && file_data.type != 'image/jpeg' && file_data.type != 'image/gif') {
            er = 1;
            $('#ntf_error').html('File Type not Allowed.');
          }
        }
      }else{
        if (file_data == undefined) {
          er = 1;
          $('#ntf_file_name').html('The Journal Cover field is required.');
        }else{
          if (file_data.size > 400000) {
            er = 1;
            $('#ntf_file_name').html('The file size is too large.');
          }
          var img = new Image();
          img.src = window.URL.createObjectURL( file_data );
          img.onload = function() {
              var width = img.naturalWidth,
                  height = img.naturalHeight;

              window.URL.revokeObjectURL( img.src );

              if( width > 1024) {
                  er = 1;
                  $('#ntf_error').html('The File Width is too large.');
              }
          };
          if (file_data.type != 'image/jpg' && file_data.type != 'image/png' && file_data.type != 'image/jpeg' && file_data.type != 'image/gif') {
            er = 1;
            $('#ntf_error').html('File Type not Allowed.');
          }
        }
      }
      
      

      if (er == 1) {
        $('#Loading').modal('show');
        $('.error').show();
        $('.error').css({'color':'red', 'font-style':'italic','display':'block'});
        $('#Loading').modal('hide');
        return false;
      }
      $('#progresLoading').modal('show');
      form_data.append('judul', $('#judul').val());
      form_data.append('issn', $('#issn').val());
      form_data.append('content', $('#content').val());
      form_data.append('kategori', $('#kategori').val());
      form_data.append('user', $('#user').val());
      form_data.append('file_name', file_data);
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

    function progress(e){

      if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;

        var Percentage = (current * 100)/max;
        var st = String(Percentage);
        var a = st.split('.');
        Percentage = a[0];
        $('#progresLoading .progress-bar').prop('aria-valuenow',Percentage);
        $('#progresLoading .progress-bar').text(Percentage+'%');
        $('#progresLoading .progress-bar').css({'width': Percentage+'%'});
        console.log(Percentage);


        if(Percentage >= 100)
        {
           // process completed  
        }
      }  
     }

    function get_url(url){
      return url.split('/').pop()
    }

    $('#modalSuccess').modal('show');
  });
</script>