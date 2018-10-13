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
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="judul journal" class="  text-left">judul journal</label>

                  <div class="">
                    <input type="text" class="form-control new-input" id="judul journal" placeholder="judul journal">
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
              

                
               <!--  <div class="form-group">
                  <label for="volume" class="  text-left">volume</label>

                  <div class="">
                    <input type="text" class="form-control new-input" id="volume" placeholder="volume">
                  </div>
                </div>
                <div class="form-group">
                  <label for="no_volume" class="  text-left">no volume</label>

                  <div class="">
                    <input type="text" class="form-control new-input" id="no volume" placeholder="no volume">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tahun" class="  text-left">tahun</label>

                  <div class="">
                    <input type="text" class="form-control new-input" id="tahun" placeholder="tahun">
                  </div>
                </div>
                <div class="form-group">
                  <label for="gambar_journal" class="  text-left">Paper file</label>

                  <div class="">
                    <div class="col col-md-12 form-goup-file">
                    <div class="input-file-right text-left"><label class="btn btn-success btn-choose-foto btn-green" style="text-align: left;" for="file_name"><i class="fa fa-paperclip" ></i>  File</label></div>
                    <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
                    
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="gambar_journal" class="  text-left">gambar journal</label>

                  <div class="">
                    <div class="col col-md-12 form-goup-file">
                    <div class="input-file-right text-left"><label class="btn btn-success btn-choose-foto btn-green" style="text-align: left;" for="file_name"><i class="fa fa-film" ></i> image</label></div>
                    <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
                    
                  </div>
                  </div>
                </div> -->
              

              </div>
              <!-- /.box-body -->
              
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
     
          <!-- /.box -->
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
                  <input type="text" class="form-control new-input" id="issn_journal" placeholder="ISSN journal">
                </div>
              </div>
              <div class="form-group">
                <label for="kat_journal" class="  text-left">Kategori journal</label>

                <div class="">
                  <select class="form-control new-input" id="kat_journal" placeholder="Kategori journal">
                    <option>--Pilih Kategori--</option>
                    <option>Kategori 1</option>
                    <option>Kategori 2</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="gambar_journal" class="  text-left">gambar journal</label>

                  <div class="">
                    <div class="col col-md-12 form-goup-file">
                    <div class="input-file-right text-left"><label class="btn btn-success btn-choose-foto btn-green" style="text-align: left;" for="file_name"><i class="fa fa-film" ></i> image</label></div>
                    <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
                    
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success btn-green pull-right ">Save</button>
              </div>
          </div>
        </div>