<form role="form">
<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-top: 1em;">
  <div class="panel ">
      <div class="panel-header" style="background-color:  #F5F5F5;">
        <div class="box-header with-border">
        <h3 class="box-title">Volume</h3>
      </div>
    </div>
    <div class="panel-body col col-md-6 col-sm-6 col-xs-12">
      <!-- textarea -->
      <div class="form-group">
        <label>No Volume*</label>
        <input type="text" name="noro" class="form-control new-input" placeholder="No Volume" id="nomor">
        <div class="error" id="ntf_volume"></div>
      </div>
      <div class="form-group">
        <label>Journal*</label>
        <select class="form-control new-input" name="journal" id="journal">
          <option value="">-- Pilih Journal --</option>
            <?php foreach ($journal as $key => $value): ?>
              <option value="<?=$value['id_journal']?>"><?=$value['judul'];?></option>
            <?php endforeach ?>
        </select>
        <div class="error" id="ntf_journal"></div>
      </div>
      <div class="form-group">
        <label>Volume*</label>
        <select class="form-control new-input" name="volume" id="volume">
          <option value="">-- Pilih Volume --</option>
        </select>
        <div class="error" id="ntf_volume"></div>
      </div>
       <div class="box-footer">
                <button type="button" id="submit" class="btn btn-success btn-green pull-right ">Save</button>
              </div>
    </div>


</div>
</div>
  </form>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      $('#progresLoading').modal('show');
      var form_data = new FormData();
      form_data.append('nomor', $('#nomor').val());
      form_data.append('volume', $('#volume').val());
      form_data.append('journal', $('#journal').val());
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
    $('body').on('click','#journal', function(){
      // $('#progresLoading').modal('show');
      var id = $(this).val();
      if (id == '') {

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