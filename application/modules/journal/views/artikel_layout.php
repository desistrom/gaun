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
  .error{
    color: red;
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
    #cke_content,#cke_references{
    width: 100%!important;
  }
  .box-author{
    border:solid #CBCBCB 1px;
    border-radius: 5px;
    padding: 15px;
  }
  .form-file{
    height: auto;
    overflow: hidden;
  }
   .btn-create-new{
    float: right;
    border-radius: 4px;
    padding: 3px 10px;

  }
  .form-group{
    height: auto;
    overflow: hidden;
  }
</style>
<div class="col col-md-8">
          <!-- Horizontal Form -->
          <div class=" box box-bordered col-col-md-12 col0sm-12 col-xs-12 ">
            <div class="box-header ">
              <h3 class="box-title">Content Artikel</h3>
            </div>
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="judul journal" class="  text-left">judul Artikel</label>
                  <div class="">
                    <input type="text" class="form-control new-input" id="judul" placeholder="judul Artikel">
                    <div class="error" id="ntf_judul"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="judul journal" class="  text-left">Deskripsi</label>
                  <div class="">
                    <?php echo $this->ckeditor->editor("content","" ); ?>
                    <input type="hidden" name="content" id="content">
                    <div class="error" id="ntf_content"></div>
                  </div>
                </div>
              <div class="form-group">
                <label for="keyword" class="  text-left">Keyword</label>
                <div class="">
                  <input type="text" class="form-control new-input" id="keyword" placeholder="Keyword">
                  <div class="error" id="ntf_keyword"></div>
                </div>
              </div>
              <div class="form-group">
                  <label for="judul journal" class="  text-left">references</label>
                  <div class="">
                    <?php echo $this->ckeditor->editor("references","" ); ?>
                    <input type="hidden" name="references" id="ref">
                    <div class="error" id="ntf_ref"></div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="box box-bordered col col-md-12 col-sm-12 col-xs-12">
            <div class="box-header">
              <h3 class="box-title">Setting Artikel</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="journal" class="  text-left">journal</label>

                <div class="">
                  <select class="form-control new-input" id="journal" placeholder="journal">
                    <option value="">--Pilih Journal--</option>
                    <?php foreach ($journal as $key => $value): ?>
                      <option value="<?=$value['id_journal']?>"><?=$value['judul'];?></option>
                    <?php endforeach ?>
                  </select>
                  <div class="error" id="ntf_journal"></div>
                </div>   
              </div>
              <div class="form-group">
                <label for="volume" class="  text-left">volume</label>
                <div class="">
                  <select class="form-control new-input" id="volume" placeholder="volume" style="margin-bottom: 10px;">
                    <option value="">--Pilih Journal--</option>
                  </select>
                  <div class="error" id="ntf_volume"></div>
                   <a href="<?=site_url('journal/admin/volume');?>" class="btn-bg btn-success btn-create-new"><i>Create New Volume</i></a>
                </div>   
              </div>
              <div class="form-group">
                <label for="no_volume" class="  text-left">No Volume</label>

                <div class="">
                  <select class="form-control new-input" id="no_volume" placeholder="No Volume" style="margin-bottom: 10px;">
                    <option value="">--Pilih Journal--</option>
                  </select>
                  <div class="error" id="ntf_no_volume"></div>
                  <a href="<?=site_url('journal/admin/novolume');?>" class="btn-bg btn-success btn-create-new"><i>Create New No Volume</i></a>
                </div>   
              </div>
                <div class="form-group form-file">
                  <label for="gambar_journal" class="  text-left">Paper file</label>
                  <div class="">
                    <div class="col col-md-12 form-goup-file">
                    <div class="input-file-right text-left"><label class="btn btn-success btn-choose-foto btn-green" style="text-align: left;" for="file_name"><i class="fa fa-paperclip" ></i> Choose File</label></div>
                    <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
                  <div><i>Max file size 100MB <br>Allowed file type : pdf, docx</i></div> 
            <div class="error" id="ntf_file_name"></div> 
            <div class="error" id="ntf_error"></div>
                  </div>
                  </div>
                </div>
                  <div class="form-group form-file">
                  <label for="gambar_journal" class="  text-left">Abstrak file</label>
                  <div class="">
                    <div class="col col-md-12 form-goup-file">
                    <div class="input-file-right text-left"><label class="btn btn-success btn-choose-foto btn-green" style="text-align: left;" for="file_name_abs"><i class="fa fa-paperclip" ></i> Choose File</label></div>
                    <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name_abs" id="file_name_abs"></div> 
                    <div><i>Max file size 100MB <br>Allowed file type : pdf, docx</i></div> 
            <div class="error" id="ntf_file_name_abs"></div> 
            <div class="error" id="ntf_abs_error"></div>
                  </div>
                  </div>
                </div>
               <div class="box-author" style="margin-bottom: 15px;">
                  <div class="form-group">
                    <label for="author_name" class="text-left">Nama Author</label>
                    <div class="">
                      <input type="text" class="form-control new-input nama" id="author_name" placeholder="Nama Author">
                      <div class="error" id="ntf_nama"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="jabatan" class="text-left">Jabatan Author</label>
                    <div class="">
                      <input type="text" class="form-control new-input jabatan" id="jabatan" placeholder="Jabatan Author">
                      <div class="error" id="ntf_jabatan"></div>
                    </div>
                  </div>
               </div>
               <div class="more"></div>
               <div class="form-group form-file" style="margin-top: 15px;">
                    <button type="submit" class="btn btn_more btn-success btn-green pull-right"><i class="fa fa-plus"></i> Add more</button>
              </div>
              <div class="form-group" style="padding-top: 15px;" >
          <table>
            <tr style="background-color: #269913;padding: 10px;">
              <td style="padding-top:15px;padding-left: 10px;"><input type="checkbox" name="agree" id="agree" value="1" style="float: left;margin-top: -1.5em; margin-right: 5px;"></td>
              <td><p class="form-control-static" style="color: white;padding: 0;">Saya Telah membaca dan menyetujui semua persayratan dan peraturan yang di ajukan</p></td>
            </tr>
          </table>
          
          
          <div class="error" id="ntf_agree"></div>
        </div>
            </div>
              <div class="box-footer">
                <button type="button" class="btn btn-success btn-green pull-right " id="submit_artikel">Save</button>
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
    
    $('body').on('click','#submit_artikel', function(){
      // $('.error').html('');
      // $('#progresLoading').modal('show');
      var nama = [];
      var jabatan = [];
      var form_data = new FormData();
      $.each($('.nama'),function(i){
        nama.push($(this).val());
      });

      $.each($('.jabatan'),function(i){
        jabatan.push($(this).val());
      });
      // console.log(nama);
      var file_data = $('#file_name').prop('files')[0];
      var file_data_abs = $('#file_name_abs').prop('files')[0];
      $('#content').val(CKEDITOR.instances.content.getData());
      $('#ref').val(CKEDITOR.instances.references.getData());
      var er = '';
      if ($('#judul').val() == '') {
        er = 1;
        $('#ntf_judul').html('The Judul Journal field is required.');
      }
      if ($('#content').val() == '') {
        er = 1;
        $('#ntf_content').html('The Content field is required.');
      }
      if ($('#journal').val() == '') {
        er = 1;
        $('#ntf_journal').html('The journal field is required.');
      }
      if ($('#volume').val() == '') {
        er = 1;
        $('#ntf_volume').html('The volume field is required.');
      }
      if ($('#no_volume').val() == '') {
        er = 1;
        $('#ntf_no_volume').html('The no_volume field is required.');
      }
      if ($('#keyword').val() == '') {
        er = 1;
        $('#ntf_keyword').html('The keyword field is required.');
      }
      if ($('#ref').val() == '') {
        er = 1;
        $('#ntf_ref').html('The references field is required.');
      }
      var uri = get_url(window.location.href);
      if ($.isNumeric(uri)) {
        if (file_data != undefined) {
          if (file_data.size > 3000000) {
            er = 1;
            $('#ntf_file_name').html('The file size is too large.');
          }
          if (file_data.type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && file_data.type != 'application/pdf' ) {
            er = 1;
            $('#ntf_error').html('File Type not Allowed.');
          }
        }

        if (file_data_abs != undefined) {
          if (file_data_abs.size > 3000000) {
            er = 1;
            $('#ntf_file_name_abs').html('The file size is too large.');
          }
          if (file_data_abs.type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && file_data_abs.type != 'application/pdf' ) {
            er = 1;
            $('#ntf_abs_error').html('File Type not Allowed.');
          }
        }
      }else{
        if (file_data == undefined) {
          er = 1;
          $('#ntf_file_name').html('The Journal Cover field is required.');
        }else{
          if (file_data.size > 3000000) {
            er = 1;
            $('#ntf_file_name').html('The file size is too large.');
          }
          if (file_data.type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && file_data.type != 'application/pdf' ) {
            er = 1;
            console.log('asasdd');
            $('#ntf_error').html('File Type not Allowed.');
          }
        }
        if (file_data_abs == undefined) {
          er = 1;
          $('#ntf_file_name_abs').html('The Journal Cover field is required.');
        }else{
          if (file_data_abs.size > 3000000) {
            er = 1;
            $('#ntf_file_name_abs').html('The file size is too large.');
          }
          if (file_data_abs.type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && file_data_abs.type != 'application/pdf' ) {
            er = 1;
            console.log('asd');
            $('#ntf_abs_error').html('File Type not Allowed.');
          }
        }
      }
      if ($('#agree').is(':checked') != true) {
        er = 1;
        $('#ntf_agree').html('The Agreement field is required.');
      }
      if (er == 1) {
        // console.log(file_data);
        $('.error').show();
        $('.error').css({'color':'red', 'font-style':'italic', 'display':'block'});
        $('#progresLoading').modal('hide');
        return false;
      }
      $('#progresLoading').modal('show');
      form_data.append('judul', $('#judul').val());
      form_data.append('journal', $('#journal').val());
      form_data.append('volume', $('#volume').val());
      form_data.append('no_volume', $('#no_volume').val());
      form_data.append('content', $('#content').val());
      form_data.append('keyword', $('#keyword').val());
      form_data.append('ref', $('#ref').val());
      form_data.append('nama', nama);
      form_data.append('jabatan', jabatan);
      if ($('#agree').is(':checked')) {
        form_data.append('agree', 1);
      }
      // console.log($('#ref').val());
      // return false;
      // form_data.append('tgl_event', $('#tgl_event').val());
      // form_data.append('start_event', $('#start_event').val());
      // form_data.append('end_event', $('#end_event').val());
      form_data.append('file_name', file_data);
      form_data.append('file_name_abs', file_data_abs);
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

    $('body').on('click','.btn-delete',function(){
      var id = $(this).attr('id');
      if ($('.btn-delete').length == 1) {
        alert('Minimal harus satu author');
        return false;
      }
      if (confirm('Anda Ingin Menghapus Author ini ?')) {
      $.ajax({
        url : base_url+'user/journal/delete_author/'+id,
        // data : {'nama' : nama, 'jabatan' : jabatan},
        dataType: 'json',
        type : 'POST'
      }).done(function(data){
        // console.log($(this));
        if (data.status == 1) {
          $('.card_'+id).remove();
          // ini.addClass('btn-edit');
          // ini.removeClass('btn-save');
          // ini.addClass('btn-info');
          // ini.removeClass('btn-success');
          // ini.text('Edit');
          // $('.nama_'+id).prop('disabled',true);
          // $('.jabatan_'+id).prop('disabled',true);
          // window.location.href = data.url;
        }
        $.each(data.notif,function(key,value){
          $('.error').show();
          $('#ntf_'+ key+'_'+id).html(value);
          $('#ntf_'+ key+'_'+id).css({'color':'red', 'font-style':'italic'});
        });
      });
      }
      console.log(id);
    });

    $('body').on('click','.btn-edit',function(){
      var id = $(this).attr('id');
      $(this).removeClass('btn-edit');
      $(this).addClass('btn-save');
      $(this).removeClass('btn-info');
      $(this).addClass('btn-success');
      $(this).text('Save');
      $('.nama_'+id).prop('disabled',false);
      $('.jabatan_'+id).prop('disabled',false);
      console.log(id);
    });

    $('body').on('click','.btn-save', function(){
      var id = $(this).attr('id');
      var nama = $('.nama_'+id).val();
      var jabatan =  $('.jabatan_'+id).val();
      var ini = $(this);
      // var status = 1;
      console.log($(this));
      $.ajax({
        url : base_url+'user/journal/save_author/'+id,
        data : {'nama' : nama, 'jabatan' : jabatan},
        dataType: 'json',
        type : 'POST'
      }).done(function(data){
        console.log($(this));
        if (data.status == 1) {
          ini.addClass('btn-edit');
          ini.removeClass('btn-save');
          ini.addClass('btn-info');
          ini.removeClass('btn-success');
          ini.text('Edit');
          $('.nama_'+id).prop('disabled',true);
          $('.jabatan_'+id).prop('disabled',true);
          // window.location.href = data.url;
        }
        $.each(data.notif,function(key,value){
          $('.error').show();
          $('#ntf_'+ key+'_'+id).html(value);
          $('#ntf_'+ key+'_'+id).css({'color':'red', 'font-style':'italic'});
        });
      });
    });

    $('body').on('click','.btn_more',function(){
      var html = '<div class="box-author" style="margin-bottom: 15px;"> <div class="form-group"> <label for="author_name" class="text-left">Nama Author</label> <div class=""> <input type="text" class="form-control new-input nama" id="author_name" placeholder="Nama Author"> <div class="error" id="ntf_nama"></div></div></div><div class="form-group"> <label for="jabatan" class="text-left">Jabatan Author</label> <div class=""> <input type="text" class="form-control new-input jabatan" id="jabatan" placeholder="Jabatan Author"> <div class="error" id="ntf_jabatan"></div></div></div></div>';
      $('.more').append(html);
    });

    $('body').on('click','#volume', function(){
      // $('#progresLoading').modal('show');
      var id = $(this).val();
      if (id == '') {

      }
      $.ajax({
          url : base_url+'journal/admin/no_volume/'+id,
          dataType : 'json',
          async : false,
          cache : false ,
          contentType : false , 
          processData : false
      }).done(function(data){
        console.log(data);
        $('#no_volume').html(data);
      });
    });

    $('body').on('click','#journal', function(){
      // $('#progresLoading').modal('show');
      var id = $(this).val();
      if (id == '') {
        return false;
      }
      $.ajax({
          url : base_url+'journal/admin/select_volume/'+id,
          dataType : 'json',
          async : false,
          cache : false ,
          contentType : false , 
          processData : false
      }).done(function(data){
        console.log(data);
        $('#volume').html(data);
      });
    });
    $('#modalSuccess').modal('show');
  });
</script>