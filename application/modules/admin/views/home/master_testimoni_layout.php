<style type="text/css">
  .form-group{
    width: 100%;
  }
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
  }
  #cke_content{
    width: 100% !important;
  }
</style>
<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">


<?php if($view == 'list'){ ?>
<div class="col col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-body">
        <div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
          <a href="<?=site_url('admin/home/add_testimoni');?>" class="btn btn-success">Tambah Testimoni</a>
        </div>
        <div class="col col-md-12 col-xs-12 table-responsive">
          <table class="table table-bordered  dataTable" id="example2">
            <thead>
              <th>No</th>
              <th>Nama User</th>
              <th>Jabatan</th>
              <th>Content</th>
              <th>Sort</th>
              <th>Keterangan</th>
              <th width="100px">Action</th>
            </thead>
            <tbody>
            <?php foreach ($testimoni as $key => $value): ?>
              <tr>
                <td><?=($key+1);?></td>
                <td><?=$value['nama_user'];?></td>
                <td><?=$value['jabatan'];?></td>
                <td><?=word_limiter($value['content'],10);?></td>
                <td><?=$value['sort'];?></td>
                <td><?php if($value['is_aktif'] == 1){ ?> Enable <?php }else{ ?> Disable <?php } ?></td>
                <td>
                  <!-- <button class="btn btn-default">disable</button> -->
                  <a href="<?=site_url('admin/home/edit_testimoni/'.$value['id_testimoni']);?>" data-toggle="tooltip" title="edit"><button class="btn btn-info" id="edit"><i class="fa fa-pencil"></i></button></a>
                  <a href="<?=site_url('admin/home/status_testimoni/'.$value['id_testimoni']);?>"><button class="btn btn-success" id="edit"><?php if($value['is_aktif'] == 1){ ?> Disable <?php }else{ ?> Enable <?php } ?></button></a>
                </td>
              </tr>
            <?php endforeach ?>
            </tbody>
          </table>
          </div>
      <div class="col col-md-12 col-xs-12 text-right">
        <!-- <a href="#" class="btn btn-default">Setting</a> -->
      </div>

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
<?php }elseif($view == 'add'){ ?>
<!-- <div class="col col-md-12 col-sm-12 col-xs-12"> -->
    
    <!-- <div class="box"> -->
        <!-- <div class="box-header with-border">
          <h3 class="box-title">Add Testimoni</h3>
        </div> -->
       <!--  <div class="box-body"> -->
          <form role="form">
            <div class="col col-md-8 col-sm-8 col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading">Testimoni</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Testimoni</label>
                        <?php echo $this->ckeditor->editor("content", ''); ?>
                        <input type="hidden" name="content" value="" id="content">
                        <div class="error" id="ntf_content"></div>
                      </div>
                </div>
              </div>
            </div>
            <div class="col col-md-4 col-sm-4 col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading">Identitas</div>
                <div class="panel-body">
                    <div class="form-group">
                      <label>Nama User</label>
                      <input type="text" name="name" class="form-control" value="" id="name">
                      <div class="error" id="ntf_name"></div>
                    </div>

                    <div class="form-group">
                      <label>Jabatan</label>
                      <input type="text" name="jabatan" class="form-control" value="" id="jabatan">
                      <div class="error" id="ntf_jabatan"></div>
                    </div>

                    <div class="form-group">
                        <label>Gambar User</label>
                        <div class="col col-md-12 form-goup-file">
                            <div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="userfile">Choose File</label></div>
                            <div class="input-file-left"><input type="file" class="form-control file" name="userfile" id="userfile"></div> 
                            <div><i>*for best result use 450x240 px. <br>Allowed file type : jpeg, jpg, png, gif.</i></div>
                            <div class="error" id="ntf_userfile"></div>
                            <div class="error" id="ntf_error"></div> 
                        </div>
                      </div>
                      <div class="form-group">
                          <label>Urutan</label>
                          <input type="text" name="sort" class="form-control" value="" id="sort">
                          <div class="error" id="ntf_sort"></div>
                        </div>
                        <button type="button" class="btn btn-primary" id="submit">Submit</button>
                </div>
              </div>
            </div>
            <!-- <div class="form-group">
              <label>Nama User</label>
              <input type="text" name="name" class="form-control" value="" id="name">
              <div class="error" id="ntf_name"></div>
            </div>

            <div class="form-group">
              <label>Jabatan</label>
              <input type="text" name="jabatan" class="form-control" value="" id="jabatan">
              <div class="error" id="ntf_jabatan"></div>
            </div>

            <div class="form-group">
                <label>Gambar User</label>
                <div class="col col-md-12 form-goup-file">
                    <div class="input-file-right"><label class="btn btn-primary btn-choose-foto" for="userfile">Choose File</label></div>
                    <div class="input-file-left"><input type="file" class="form-control file" name="userfile" id="userfile"></div> 
                    <div class="error" id="ntf_userfile"></div>
                    <div class="error" id="ntf_error"></div> 
                </div>
              </div> -->
            <!-- <div class="form-group">
            <label>Gambar User</label>
              <input type="file" class="form-control" name="userfile" id="userfile">
              <div class="error" id="ntf_userfile"></div>
              <div class="error" id="ntf_error"></div>
            </div> -->

            <!-- <div class="form-group">
              <label>Testimoni</label>
              <?php echo $this->ckeditor->editor("content", ''); ?>
              <input type="hidden" name="content" value="" id="content">
              <div class="error" id="ntf_content"></div>
            </div> -->

            <!-- <div class="form-group">
              <label>Urutan</label>
              <input type="text" name="sort" class="form-control" value="" id="sort">
              <div class="error" id="ntf_sort"></div>
            </div>
            <button type="button" class="btn btn-primary" id="submit">Submit</button> -->

          </form>
       <!--  </div>
      </div> -->
    <!-- </div> -->
  <?php }else{ ?>
  <div class="box-header with-border">
    <h3 class="box-title">Edit Testimoni</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
        <form role="form">
            <div class="col col-md-8 col-sm-8 col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading">Testimoni</div>
                <div class="panel-body">
                    <div class="form-group">
                    <label>testimoni</label>
                    <?php echo $this->ckeditor->editor("content", $testimoni['content']); ?>
                    <input type="hidden" name="content" value="" id="content">
                    <div class="error" id="ntf_content"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col col-md-4 col-sm-4 col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading">Identitas</div>
                <div class="panel-body">
                  <div class="form-group">
                      <label>Nama User</label>
                      <input type="text" name="name" class="form-control" value="<?=$testimoni['nama_user'];?>" id="name">
                      <div class="error" id="ntf_name"></div>
                    </div>

                    <div class="form-group">
                      <label>Jabatan</label>
                      <input type="text" name="jabatan" class="form-control" value="<?=$testimoni['jabatan'];?>" id="jabatan">
                      <div class="error" id="ntf_jabatan"></div>
                    </div>
                    <div class="form-group">
                        <label>Gambar User</label>
                        <div class="col col-md-12 form-goup-file">
                            <div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="userfile">Choose File</label></div>
                            <div class="input-file-left"><input type="file" class="form-control file" name="userfile" id="userfile"></div> 
                            <div class="error" id="ntf_userfile"></div>
                            <div class="error" id="ntf_error"></div> 
                        </div>
                      </div>
                  <!--   <div class="form-group">
                    <label>Gambar User</label>
                      <input type="file" class="form-control" name="userfile" id="userfile">
                      <div class="error" id="ntf_userfile"></div>
                      <div class="error" id="ntf_error"></div>
                    </div> -->
                    <div class="form-group" style="text-align: center;">
                      <img src="<?=base_url();?>media/<?=$testimoni['gambar'];?>" width="50%">
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php if(isset($testimoni)){ echo $testimoni['id_testimoni']; } ?>">

                    <div class="form-group">
                      <label>Urutan</label>
                      <input type="text" name="sort" class="form-control" value="<?=$testimoni['sort'];?>" id="sort">
                      <div class="error" id="ntf_sort"></div>
                    </div>
                    <button type="button" class="btn btn-primary" id="submit">Submit</button>
                  
                </div>
              </div>
            </div>

      <!-- <div class="form-group">
        <label>Nama User</label>
        <input type="text" name="name" class="form-control" value="<?=$testimoni['nama_user'];?>" id="name">
        <div class="error" id="ntf_name"></div>
      </div>

      <div class="form-group">
        <label>Jabatan</label>
        <input type="text" name="jabatan" class="form-control" value="<?=$testimoni['jabatan'];?>" id="jabatan">
        <div class="error" id="ntf_jabatan"></div>
      </div>

      <div class="form-group">
      <label>Gambar User</label>
        <input type="file" class="form-control" name="userfile" id="userfile">
        <div class="error" id="ntf_userfile"></div>
        <div class="error" id="ntf_error"></div>
      </div>
      <div class="form-group">
        <img src="<?=base_url();?>media/<?=$testimoni['gambar'];?>" width="50%">
      </div> -->
      
      <!-- <div class="form-group">
        <label>testimoni</label>
        <?php echo $this->ckeditor->editor("content", $testimoni['content']); ?>
        <input type="hidden" name="content" value="" id="content">
        <div class="error" id="ntf_content"></div>
      </div> -->
      <!-- <input type="hidden" name="id" id="id" value="<?php if(isset($testimoni)){ echo $testimoni['id_testimoni']; } ?>">

      <div class="form-group">
        <label>Urutan</label>
        <input type="text" name="sort" class="form-control" value="<?=$testimoni['sort'];?>" id="sort">
        <div class="error" id="ntf_sort"></div>
      </div>
      <button type="button" class="btn btn-primary" id="submit">Submit</button> -->

    </form>

  <?php } ?>
</div>

<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript" src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      var form_data = new FormData();
      var data_file = $('#userfile').prop('files')[0];
      form_data.append('userfile',data_file);
      form_data.append('jabatan',$('#jabatan').val());
      form_data.append('name',$('#name').val());
      form_data.append('sort',$('#sort').val());
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