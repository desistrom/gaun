<style type="text/css">
  .tab-pane{
    padding: 2em 1em 1em 1em;
  }
  .tab-content>.active{
    border:solid 1px #3C8DBC ;
  }
  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
    background-color: #3C8DBC;
    color: white;
  }
  .nav-tabs{
    border-bottom:none;
  }
  .component-penta{
    padding-top: 1.5em;
  }
  .nav>li>a:hover, .nav>li>a:active, .nav>li>a:focus{
    background:  #3C8DBC;
    color: white;
  }
</style>
<div class="box ">
  <div class="box-header with-border">
    <h2 class="box-title">penta Page</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form role="form">
      <!-- textarea -->

      <!-- <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="<?php if(isset($penta)){ echo $penta['judul']; } ?>" id="title">
        <div class="error" id="ntf_title"></div>
      </div> -->

      <div class="form-group">
        <label><h3>Content</h3></label>
        <?php echo $this->ckeditor->editor("deskripsi", $penta['deskripsi'] ); ?>
        <input type="hidden" name="deskripsi" value="" id="deskripsi">
        <div class="error" id="ntf_deskripsi"></div>
      </div>


<div class="component-penta">

  <h2>component</h2>
  <br>
  <ul class="nav nav-tabs primary">
    <li class="active"><a data-toggle="tab" href="#menu1">Research</a></li>
    <li><a data-toggle="tab" href="#menu2">Education</a></li>
    <li><a data-toggle="tab" href="#menu3">Network</a></li>
  </ul>

  <div class="tab-content">
    
    <div id="menu1" class="tab-pane fade in active">
      <div class="form-group">
        <label>Title Research</label>
        <input type="text" name="research" class="form-control" value="<?php if(isset($penta_res)){ echo $penta_res['judul']; } ?>" id="research">
        <div class="error" id="ntf_research"></div>
      </div>

      <div class="form-group">
        <label>Icon Research</label>
        <input type="text" name="icon_res" class="form-control" value="<?php if(isset($penta_res)){ echo $penta_res['icon']; } ?>" id="icon_res">
        <div class="error" id="ntf_icon_res"></div>
      </div>

      <div class="form-group">
        <label>Content Research</label>
        <?php echo $this->ckeditor->editor("content_res", $penta_res['deskripsi'] ); ?>
        <input type="hidden" name="content_res" value="" id="content_res">
        <div class="error" id="ntf_content_res"></div>
      </div>

      <div class="form-group">
        <label>No Urut</label>
        <input type="number" name="sort_res" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_res['sort']; } ?>" id="sort_res">
        <div class="error" id="ntf_sort_res"></div>
      </div>

    </div>
    <div id="menu2" class="tab-pane fade">
       <div class="form-group">
        <label>Title Education</label>
        <input type="text" name="education" class="form-control" value="<?php if(isset($penta_edu)){ echo $penta_edu['judul']; } ?>" id="research" id="education">
        <div class="error" id="ntf_education"></div>
      </div>

      <div class="form-group">
        <label>Icon Education</label>
        <input type="text" name="icon_edu" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_edu['icon']; } ?>" id="icon_edu">
        <div class="error" id="ntf_icon_edu"></div>
      </div>

      <div class="form-group">
        <label>Content</label>
        <?php echo $this->ckeditor->editor("content_edu", $penta_edu['deskripsi'] ); ?>
        <input type="hidden" name="content_edu" value="" id="content_edu">
        <div class="error" id="ntf_content_edu"></div>
      </div>

      <div class="form-group">
        <label>No Urut</label>
        <input type="number" name="sort_edu" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_edu['sort']; } ?>" id="sort_edu">
        <div class="error" id="ntf_sort_edu"></div>
      </div>
    </div>
    <div id="menu3" class="tab-pane fade ">
     
          <div class="form-group">
            <label>Title Network</label>
            <input type="text" name="network" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_net['judul']; } ?>" id="network">
            <div class="error" id="ntf_network"></div>
          </div>

          <div class="form-group">
            <label>Icon Network</label>
            <input type="text" name="icon_net" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_net['icon']; } ?>" id="icon_net">
            <div class="error" id="ntf_icon_net"></div>
          </div>

          <div class="form-group">
            <label>Content Network</label>
            <?php echo $this->ckeditor->editor("content_net", $penta_net['deskripsi'] ); ?>
            <input type="hidden" name="content_net" value="" id="content_net">
            <div class="error" id="ntf_content_net"></div>
          </div>

          <div class="form-group">
            <label>No Urut</label>
            <input type="number" name="sort_net" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_net['sort']; } ?>" id="sort_net">
            <div class="error" id="ntf_sort_net"></div>
          </div>
    </div>

      <button type="button" class="btn btn-primary" id="submit" style="margin-top: 1.5em;">Submit</button>

    </form>
  </div>
    </div>
  </div>
</div>



























<!-- 
      <div class="form-group">
        <label>Title Network</label>
        <input type="text" name="network" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_net['judul']; } ?>" id="network">
        <div class="error" id="ntf_network"></div>
      </div>

      <div class="form-group">
        <label>Icon Network</label>
        <input type="text" name="icon_net" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_net['icon']; } ?>" id="icon_net">
        <div class="error" id="ntf_icon_net"></div>
      </div>

      <div class="form-group">
        <label>Content Network</label>
        <?php echo $this->ckeditor->editor("content_net", $penta_net['deskripsi'] ); ?>
        <input type="hidden" name="content_net" value="" id="content_net">
        <div class="error" id="ntf_content_net"></div>
      </div>

      <div class="form-group">
        <label>No Urut</label>
        <input type="number" name="sort_net" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_net['sort']; } ?>" id="sort_net">
        <div class="error" id="ntf_sort_net"></div>
      </div> -->

     <!--  <div class="form-group">
        <label>Title Research</label>
        <input type="text" name="research" class="form-control" value="<?php if(isset($penta_res)){ echo $penta_res['judul']; } ?>" id="research">
        <div class="error" id="ntf_research"></div>
      </div>

      <div class="form-group">
        <label>Icon Research</label>
        <input type="text" name="icon_res" class="form-control" value="<?php if(isset($penta_res)){ echo $penta_res['icon']; } ?>" id="icon_res">
        <div class="error" id="ntf_icon_res"></div>
      </div>

      <div class="form-group">
        <label>Content Research</label>
        <?php echo $this->ckeditor->editor("content_res", $penta_res['deskripsi'] ); ?>
        <input type="hidden" name="content_res" value="" id="content_res">
        <div class="error" id="ntf_content_res"></div>
      </div>

      <div class="form-group">
        <label>No Urut</label>
        <input type="number" name="sort_res" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_res['sort']; } ?>" id="sort_res">
        <div class="error" id="ntf_sort_res"></div>
      </div>
 -->
    <!--   <div class="form-group">
        <label>Title Education</label>
        <input type="text" name="education" class="form-control" value="<?php if(isset($penta_edu)){ echo $penta_edu['judul']; } ?>" id="research" id="education">
        <div class="error" id="ntf_education"></div>
      </div>

      <div class="form-group">
        <label>Icon Education</label>
        <input type="text" name="icon_edu" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_edu['icon']; } ?>" id="icon_edu">
        <div class="error" id="ntf_icon_edu"></div>
      </div>

      <div class="form-group">
        <label>Content</label>
        <?php echo $this->ckeditor->editor("content_edu", $penta_edu['deskripsi'] ); ?>
        <input type="hidden" name="content_edu" value="" id="content_edu">
        <div class="error" id="ntf_content_edu"></div>
      </div>

      <div class="form-group">
        <label>No Urut</label>
        <input type="number" name="sort_edu" class="form-control" value="<?php if(isset($penta_net)){ echo $penta_edu['sort']; } ?>" id="sort_edu">
        <div class="error" id="ntf_sort_edu"></div>
      </div>

      <button type="button" class="btn btn-primary" id="submit">Submit</button>

    </form>
  </div> -->
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
      $('#deskripsi').val(CKEDITOR.instances.deskripsi.getData());
      $('#content_res').val(CKEDITOR.instances.content_res.getData());
      $('#content_net').val(CKEDITOR.instances.content_net.getData());
      $('#content_edu').val(CKEDITOR.instances.content_edu.getData());
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