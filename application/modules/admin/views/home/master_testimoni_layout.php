<style type="text/css">
  .form-group{
    width: 50%;
  }
</style>
<div class="box ">
<?php if($view == 'list'){ ?>
<div class="box">
  <div class="box-body">
    <div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
      <a href="<?=site_url('admin/home/add_testimoni');?>" class="btn btn-success">Tambah Testimoni</a>
    </div>
    <div class="col col-md-12 col-xs-12">
  <table class="table table-bordered  dataTable">
    <tr>
      <th>No</th>
      <th>Nama User</th>
      <th>Email</th>
      <th>Content</th>
      <th>aksi</th>
    </tr>
    <?php foreach ($testimoni as $key => $value): ?>
      <tr>
        <td><?=($key+1);?></td>
        <td><?=$value['name'];?></td>
        <td><?=$value['email'];?></td>
        <td><?=$value['content'];?></td>
        <td>
          <!-- <button class="btn btn-default">disable</button> -->
          <a href="<?=site_url('admin/home/edit_testimoni/'.$value['id_testimoni']);?>"><button class="btn btn-primary" id="edit">Edit</button></a>
          <a href="<?=site_url('admin/home/status_testimoni/'.$value['id_testimoni']);?>"><button class="btn btn-info" id="edit"><?php if($value['is_aktif'] == 1){ ?> Enable <?php }else{ ?> Disable <?php } ?></button></a>
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


<?php }elseif($view == 'add'){ ?>
  <div class="box-header with-border">
    <h3 class="box-title">General Elements</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- textarea -->
      <div class="form-group">
        <label>Testimoni</label>
        <?php echo $this->ckeditor->editor("content", ''); ?>
        <input type="hidden" name="content" value="" id="content">
        <div class="error" id="ntf_content"></div>
      </div>
      <button type="button" class="btn btn-primary" id="submit">Submit</button>

    </form>
  </div>
  <?php }else{ ?>
  <div class="box-header with-border">
    <h3 class="box-title">General Elements</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- textarea -->
      <div class="form-group">
        <label>testimoni</label>
        <?php echo $this->ckeditor->editor("content", $testimoni['content'] ); ?>
        <input type="hidden" name="content" value="<?php if(isset($testimoni)){ echo $testimoni['content']; } ?>" id="content">
        <div class="error" id="ntf_content"></div>
      </div>
      <input type="hidden" name="id" value="<?php if(isset($testimoni)){ echo $testimoni['id_testimoni']; } ?>">

      <button type="button" class="btn btn-primary" id="submit">Submit</button>

    </for

  <?php } ?>
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript" src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      // console.log($('form').val());
      $('#content').val(CKEDITOR.instances.content.getData());
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
  });
</script>