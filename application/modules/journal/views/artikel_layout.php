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
</style>
<div class="col col-md-8">
          <!-- Horizontal Form -->
          <div class=" box box-bordered col-col-md-12 col0sm-12 col-xs-12 ">
            <div class="box-header ">
              <h3 class="box-title">Content Artikel</h3>
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
              <div class="form-group">
                <label for="keyword" class="  text-left">Keyword</label>

                <div class="">
                  <input type="text" class="form-control new-input" id="keyword" placeholder="Keyword">
                </div>
              </div>
              <div class="form-group">
                  <label for="judul journal" class="  text-left">references</label>

                  <div class="">
                    <?php echo $this->ckeditor->editor("references","" ); ?>
                    <input type="hidden" name="references" id="references">
                    <div class="error" id="ntf_content"></div>
                  </div>
                </div>

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
              <h3 class="box-title">Setting Artikel</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="journal" class="  text-left">journal</label>

                <div class="">
                  <select class="form-control new-input" id="journal" placeholder="journal">
                    <option>--Pilih Journal--</option>
                    <option>Journal 1</option>
                    <option>Journal 2</option>
                  </select>
                </div>   
              </div>
              <div class="form-group">
                <label for="volume" class="  text-left">volume</label>

                <div class="">
                  <select class="form-control new-input" id="volume" placeholder="volume">
                    <option>--Pilih Journal--</option>
                    <option>Volume 1</option>
                    <option>Volume 2</option>
                  </select>
                </div>   
              </div>
              <div class="form-group">
                <label for="no_volume" class="  text-left">No Volume</label>

                <div class="">
                  <select class="form-control new-input" id="no_volume" placeholder="No Volume">
                    <option>--Pilih Journal--</option>
                    <option>No Volume 1</option>
                    <option>No Volume 2</option>
                  </select>
                </div>   
              </div>
                <div class="form-group form-file">
                  <label for="gambar_journal" class="  text-left">Paper file</label>

                  <div class="">
                    <div class="col col-md-12 form-goup-file">
                    <div class="input-file-right text-left"><label class="btn btn-success btn-choose-foto btn-green" style="text-align: left;" for="file_name"><i class="fa fa-paperclip" ></i> Choose File</label></div>
                    <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
                    
                  </div>
                  </div>
                </div>
                  <div class="form-group form-file">
                  <label for="gambar_journal" class="  text-left">Abstrak file</label>

                  <div class="">
                    <div class="col col-md-12 form-goup-file">
                    <div class="input-file-right text-left"><label class="btn btn-success btn-choose-foto btn-green" style="text-align: left;" for="file_name"><i class="fa fa-paperclip" ></i> Choose File</label></div>
                    <div class="input-file-left"><input type="file" class="form-control file new-input" name="file_name" id="file_name"></div> 
                    
                  </div>
                  </div>
                </div>
               <div class="box-author">
                  <div class="form-group">
                    <label for="author_name" class="  text-left">Nama Author</label>

                    <div class="">
                      <input type="text" class="form-control new-input" id="author_name" placeholder="Nama Author">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="jabatan_name" class="  text-left">Jabatan Author</label>

                    <div class="">
                      <input type="text" class="form-control new-input" id="jabatan_name" placeholder="Jabatan Author">
                    </div>
                  </div>
               </div>
               <div class="form-group form-file" style="margin-top: 15px;">
                    <button type="submit" class="btn btn-success btn-green pull-right "><i class="fa fa-plus"></i> Add more</button>
              </div>
              <div class="form-group">
                <table style="padding-top: 15px;">
                  <tr>
                    <td>
                      <input type="checkbox" name="agree" id="agree" value="1" style="float: left;margin-top: -1.5em; margin-right: 5px;">
                    </td>
                    <td>
                      <p class="form-control-static" style="background-color: red;color: white;padding: 0;">Saya Telah membaca dan menyetujui semua persayratan dan peraturan yang di ajukan</p>
                    </td>
                  </tr>
                </table>
                
                
                <div class="error" id="ntf_agree"></div>
              </div>
            </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-green pull-right ">Save</button>
              </div>
          </div>
        </div>