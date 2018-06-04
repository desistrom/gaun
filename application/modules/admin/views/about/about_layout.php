<style type="text/css">
  .form-group{
 
  }
  #cke_content{
    width: 100% !important;
  }
  .tablink {
    background-color: #1E282C;
    color: white;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 25%;
}

.tablink:hover {
    background-color: #CF090A;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
    color: ;
    display: none;
    height: auto;
    overflow: hidden;
    padding-bottom: 1em;
}

/*#Home {background-color: red;}
#News {background-color: green;}
#Contact {background-color: blue;}
#About {background-color: orange;}*/
.heading-tab{
  height: auto;
  overflow: hidden;
  background-color: #1E282C;
}
.list-founder{
  border-bottom: solid #E0E0E0 1px;
  padding: 15px 0;
}
.foot-tab{
  text-align: right;
  background-color: white;
  padding: 1em;
  border-top: solid 4px #E0E0E0;
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
  .box{
    margin-bottom: 0;
  }
  .list-founder:hover{
    background-color: #F7F7F7;
  }
</style>
<div class="col col-md-12 col-sm-12 col-xs-12">
  <div class="box">
    <div class="heading-tab">
      <button class="tablink" onclick="openPage('About', this, '#BD0E0E')" id="defaultOpen">Description</button>
      <button class="tablink" onclick="openPage('Founder', this, '#BD0E0E')" >Founder</button>
    </div>
      
      
  <form role="form">

      <div id="About" class="tabcontent">
         <div class="form-group">
            <!-- <label>About</label> -->
            <?php echo $this->ckeditor->editor("content", $about['content'] ); ?>
            <input type="hidden" name="content" value="" id="content">
            <div class="error" id="ntf_content"></div>
        <input type="hidden" name="id" id="id" value="<?php if(isset($about)){ echo $about['id_about']; } ?>"  >
          </div>
      </div>

      <div id="Founder" class="tabcontent">
      <?php if(count($founder) > 0){ foreach ($founder as $key => $value): ?>
       
        <div class="col-md-12 list-founder" style="padding-top: 1em;">
        <div class="col-md-3">
          <label>Nama Founder</label>
          <input type="text" name="name" class="form-control name" value="<?=$value['nama'];?>" id="name" placeholder="Masukan Nama Founder">
          <div class="error" id="ntf_name"></div>
        </div>

        <div class="col-md-4">
          <label>Jabatan Founder</label>
          <input type="text" name="jabatan" class="form-control jabatan" value="<?=$value['jabatan'];?>" id="jabatan" placeholder="Masukan Jabatan Founder">
          <div class="error" id="ntf_jabatan"></div>
        </div>

        <div class="col-md-2 form-group">
          <label>Photo Founder</label>
          <div class="col col-md-12 form-goup-file">
            <div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="file_name_<?=($key+1);?>"><i class="fa fa-upload" ></i>Choose File</label></div>
            <div class="input-file-left"><input type="file" class="form-control file" name="file_name[]" id="file_name_<?=($key+1);?>"></div> 
            <div class="error" id="ntf_file_name"></div> 
            <img src="<?=base_url().'assets/media/'.$value['foto'];?>" width="250px" style="display: none">
          </div>
        </div>
       <!--  <div class="col-md-2">
          <label>Photo Founder</label>
          <input type="file" name="file_name[]" class="form-control file" id="file_name">
          <div class="error" id="ntf_file_name"></div>
          <img src="<?=base_url().'assets/media/'.$value['foto'];?>" width="250px" style="display: none">
        </div> -->
        <div class="col-md-1">
          <label>Sort</label><br>
          <input type="number" name="sort" class="form-control sort" value="<?=$value['sort'];?>">
          <div class="error" id="ntf_sort"></div>
        </div>
        <div class="col-md-1">
          <label>Photo</label><br>
          <a id="<?=base_url().'assets/media/'.$value['foto'];?>" href="#" class="foto">Click Here</a>
        </div>
        <div class="col-md-1">
          <label>Delete</label><br>
          <button class="btn btn-danger btn-xs delete" id="<?=$value['id_founder']?>" type="button"><i class="fa fa-times"></i></button>
        </div>
        <input type="hidden" name="id_founder[]" class="id_founder" id="id_founder" value="<?=$value['id_founder'];?>">
        </div>
      <?php endforeach; }else{ ?>
        <div class="col-md-12 list-founder" style="padding-top: 1em;">
        <hr><div class="col-md-3">
          <label>Nama Founder</label>
          <input type="text" name="name" class="form-control name" value="" id="name" placeholder="Masukan Nama Founder">
          <div class="error" id="ntf_name"></div>
        </div>

        <div class="col-md-4">
          <label>Jabatan Founder</label>
          <input type="text" name="jabatan" class="form-control jabatan" value="" id="jabatan" placeholder="Masukan Jabatan Founder">
          <div class="error" id="ntf_jabatan"></div>
        </div>

        <div class="col-md-2 form-group">
          <label>Photo Founder</label>
          <div class="col col-md-12 form-goup-file">
            <div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="file_name_1"><i class="fa fa-upload" ></i>Choose File</label></div>
            <div class="input-file-left"><input type="file" class="form-control file" name="file_name[]" id="file_name_1"></div> 
            <div class="error" id="ntf_file_name"></div> 
          </div>
        </div>

        <!-- <div class="col-md-2">
          <label>Photo Founder</label>
          <input type="file" name="file_name[]" class="form-control file" id="file_name_1">
          <div class="error" id="ntf_file_name"></div>
        </div> -->
        <div class="col-md-1">
          <label>Sort</label><br>
          <input type="number" name="sort" class="form-control sort" value="">
          <div class="error" id="ntf_sort"></div>
        </div>
        <input type="hidden" name="id_founder[]" class="id_founder" id="id_founder" value="">
      <?php } ?>
      <div class="add_file"></div>
      <div class="col-md-12">
        <button style="float: right;  margin-top: 10px" type="button" class="btn btn-danger btn_add"><i class="fa fa-plus"></i> Add More</button>
      </div>
      </div>
      </div>
      <div class="col-md-12 foot-tab">
        <button type="button" class="btn btn-primary" id="submit">Submit</button>
      </div> 

    </form>
  </div>
</div>
<!-- <div class="col col-md-12 col-sm-12 col-xs-12">
  
<div class="box ">
  <div class="box-header with-border">
    <h3 class="box-title">About Page</h3>
  </div>

  <div class="box-body">
    <form role="form">

      <div class="form-group">
        <label>About</label>
        <?php echo $this->ckeditor->editor("content", $about['content'] ); ?>
        <input type="hidden" name="content" value="" id="content">
        <div class="error" id="ntf_content"></div>
      </div>

      <input type="hidden" name="id" value="<?php if(isset($about)){ echo $about['id_about']; } ?>">
      <?php if(count($founder) > 0){ foreach ($founder as $key => $value): ?>
        <hr>
        <div class="col-md-12">
        <div class="col-md-3">
          <label>Nama Founder</label>
          <input type="text" name="name" class="form-control name" value="<?=$value['nama'];?>" id="name" placeholder="Masukan Nama Founder">
          <div class="error" id="ntf_name"></div>
        </div>

        <div class="col-md-4">
          <label>Jabatan Founder</label>
          <input type="text" name="jabatan" class="form-control jabatan" value="<?=$value['jabatan'];?>" id="jabatan" placeholder="Masukan Jabatan Founder">
          <div class="error" id="ntf_jabatan"></div>
        </div>

        <div class="col-md-2">
          <label>Photo Founder</label>
          <input type="file" name="file_name[]" class="form-control file" id="file_name">
          <div class="error" id="ntf_file_name"></div>
          <img src="<?=base_url().'assets/media/'.$value['foto'];?>" width="250px" style="display: none">
        </div>
        <div class="col-md-1">
          <label>Sort</label><br>
          <input type="number" name="sort" class="form-control sort" value="<?=$value['sort'];?>">
          <div class="error" id="ntf_sort"></div>
        </div>
        <div class="col-md-1">
          <label>Photo</label><br>
          <a id="<?=base_url().'assets/media/'.$value['foto'];?>" href="#" class="foto">Click Here</a>
        </div>
        <div class="col-md-1">
          <label>Delete</label><br>
          <button class="btn btn-danger btn-xs delete" id="<?=$value['id_founder']?>" type="button"><i class="fa fa-times"></i></button>
        </div>
        <input type="hidden" name="id_founder[]" class="id_founder" id="id_founder" value="<?=$value['id_founder'];?>">
        </div>
      <?php endforeach; }else{ ?>
        <hr><div class="col-md-4">
          <label>Nama Founder</label>
          <input type="text" name="name" class="form-control name" value="" id="name" placeholder="Masukan Nama Founder">
          <div class="error" id="ntf_name"></div>
        </div>

        <div class="col-md-4">
          <label>Jabatan Founder</label>
          <input type="text" name="jabatan" class="form-control jabatan" value="" id="jabatan" placeholder="Masukan Jabatan Founder">
          <div class="error" id="ntf_jabatan"></div>
        </div>

        <div class="col-md-1">
          <label>Sort</label><br>
          <input type="number" name="sort" class="form-control sort" value="">
          <div class="error" id="ntf_sort"></div>
        </div>

        <div class="col-md-4">
          <label>Photo Founder</label>
          <input type="file" name="file_name[]" class="form-control file" id="file_name">
          <div class="error" id="ntf_file_name"></div>
        </div>
        <input type="hidden" name="id_founder[]" class="id_founder" id="id_founder" value="">
      <?php } ?>
      <div class="add_file"></div>
      <div class="col-md-12">
        <button style="float: right; margin-right: 120px; margin-top: 10px" type="button" class="btn btn-danger btn_add"><i class="fa fa-plus"></i> Add More</button>
      </div>
      <div class="col-md-12">
        <button type="button" class="btn btn-primary" id="submit">Submit</button>
      </div>

    </form>
  </div>

</div>
</div> -->
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
  <div class="modal fade" id="progresLoading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<div class="modal" tabindex="-1" role="dialog" id="detail_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Foto Founder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript" src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit', function(){
      // console.log($('form').val());
      $('.error').css({'color':'red', 'font-style':'italic'});
      var form_data = new FormData();
      var error = '';
      $('#content').val(CKEDITOR.instances.content.getData());
      form_data.append('content',$('#content').val());
      form_data.append('id',$('#id').val());
      $('.file').each(function(i) {
          if ($(this).prop('files')[0] != undefined) {
            form_data.append('file_names[]', $(this).prop('files')[0]);
            form_data.append('file[]','file');
            console.log($(this).prop('files')[0]);
            var file = $(this).prop('files')[0];
            var fileType = file["type"];
            var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
            if ($.inArray(fileType, ValidImageTypes) < 0) {
                 error = $(this).parent().find('#ntf_file_name').text('Your type file is false');
                 $('.error').css({'color':'red', 'font-style':'italic'});
            }
          }else{
            console.log($(this).parent().parent().find('img').attr('src'));
            if ($(this).parent().parent().find('img').attr('src') == undefined) {
              error = $(this).parent().parent().find('#ntf_file_name').text('The Photo field is required.');
            }else{
              form_data.append('file[]','kosong');
            }
          }
      });
      $('.name').each(function(i){
        if ($(this).val() != '') {
          form_data.append('nama[]',$(this).val());
        }else{
          error = $(this).parent().find('#ntf_name').text('The Nama field is required.');
        }
      });

      $('.sort').each(function(i){
        if ($(this).val() != '') {
          form_data.append('sort[]',$(this).val());
        }else{
          error = $(this).parent().find('#ntf_sort').text('The Sort field is required.');
        }
      });

      $('.jabatan').each(function(i){
        if ($(this).val() != '') {
          form_data.append('jabatan[]',$(this).val());
        }else{
          error = $(this).parent().find('#ntf_jabatan').text('The Jabatan field is required.');
        }
      });

      $('.id_founder').each(function(i){
        form_data.append('id_founder[]',$(this).val());
      });
      if (error != '') {
        return false;
      }
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
    $('body').on('click','.btn_add',function(){
      var jumlah = $('.file').length;
      var looping = jumlah + 1;
      var html = '<hr><div class="col-md-12 list-founder"><div class="col-md-3"><label>Nama Founder</label><input type="text" name="name" class="form-control name" value="" id="name" placeholder="Masukan Nama Founder"><div class="error" id="ntf_name"></div></div><div class="col-md-4"><label>Jabatan Founder</label><input type="text" name="jabatan" class="form-control jabatan" value="" id="jabatan" placeholder="Masukan Jabatan Founder"><div class="error" id="ntf_jabatan"></div></div><div class="col-md-2 form-group"><label>Photo Founder</label><div class="col col-md-12 form-goup-file"><div class="input-file-right"><label class="btn btn-success btn-choose-foto" for="file_name_'+looping+'"><i class="fa fa-upload" ></i>Choose File</label></div><div class="input-file-left"><input type="file" class="form-control file" name="file_name[]" id="file_name_'+looping+'"></div><div class="error" id="ntf_file_name"></div></div></div><div class="col-md-1"><label>Sort</label><br><input type="number" name="sort" class="form-control sort" value=""><div class="error" id="ntf_sort"></div></div><input type="hidden" name="id_founder[]" class="id_founder" id="id_founder" value=""><div class="col-md-2"></div></div>';
      $('.add_file').append(html);
    });
    $('body').on('click','.foto',function(){
      var img = $(this).attr('id');
      data = '<img src="'+img+'" width="250px">';
      $('#detail_modal .modal-body').html(data);
      $('#progresLoading').modal('show');
      setTimeout(function(){
        $('#progresLoading').modal('hide');
        setTimeout(function(){ $('#detail_modal').modal('show'); },450);
        
      }, 3000);

    });

    $('body').on('click','.delete',function(){
      var id = $(this).attr('id');
      var nama = $(this).parent().parent().find('.name').val();
      if(confirm('Anda ingin Menghapusn Founder '+nama+'??')){
        $.ajax({
          url : base_url+"admin/about/delete_about",
          dataType : 'json',
          data : {'id' : id},
          type : 'POST'
        }).done(function(data){
          if (data.status == 1) {
            window.location.href = data.url;
          }
        });
      }
    });
    $('#modalSuccess').modal('show');
  });
</script>
<script>
function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
